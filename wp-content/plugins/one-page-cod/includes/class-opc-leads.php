<?php
/**
 * Capture des abandons du formulaire COD (leads).
 *
 * Enregistre progressivement les coordonnées saisies (dès qu'un moyen de contact
 * valide est présent : téléphone >=8 chiffres OU email valide), même sans clic
 * sur "Commander". Permet à l'équipe de rappeler les prospects.
 *
 * - Table : {prefix}homedesk_leads (clé UNIQUE session_id → INSERT/UPDATE)
 * - Front : assets/js/opc-leads.js (session_id persistant en localStorage)
 * - Admin : sous-menu WooCommerce "Abandons COD" (liste, marquer traité, export CSV filtré)
 */

if (!defined('ABSPATH')) {
    exit;
}

class OPC_Leads {

    private static $instance = null;

    const DB_VERSION = '1.0.0';

    public static function get_instance() {
        if (null === self::$instance) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    private function __construct() {
        // Création / migration de la table.
        // Appel direct : ce constructeur est instancié via init_classes() pendant le
        // hook 'init', donc ré-ajouter un add_action('init', ...) ici ne se déclencherait
        // pas de façon fiable sur la même requête.
        $this->maybe_create_table();

        // AJAX — sauvegarde progressive (connecté + non connecté)
        add_action('wp_ajax_opc_save_lead', array($this, 'handle_save_lead'));
        add_action('wp_ajax_nopriv_opc_save_lead', array($this, 'handle_save_lead'));

        // JS front sur les fiches produit
        add_action('wp_enqueue_scripts', array($this, 'enqueue_scripts'));

        // Admin
        add_action('admin_menu', array($this, 'add_admin_page'));
        add_action('admin_post_opc_export_leads', array($this, 'handle_export_csv'));
        add_action('admin_post_opc_toggle_treated', array($this, 'handle_toggle_treated'));
    }

    public static function table_name() {
        global $wpdb;
        return $wpdb->prefix . 'homedesk_leads';
    }

    // -------------------------------------------------------------------------
    // Table
    // -------------------------------------------------------------------------
    public function maybe_create_table() {
        if (get_option('opc_leads_db_version') === self::DB_VERSION) {
            return;
        }

        global $wpdb;
        $table           = self::table_name();
        $charset_collate = $wpdb->get_charset_collate();

        $sql = "CREATE TABLE {$table} (
            id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
            session_id VARCHAR(64) NOT NULL,
            name VARCHAR(191) NOT NULL DEFAULT '',
            phone VARCHAR(32) NOT NULL DEFAULT '',
            email VARCHAR(191) NOT NULL DEFAULT '',
            address VARCHAR(255) NOT NULL DEFAULT '',
            product_id BIGINT UNSIGNED NOT NULL DEFAULT 0,
            product_name VARCHAR(191) NOT NULL DEFAULT '',
            variation VARCHAR(191) NOT NULL DEFAULT '',
            quantity INT NOT NULL DEFAULT 1,
            status VARCHAR(20) NOT NULL DEFAULT 'abandoned',
            order_id BIGINT UNSIGNED NOT NULL DEFAULT 0,
            treated TINYINT(1) NOT NULL DEFAULT 0,
            created_at DATETIME NOT NULL DEFAULT '0000-00-00 00:00:00',
            updated_at DATETIME NOT NULL DEFAULT '0000-00-00 00:00:00',
            PRIMARY KEY  (id),
            UNIQUE KEY session_id (session_id),
            KEY status (status),
            KEY created_at (created_at)
        ) {$charset_collate};";

        require_once ABSPATH . 'wp-admin/includes/upgrade.php';
        dbDelta($sql);

        update_option('opc_leads_db_version', self::DB_VERSION);
    }

    // -------------------------------------------------------------------------
    // Front — enqueue
    // -------------------------------------------------------------------------
    public function enqueue_scripts() {
        if (!function_exists('is_product') || !is_product()) {
            return;
        }
        // Dépend de opc-scripts pour réutiliser l'objet localisé opcData (ajax_url + nonce)
        wp_enqueue_script(
            'opc-leads',
            OPC_PLUGIN_URL . 'assets/js/opc-leads.js',
            array('opc-scripts'),
            OPC_VERSION,
            true
        );
    }

