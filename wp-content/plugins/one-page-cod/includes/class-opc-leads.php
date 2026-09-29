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

    const DB_VERSION = '1.2.0';

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
        add_action('admin_post_opc_trash_lead', array($this, 'handle_trash_lead'));
        add_action('admin_post_opc_restore_lead', array($this, 'handle_restore_lead'));
        add_action('admin_post_opc_delete_lead', array($this, 'handle_delete_lead'));
        add_action('admin_post_opc_leads_bulk', array($this, 'handle_leads_bulk'));
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
            profil VARCHAR(191) NOT NULL DEFAULT '',
            product_id BIGINT UNSIGNED NOT NULL DEFAULT 0,
            product_name VARCHAR(191) NOT NULL DEFAULT '',
            variation VARCHAR(191) NOT NULL DEFAULT '',
            quantity INT NOT NULL DEFAULT 1,
            status VARCHAR(20) NOT NULL DEFAULT 'abandoned',
            order_id BIGINT UNSIGNED NOT NULL DEFAULT 0,
            treated TINYINT(1) NOT NULL DEFAULT 0,
            trashed TINYINT(1) NOT NULL DEFAULT 0,
            created_at DATETIME NOT NULL DEFAULT '0000-00-00 00:00:00',
            updated_at DATETIME NOT NULL DEFAULT '0000-00-00 00:00:00',
            PRIMARY KEY  (id),
            UNIQUE KEY session_id (session_id),
            KEY status (status),
            KEY trashed (trashed),
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

        // Profil (facultatif) — whitelist stricte contre la liste autorisée
        $profil = isset($_POST['profil']) ? sanitize_text_field(wp_unslash($_POST['profil'])) : '';
        if ($profil !== '' && function_exists('opc_get_profil_options') && !in_array($profil, opc_get_profil_options(), true)) {
            $profil = '';
        }

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
            'profil'       => $profil,
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
    /**
     * Construit la clause WHERE (+ paramètres) partagée par query_leads / count_leads.
     *
     * @return array [string $where_sql, array $params]
     */
    private function build_where($args) {
        $where  = array('1=1');
        $params = array();

        // Vue "corbeille" vs vues normales (qui excluent les éléments en corbeille)
        $view = !empty($args['status']) ? $args['status'] : '';
        if ($view === 'trash') {
            $where[] = 'trashed = 1';
        } else {
            $where[] = 'trashed = 0';
            if (in_array($view, array('abandoned', 'ordered'), true)) {
                $where[]  = 'status = %s';
                $params[] = $view;
            }
        }
        if (!empty($args['profil'])
            && function_exists('opc_get_profil_options')
            && in_array($args['profil'], opc_get_profil_options(), true)) {
            $where[]  = 'profil = %s';
            $params[] = $args['profil'];
        }
        if (!empty($args['date_from'])) {
            $where[]  = 'created_at >= %s';
            $params[] = $args['date_from'] . ' 00:00:00';
        }
        if (!empty($args['date_to'])) {
            $where[]  = 'created_at <= %s';
            $params[] = $args['date_to'] . ' 23:59:59';
        }

        return array(implode(' AND ', $where), $params);
    }

    private function query_leads($args) {
        global $wpdb;
        $table = self::table_name();
        list($where_sql, $params) = $this->build_where($args);

        $sql = "SELECT * FROM {$table} WHERE {$where_sql} ORDER BY updated_at DESC";

        // Pagination (per_page + offset) prioritaire ; sinon limite simple ; sinon tout
        if (!empty($args['per_page'])) {
            $per_page = max(1, intval($args['per_page']));
            $offset   = !empty($args['offset']) ? max(0, intval($args['offset'])) : 0;
            $sql .= ' LIMIT ' . $offset . ', ' . $per_page;
        } elseif (!empty($args['limit'])) {
            $sql .= ' LIMIT ' . intval($args['limit']);
        }

        if ($params) {
            $sql = $wpdb->prepare($sql, $params);
        }
        return $wpdb->get_results($sql);
    }

    private function count_leads($args) {
        global $wpdb;
        $table = self::table_name();
        list($where_sql, $params) = $this->build_where($args);

        $sql = "SELECT COUNT(*) FROM {$table} WHERE {$where_sql}";
        if ($params) {
            $sql = $wpdb->prepare($sql, $params);
        }
        return (int) $wpdb->get_var($sql);
    }

    private function get_filters_from_request() {
        return array(
            'status'    => isset($_GET['status']) ? sanitize_key($_GET['status']) : '',
            'profil'    => isset($_GET['profil']) ? sanitize_text_field(wp_unslash($_GET['profil'])) : '',
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
        $is_trash = ($filters['status'] === 'trash');

        // Pagination : 20 lignes par page
        $per_page    = 20;
        $total       = $this->count_leads($filters);
        $total_pages = max(1, (int) ceil($total / $per_page));
        $paged       = isset($_GET['paged']) ? max(1, intval($_GET['paged'])) : 1;
        if ($paged > $total_pages) {
            $paged = $total_pages;
        }
        $offset = ($paged - 1) * $per_page;

        $rows = $this->query_leads(array_merge($filters, array(
            'per_page' => $per_page,
            'offset'   => $offset,
        )));

        $first_row = $total ? ($offset + 1) : 0;
        $last_row  = $offset + count($rows);

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

            <?php
            $trashed_n  = isset($_GET['opc_trashed'])  ? absint($_GET['opc_trashed'])  : 0;
            $restored_n = isset($_GET['opc_restored']) ? absint($_GET['opc_restored']) : 0;
            $deleted_n  = isset($_GET['opc_deleted'])  ? absint($_GET['opc_deleted'])  : 0;
            $notice = '';
            if ($trashed_n > 0) {
                $notice = sprintf(_n('%s abandon déplacé vers la corbeille.', '%s abandons déplacés vers la corbeille.', $trashed_n, 'one-page-cod'), number_format_i18n($trashed_n));
            } elseif ($restored_n > 0) {
                $notice = sprintf(_n('%s abandon restauré.', '%s abandons restaurés.', $restored_n, 'one-page-cod'), number_format_i18n($restored_n));
            } elseif ($deleted_n > 0) {
                $notice = sprintf(_n('%s abandon supprimé définitivement.', '%s abandons supprimés définitivement.', $deleted_n, 'one-page-cod'), number_format_i18n($deleted_n));
            }
            ?>
            <?php if ($notice) : ?>
                <div class="notice notice-success is-dismissible"><p><?php echo esc_html($notice); ?></p></div>
            <?php endif; ?>

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
                        <option value="trash"     <?php selected($filters['status'], 'trash'); ?>><?php esc_html_e('Corbeille', 'one-page-cod'); ?></option>
                    </select>
                </label>
                <label>
                    <?php esc_html_e('Profil', 'one-page-cod'); ?><br>
                    <select name="profil">
                        <option value="" <?php selected($filters['profil'], ''); ?>><?php esc_html_e('Tous', 'one-page-cod'); ?></option>
                        <?php foreach ((function_exists('opc_get_profil_options') ? opc_get_profil_options() : array()) as $profil_option) : ?>
                            <option value="<?php echo esc_attr($profil_option); ?>" <?php selected($filters['profil'], $profil_option); ?>><?php echo esc_html($profil_option); ?></option>
                        <?php endforeach; ?>
                    </select>
                </label>
                <button type="submit" class="button"><?php esc_html_e('Filtrer', 'one-page-cod'); ?></button>
                <a href="<?php echo esc_url($export_url); ?>" class="button button-primary"><?php esc_html_e('Exporter en CSV', 'one-page-cod'); ?></a>
            </form>

            <?php
            $page_links = paginate_links(array(
                'base'      => add_query_arg('paged', '%#%'),
                'format'    => '',
                'prev_text' => __('‹', 'one-page-cod'),
                'next_text' => __('›', 'one-page-cod'),
                'total'     => $total_pages,
                'current'   => $paged,
            ));
            ?>
            <form method="post" action="<?php echo esc_url(admin_url('admin-post.php')); ?>" id="opc-leads-form">
            <input type="hidden" name="action" value="opc_leads_bulk">
            <?php wp_nonce_field('opc_leads_bulk'); ?>
            <?php foreach ($filters as $fk => $fv) : if ($fv === '') continue; ?>
                <input type="hidden" name="<?php echo esc_attr($fk); ?>" value="<?php echo esc_attr($fv); ?>">
            <?php endforeach; ?>
            <input type="hidden" name="paged" value="<?php echo esc_attr($paged); ?>">

            <div class="tablenav top">
                <div class="alignleft actions bulkactions">
                    <label for="opc-bulk-action" class="screen-reader-text"><?php esc_html_e('Actions groupées', 'one-page-cod'); ?></label>
                    <select name="bulk_action" id="opc-bulk-action">
                        <option value="-1"><?php esc_html_e('Actions groupées', 'one-page-cod'); ?></option>
                        <?php if ($is_trash) : ?>
                            <option value="restore"><?php esc_html_e('Restaurer', 'one-page-cod'); ?></option>
                            <option value="delete"><?php esc_html_e('Supprimer définitivement', 'one-page-cod'); ?></option>
                        <?php else : ?>
                            <option value="trash"><?php esc_html_e('Mettre à la corbeille', 'one-page-cod'); ?></option>
                        <?php endif; ?>
                    </select>
                    <button type="submit" class="button action" onclick="return opcConfirmBulk(this.form);"><?php esc_html_e('Appliquer', 'one-page-cod'); ?></button>
                </div>
                <div class="tablenav-pages">
                    <span class="displaying-num">
                        <?php
                        if ($total > 0) {
                            printf(
                                /* translators: 1: première ligne, 2: dernière ligne, 3: total */
                                esc_html__('Affichage de %1$s à %2$s sur %3$s résultats', 'one-page-cod'),
                                number_format_i18n($first_row),
                                number_format_i18n($last_row),
                                number_format_i18n($total)
                            );
                        } else {
                            esc_html_e('0 résultat', 'one-page-cod');
                        }
                        ?>
                    </span>
                    <?php if ($page_links) : ?>
                        <span class="pagination-links"><?php echo $page_links; // déjà échappé par paginate_links ?></span>
                    <?php endif; ?>
                </div>
            </div>

            <table class="wp-list-table widefat fixed striped">
                <thead>
                    <tr>
                        <td class="manage-column column-cb check-column">
                            <input type="checkbox" id="opc-cb-select-all" onclick="opcToggleAll(this);">
                        </td>
                        <th><?php esc_html_e('Date', 'one-page-cod'); ?></th>
                        <th><?php esc_html_e('Nom', 'one-page-cod'); ?></th>
                        <th><?php esc_html_e('Téléphone', 'one-page-cod'); ?></th>
                        <th><?php esc_html_e('Email', 'one-page-cod'); ?></th>
                        <th><?php esc_html_e('Profil', 'one-page-cod'); ?></th>
                        <th><?php esc_html_e('Produit', 'one-page-cod'); ?></th>
                        <th><?php esc_html_e('Statut', 'one-page-cod'); ?></th>
                        <th><?php esc_html_e('Traité', 'one-page-cod'); ?></th>
                    </tr>
                </thead>
                <tbody>
                <?php if (empty($rows)) : ?>
                    <tr><td colspan="9"><?php esc_html_e('Aucun abandon pour ces critères.', 'one-page-cod'); ?></td></tr>
                <?php else : foreach ($rows as $r) :
                    $toggle_url = wp_nonce_url(
                        add_query_arg(array('action' => 'opc_toggle_treated', 'id' => $r->id), admin_url('admin-post.php')),
                        'opc_toggle_treated_' . $r->id
                    );
                    $trash_url = wp_nonce_url(
                        add_query_arg(array('action' => 'opc_trash_lead', 'id' => $r->id), admin_url('admin-post.php')),
                        'opc_trash_lead_' . $r->id
                    );
                    $restore_url = wp_nonce_url(
                        add_query_arg(array('action' => 'opc_restore_lead', 'id' => $r->id), admin_url('admin-post.php')),
                        'opc_restore_lead_' . $r->id
                    );
                    $delete_url = wp_nonce_url(
                        add_query_arg(array('action' => 'opc_delete_lead', 'id' => $r->id), admin_url('admin-post.php')),
                        'opc_delete_lead_' . $r->id
                    );
                    $phone_digits = preg_replace('/[^0-9+]/', '', $r->phone);
                    ?>
                    <tr>
                        <th scope="row" class="check-column">
                            <input type="checkbox" name="lead_ids[]" value="<?php echo (int) $r->id; ?>">
                        </th>
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
                        <td><?php echo $r->profil ? esc_html($r->profil) : '<span style="color:#bbb;">—</span>'; ?></td>
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
                            <?php if ($is_trash) : ?>
                                <a href="<?php echo esc_url($restore_url); ?>" class="button button-small">
                                    <?php esc_html_e('Restaurer', 'one-page-cod'); ?>
                                </a>
                                <a href="<?php echo esc_url($delete_url); ?>"
                                   class="button button-small button-link-delete"
                                   style="color:#b32d2e;"
                                   onclick="return confirm('<?php echo esc_js(__('Supprimer définitivement cet abandon ? Cette action est irréversible.', 'one-page-cod')); ?>');">
                                    <?php esc_html_e('Supprimer définitivement', 'one-page-cod'); ?>
                                </a>
                            <?php else : ?>
                                <a href="<?php echo esc_url($toggle_url); ?>" class="button button-small">
                                    <?php echo $r->treated ? '✅ ' . esc_html__('Traité', 'one-page-cod') : esc_html__('Marquer traité', 'one-page-cod'); ?>
                                </a>
                                <a href="<?php echo esc_url($trash_url); ?>"
                                   class="button button-small"
                                   style="color:#b32d2e;">
                                    <?php esc_html_e('Vers corbeille', 'one-page-cod'); ?>
                                </a>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; endif; ?>
                </tbody>
            </table>

            <div class="tablenav bottom">
                <div class="alignleft actions bulkactions">
                    <label for="opc-bulk-action-2" class="screen-reader-text"><?php esc_html_e('Actions groupées', 'one-page-cod'); ?></label>
                    <select name="bulk_action_2" id="opc-bulk-action-2">
                        <option value="-1"><?php esc_html_e('Actions groupées', 'one-page-cod'); ?></option>
                        <?php if ($is_trash) : ?>
                            <option value="restore"><?php esc_html_e('Restaurer', 'one-page-cod'); ?></option>
                            <option value="delete"><?php esc_html_e('Supprimer définitivement', 'one-page-cod'); ?></option>
                        <?php else : ?>
                            <option value="trash"><?php esc_html_e('Mettre à la corbeille', 'one-page-cod'); ?></option>
                        <?php endif; ?>
                    </select>
                    <button type="submit" class="button action" onclick="return opcConfirmBulk(this.form, true);"><?php esc_html_e('Appliquer', 'one-page-cod'); ?></button>
                </div>
                <?php if ($page_links) : ?>
                <div class="tablenav-pages">
                    <span class="pagination-links"><?php echo $page_links; // déjà échappé par paginate_links ?></span>
                </div>
                <?php endif; ?>
            </div>
            </form>

            <script>
            function opcToggleAll(src) {
                document.querySelectorAll('#opc-leads-form input[name="lead_ids[]"]').forEach(function (cb) {
                    cb.checked = src.checked;
                });
            }
            function opcConfirmBulk(form, isBottom) {
                var sel = form.querySelector(isBottom ? '#opc-bulk-action-2' : '#opc-bulk-action');
                var action = sel ? sel.value : '-1';
                // Le sélecteur du bas doit piloter le champ effectif "bulk_action"
                if (isBottom) {
                    var main = form.querySelector('#opc-bulk-action');
                    if (main) { main.value = action; }
                }
                if (action === '-1') {
                    alert('<?php echo esc_js(__('Veuillez choisir une action.', 'one-page-cod')); ?>');
                    return false;
                }
                var checked = form.querySelectorAll('input[name="lead_ids[]"]:checked').length;
                if (checked === 0) {
                    alert('<?php echo esc_js(__('Veuillez sélectionner au moins un abandon.', 'one-page-cod')); ?>');
                    return false;
                }
                if (action === 'delete') {
                    return confirm('<?php echo esc_js(__('Supprimer définitivement les abandons sélectionnés ? Cette action est irréversible.', 'one-page-cod')); ?>');
                }
                return true;
            }
            </script>
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
    // Admin — corbeille (unitaire) : mettre à la corbeille / restaurer
    // -------------------------------------------------------------------------
    public function handle_trash_lead() {
        $id = isset($_GET['id']) ? absint($_GET['id']) : 0;
        if (!$id || !current_user_can('manage_woocommerce')) {
            wp_die(__('Action non autorisée.', 'one-page-cod'));
        }
        check_admin_referer('opc_trash_lead_' . $id);

        global $wpdb;
        $n = $wpdb->update(
            self::table_name(),
            array('trashed' => 1, 'updated_at' => current_time('mysql')),
            array('id' => $id)
        );
        $this->redirect_back('opc_trashed', (int) $n);
    }

    public function handle_restore_lead() {
        $id = isset($_GET['id']) ? absint($_GET['id']) : 0;
        if (!$id || !current_user_can('manage_woocommerce')) {
            wp_die(__('Action non autorisée.', 'one-page-cod'));
        }
        check_admin_referer('opc_restore_lead_' . $id);

        global $wpdb;
        $n = $wpdb->update(
            self::table_name(),
            array('trashed' => 0, 'updated_at' => current_time('mysql')),
            array('id' => $id)
        );
        $this->redirect_back('opc_restored', (int) $n);
    }

    // -------------------------------------------------------------------------
    // Admin — suppression définitive (unitaire)
    // -------------------------------------------------------------------------
    public function handle_delete_lead() {
        $id = isset($_GET['id']) ? absint($_GET['id']) : 0;
        if (!$id || !current_user_can('manage_woocommerce')) {
            wp_die(__('Action non autorisée.', 'one-page-cod'));
        }
        check_admin_referer('opc_delete_lead_' . $id);

        global $wpdb;
        $deleted = $wpdb->delete(self::table_name(), array('id' => $id), array('%d'));

        $this->redirect_back('opc_deleted', (int) $deleted);
    }

    // -------------------------------------------------------------------------
    // Admin — actions groupées : corbeille / restaurer / suppression définitive
    // -------------------------------------------------------------------------
    public function handle_leads_bulk() {
        if (!current_user_can('manage_woocommerce')) {
            wp_die(__('Action non autorisée.', 'one-page-cod'));
        }
        check_admin_referer('opc_leads_bulk');

        $bulk_action = isset($_POST['bulk_action']) ? sanitize_key($_POST['bulk_action']) : '';
        $ids = isset($_POST['lead_ids']) && is_array($_POST['lead_ids'])
            ? array_values(array_filter(array_map('absint', $_POST['lead_ids'])))
            : array();

        if (empty($ids) || !in_array($bulk_action, array('trash', 'restore', 'delete'), true)) {
            $this->redirect_back('', 0);
        }

        global $wpdb;
        $table        = self::table_name();
        $placeholders = implode(',', array_fill(0, count($ids), '%d'));

        if ($bulk_action === 'delete') {
            $n = (int) $wpdb->query(
                $wpdb->prepare("DELETE FROM {$table} WHERE id IN ({$placeholders})", $ids)
            );
            $this->redirect_back('opc_deleted', $n);
        } else {
            $trashed = ($bulk_action === 'trash') ? 1 : 0;
            $args    = array_merge(array($trashed, current_time('mysql')), $ids);
            $n = (int) $wpdb->query(
                $wpdb->prepare(
                    "UPDATE {$table} SET trashed = %d, updated_at = %s WHERE id IN ({$placeholders})",
                    $args
                )
            );
            $this->redirect_back($bulk_action === 'trash' ? 'opc_trashed' : 'opc_restored', $n);
        }
    }

    /**
     * Redirige vers la page (referer) en signalant le nombre d'éléments affectés.
     *
     * @param string $key   Clé de notice (opc_trashed|opc_restored|opc_deleted) ou '' pour aucune.
     * @param int    $count Nombre d'éléments affectés.
     */
    private function redirect_back($key, $count) {
        $target = wp_get_referer() ?: admin_url('admin.php?page=opc-leads');
        $target = remove_query_arg(array('opc_trashed', 'opc_restored', 'opc_deleted', '_wpnonce', 'action', 'id'), $target);
        if ($key && $count > 0) {
            $target = add_query_arg($key, (int) $count, $target);
        }
        wp_safe_redirect($target);
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
            'Date', 'Nom', 'Téléphone', 'Email', 'Adresse', 'Profil',
            'Produit', 'Variation', 'Quantité', 'Statut', 'Commande', 'Traité',
        ));

        foreach ($rows as $r) {
            fputcsv($out, array(
                mysql2date('d/m/Y H:i', $r->created_at),
                $r->name,
                $r->phone,
                $r->email,
                $r->address,
                $r->profil,
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