    // -------------------------------------------------------------------------
    // AJAX — sauvegarde progressive
    // -------------------------------------------------------------------------
    public function handle_save_lead() {
        check_ajax_referer('opc_nonce', 'nonce');

        $session_id = isset($_POST['session_id']) ? sanitize_text_field(wp_unslash($_POST['session_id'])) : '';
        if (strlen($session_id) < 10 || strlen($session_id) > 64) {
            wp_send_json_error(array('message' => 'session invalide'));
        }

        $phone = isset($_POST['phone']) ? sanitize_text_field(wp_unslash($_POST['phone'])) : '';
        $email = isset($_POST['email']) ? sanitize_email(wp_unslash($_POST['email'])) : '';

        // Exiger au moins un moyen de contact valide (tél >=8 chiffres OU email valide)
        $has_phone = strlen(preg_replace('/[^0-9]/', '', $phone)) >= 8;
        $has_email = $email && is_email($email);
        if (!$has_phone && !$has_email) {
            wp_send_json_error(array('message' => 'contact requis'));
        }

        // Rate limiting léger par IP (30 écritures / minute)
        $ip_key   = 'opc_lead_rate_' . md5($_SERVER['REMOTE_ADDR'] ?? '');
        $attempts = (int) get_transient($ip_key);
        if ($attempts >= 30) {
            wp_send_json_error(array('message' => 'trop de requêtes'));
        }
        set_transient($ip_key, $attempts + 1, 60);

        $name       = isset($_POST['name']) ? sanitize_text_field(wp_unslash($_POST['name'])) : '';
        $address    = isset($_POST['address']) ? sanitize_text_field(wp_unslash($_POST['address'])) : '';
        $product_id = isset($_POST['product_id']) ? absint($_POST['product_id']) : 0;
        $variation  = isset($_POST['variation']) ? sanitize_text_field(wp_unslash($_POST['variation'])) : '';
        $quantity   = isset($_POST['quantity']) ? max(1, absint($_POST['quantity'])) : 1;

        $product_name = '';
        if ($product_id) {
            $p = wc_get_product($product_id);
            if ($p) {
                $product_name = $p->get_name();
            }
        }

        global $wpdb;
        $table = self::table_name();
        $now   = current_time('mysql');

        $existing = $wpdb->get_row(
            $wpdb->prepare("SELECT id, status FROM {$table} WHERE session_id = %s", $session_id)
        );

        $fields = array(
            'name'         => $name,
            'phone'        => $phone,
            'email'        => $email,
            'address'      => $address,
            'product_id'   => $product_id,
            'product_name' => $product_name,
            'variation'    => $variation,
            'quantity'     => $quantity,
            'updated_at'   => $now,
        );

        if ($existing) {
            // On ne rétrograde jamais un lead déjà converti
            if ($existing->status !== 'ordered') {
                $wpdb->update($table, $fields, array('id' => $existing->id));
            }
        } else {
            $fields['session_id'] = $session_id;
            $fields['status']     = 'abandoned';
            $fields['created_at'] = $now;
            $wpdb->insert($table, $fields);
        }

        wp_send_json_success(array('saved' => true));
    }

    /**
     * Marque un lead comme converti quand la commande COD est créée.
     * Appelé depuis OPC_Form::handle_ajax_submit avec le session_id du formulaire.
     */
    public static function mark_ordered_by_session($session_id, $order_id) {
        $session_id = sanitize_text_field($session_id);
        if (strlen($session_id) < 10) {
            return;
        }
        global $wpdb;
        $wpdb->update(
            self::table_name(),
            array(
                'status'     => 'ordered',
                'order_id'   => absint($order_id),
                'updated_at' => current_time('mysql'),
            ),
            array('session_id' => $session_id)
        );
    }

    // -------------------------------------------------------------------------
    // Requête (partagée par l'affichage admin et l'export CSV)
    // -------------------------------------------------------------------------
    private function query_leads($args) {
        global $wpdb;
        $table  = self::table_name();
        $where  = array('1=1');
        $params = array();

        if (!empty($args['status']) && in_array($args['status'], array('abandoned', 'ordered'), true)) {
            $where[]  = 'status = %s';
            $params[] = $args['status'];
        }
        if (!empty($args['date_from'])) {
            $where[]  = 'created_at >= %s';
            $params[] = $args['date_from'] . ' 00:00:00';
        }
        if (!empty($args['date_to'])) {
            $where[]  = 'created_at <= %s';
            $params[] = $args['date_to'] . ' 23:59:59';
        }

        $sql = "SELECT * FROM {$table} WHERE " . implode(' AND ', $where) . ' ORDER BY updated_at DESC';
        if (!empty($args['limit'])) {
            $sql .= ' LIMIT ' . intval($args['limit']);
        }

        if ($params) {
            $sql = $wpdb->prepare($sql, $params);
        }
        return $wpdb->get_results($sql);
    }

    private function get_filters_from_request() {
        return array(
            'status'    => isset($_GET['status']) ? sanitize_key($_GET['status']) : '',
            'date_from' => isset($_GET['date_from']) ? preg_replace('/[^0-9\-]/', '', $_GET['date_from']) : '',
            'date_to'   => isset($_GET['date_to']) ? preg_replace('/[^0-9\-]/', '', $_GET['date_to']) : '',
        );
    }

    // -------------------------------------------------------------------------
    // Admin — page
    // -------------------------------------------------------------------------
    public function add_admin_page() {
        add_submenu_page(
            'woocommerce',
            __('Abandons COD', 'one-page-cod'),
            __('Abandons COD', 'one-page-cod'),
            'manage_woocommerce',
            'opc-leads',
            array($this, 'render_admin_page')
        );
    }

    public function render_admin_page() {
        if (!current_user_can('manage_woocommerce')) {
            return;
        }

        $filters = $this->get_filters_from_request();
        $rows    = $this->query_leads(array_merge($filters, array('limit' => 500)));

        $export_url = wp_nonce_url(
            add_query_arg(
                array_merge(array('action' => 'opc_export_leads'), array_filter($filters)),
                admin_url('admin-post.php')
            ),
            'opc_export_leads'
        );
        ?>
        <div class="wrap">
            <h1><?php esc_html_e('Abandons COD', 'one-page-cod'); ?></h1>
            <p class="description">
                <?php esc_html_e('Prospects ayant saisi un moyen de contact (téléphone ou email) dans le formulaire de commande. Rappelez-les !', 'one-page-cod'); ?>
            </p>

            <form method="get" style="margin:16px 0;display:flex;gap:10px;align-items:flex-end;flex-wrap:wrap;">
                <input type="hidden" name="page" value="opc-leads">
                <label>
                    <?php esc_html_e('Du', 'one-page-cod'); ?><br>
                    <input type="date" name="date_from" value="<?php echo esc_attr($filters['date_from']); ?>">
                </label>
                <label>
                    <?php esc_html_e('Au', 'one-page-cod'); ?><br>
                    <input type="date" name="date_to" value="<?php echo esc_attr($filters['date_to']); ?>">
                </label>
                <label>
                    <?php esc_html_e('Statut', 'one-page-cod'); ?><br>
                    <select name="status">
                        <option value=""          <?php selected($filters['status'], ''); ?>><?php esc_html_e('Tous', 'one-page-cod'); ?></option>
                        <option value="abandoned" <?php selected($filters['status'], 'abandoned'); ?>><?php esc_html_e('Abandonnés', 'one-page-cod'); ?></option>
                        <option value="ordered"   <?php selected($filters['status'], 'ordered'); ?>><?php esc_html_e('Commandés', 'one-page-cod'); ?></option>
                    </select>
                </label>
                <button type="submit" class="button"><?php esc_html_e('Filtrer', 'one-page-cod'); ?></button>
                <a href="<?php echo esc_url($export_url); ?>" class="button button-primary"><?php esc_html_e('Exporter en CSV', 'one-page-cod'); ?></a>
            </form>

            <table class="wp-list-table widefat fixed striped">
                <thead>
                    <tr>
                        <th><?php esc_html_e('Date', 'one-page-cod'); ?></th>
                        <th><?php esc_html_e('Nom', 'one-page-cod'); ?></th>
                        <th><?php esc_html_e('Téléphone', 'one-page-cod'); ?></th>
                        <th><?php esc_html_e('Email', 'one-page-cod'); ?></th>
                        <th><?php esc_html_e('Produit', 'one-page-cod'); ?></th>
                        <th><?php esc_html_e('Statut', 'one-page-cod'); ?></th>
                        <th><?php esc_html_e('Traité', 'one-page-cod'); ?></th>
                    </tr>
                </thead>
                <tbody>
                <?php if (empty($rows)) : ?>
                    <tr><td colspan="7"><?php esc_html_e('Aucun abandon pour ces critères.', 'one-page-cod'); ?></td></tr>
                <?php else : foreach ($rows as $r) :
                    $toggle_url = wp_nonce_url(
                        add_query_arg(array('action' => 'opc_toggle_treated', 'id' => $r->id), admin_url('admin-post.php')),
                        'opc_toggle_treated_' . $r->id
                    );
                    $phone_digits = preg_replace('/[^0-9+]/', '', $r->phone);
                    ?>
                    <tr>
                        <td>
                            <?php echo esc_html(mysql2date('d/m/Y H:i', $r->created_at)); ?><br>
                            <small style="color:#777;"><?php echo esc_html(human_time_diff(strtotime($r->updated_at), current_time('timestamp'))); ?> <?php esc_html_e('(maj)', 'one-page-cod'); ?></small>
                        </td>
                        <td><?php echo $r->name ? esc_html($r->name) : '<span style="color:#bbb;">—</span>'; ?></td>
                        <td>
                            <?php if ($r->phone) : ?>
                                <a href="tel:<?php echo esc_attr($phone_digits); ?>">📞 <?php echo esc_html($r->phone); ?></a>
                            <?php else : ?>
                                <span style="color:#bbb;">—</span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <?php if ($r->email) : ?>
                                <a href="mailto:<?php echo esc_attr($r->email); ?>"><?php echo esc_html($r->email); ?></a>
                            <?php else : ?>
                                <span style="color:#bbb;">—</span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <?php echo esc_html($r->product_name ?: ('#' . $r->product_id)); ?>
                            <?php if ($r->variation) : ?><br><small><?php echo esc_html($r->variation); ?></small><?php endif; ?>
                            <?php if ((int) $r->quantity > 1) : ?><br><small>× <?php echo (int) $r->quantity; ?></small><?php endif; ?>
                        </td>
                        <td>
                            <?php if ($r->status === 'ordered') : ?>
                                <span style="color:#318b82;font-weight:600;">✔ <?php esc_html_e('Commandé', 'one-page-cod'); ?></span>
                                <?php if ($r->order_id) : ?><br><small>#<?php echo (int) $r->order_id; ?></small><?php endif; ?>
                            <?php else : ?>
                                <span style="color:#e67e22;font-weight:600;"><?php esc_html_e('Abandonné', 'one-page-cod'); ?></span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <a href="<?php echo esc_url($toggle_url); ?>" class="button button-small">
                                <?php echo $r->treated ? '✅ ' . esc_html__('Traité', 'one-page-cod') : esc_html__('Marquer traité', 'one-page-cod'); ?>
                            </a>
                        </td>
                    </tr>
                <?php endforeach; endif; ?>
                </tbody>
            </table>
        </div>
        <?php
    }

    // -------------------------------------------------------------------------
    // Admin — marquer traité / non traité
    // -------------------------------------------------------------------------
    public function handle_toggle_treated() {
        $id = isset($_GET['id']) ? absint($_GET['id']) : 0;
        if (!$id || !current_user_can('manage_woocommerce')) {
            wp_die(__('Action non autorisée.', 'one-page-cod'));
        }
        check_admin_referer('opc_toggle_treated_' . $id);

        global $wpdb;
        $table   = self::table_name();
        $current = (int) $wpdb->get_var($wpdb->prepare("SELECT treated FROM {$table} WHERE id = %d", $id));
        $wpdb->update($table, array('treated' => $current ? 0 : 1), array('id' => $id));

        wp_safe_redirect(wp_get_referer() ?: admin_url('admin.php?page=opc-leads'));
        exit;
    }

    // -------------------------------------------------------------------------
    // Admin — export CSV (respecte les filtres date/statut)
    // -------------------------------------------------------------------------
    public function handle_export_csv() {
        if (!current_user_can('manage_woocommerce')) {
            wp_die(__('Action non autorisée.', 'one-page-cod'));
        }
        check_admin_referer('opc_export_leads');

        $filters = $this->get_filters_from_request();
        $rows    = $this->query_leads($filters);

        $filename = 'abandons-cod-' . date('Y-m-d-His') . '.csv';

        nocache_headers();
        header('Content-Type: text/csv; charset=utf-8');
        header('Content-Disposition: attachment; filename=' . $filename);

        $out = fopen('php://output', 'w');
        // BOM UTF-8 pour Excel
        fprintf($out, chr(0xEF) . chr(0xBB) . chr(0xBF));

        fputcsv($out, array(
            'Date', 'Nom', 'Téléphone', 'Email', 'Adresse',
            'Produit', 'Variation', 'Quantité', 'Statut', 'Commande', 'Traité',
        ));

        foreach ($rows as $r) {
            fputcsv($out, array(
                mysql2date('d/m/Y H:i', $r->created_at),
                $r->name,
                $r->phone,
                $r->email,
                $r->address,
                $r->product_name ?: ('#' . $r->product_id),
                $r->variation,
                $r->quantity,
                $r->status === 'ordered' ? 'Commandé' : 'Abandonné',
                $r->order_id ? ('#' . $r->order_id) : '',
                $r->treated ? 'Oui' : 'Non',
            ));
        }

        fclose($out);
        exit;
    }
}
