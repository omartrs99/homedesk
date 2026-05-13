<?php
/**
 * Fonctions utilitaires pour One Page COD
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Obtenir les paramètres du plugin
 */
function opc_get_settings() {
    return get_option('opc_settings', array());
}

/**
 * Obtenir une option spécifique
 */
function opc_get_option($key, $default = '') {
    $settings = opc_get_settings();
    return isset($settings[$key]) ? $settings[$key] : $default;
}

/**
 * Vérifier si l'auto-détection est activée
 */
function opc_is_auto_detection_enabled() {
    return opc_get_option('enable_auto_detection', 'yes') === 'yes';
}

/**
 * Vérifier si les variations sont supportées
 */
function opc_is_variations_enabled() {
    return opc_get_option('enable_variations', 'yes') === 'yes';
}

/**
 * Vérifier si les emails sont activés
 */
function opc_is_email_enabled() {
    return opc_get_option('enable_email', 'yes') === 'yes';
}

/**
 * Formater un numéro de téléphone
 */
function opc_format_phone($phone) {
    // Supprimer tous les caractères non numériques sauf le +
    $phone = preg_replace('/[^0-9+]/', '', $phone);
    return $phone;
}

/**
 * Valider un numéro de téléphone
 */
function opc_validate_phone($phone) {
    $phone = opc_format_phone($phone);
    // Au moins 10 chiffres
    return preg_match('/^[+]?[0-9]{10,}$/', $phone);
}

/**
 * Obtenir le nombre de commandes OPC
 */
function opc_get_order_count() {
    $args = array(
        'limit' => -1,
        'meta_key' => '_opc_order',
        'meta_value' => 'yes',
        'return' => 'ids',
    );
    
    $orders = wc_get_orders($args);
    return count($orders);
}

/**
 * Vérifier si une commande est une commande OPC
 */
function opc_is_opc_order($order_id) {
    $order = wc_get_order($order_id);
    if (!$order) {
        return false;
    }
    
    return $order->get_meta('_opc_order') === 'yes';
}

/**
 * Ajouter une colonne dans la liste des commandes
 */
add_filter('manage_edit-shop_order_columns', 'opc_add_order_column');
function opc_add_order_column($columns) {
    $new_columns = array();
    
    foreach ($columns as $key => $column) {
        $new_columns[$key] = $column;
        
        // Ajouter après la colonne "order_number"
        if ($key === 'order_number') {
            $new_columns['opc_order'] = __('OPC', 'one-page-cod');
        }
    }
    
    return $new_columns;
}

/**
 * Afficher le contenu de la colonne OPC
 */
add_action('manage_shop_order_posts_custom_column', 'opc_order_column_content', 10, 2);
function opc_order_column_content($column, $post_id) {
    if ($column === 'opc_order') {
        $order = wc_get_order($post_id);
        if ($order && opc_is_opc_order($post_id)) {
            echo '<span class="dashicons dashicons-yes-alt" style="color: #46b450;" title="' . esc_attr__('Commande One Page COD', 'one-page-cod') . '"></span>';
        }
    }
}

/**
 * Ajouter un filtre pour les commandes OPC dans l'admin
 */
add_action('restrict_manage_posts', 'opc_add_order_filter');
function opc_add_order_filter() {
    global $typenow;
    
    if ('shop_order' === $typenow) {
        $current = isset($_GET['opc_filter']) ? $_GET['opc_filter'] : '';
        ?>
        <select name="opc_filter" id="opc_filter">
            <option value=""><?php _e('Toutes les commandes', 'one-page-cod'); ?></option>
            <option value="opc_only" <?php selected($current, 'opc_only'); ?>><?php _e('Commandes OPC uniquement', 'one-page-cod'); ?></option>
            <option value="non_opc" <?php selected($current, 'non_opc'); ?>><?php _e('Commandes non-OPC', 'one-page-cod'); ?></option>
        </select>
        <?php
    }
}

/**
 * Appliquer le filtre OPC
 */
add_filter('parse_query', 'opc_filter_orders');
function opc_filter_orders($query) {
    global $pagenow, $typenow;
    
    if ('edit.php' === $pagenow && 'shop_order' === $typenow) {
        if (isset($_GET['opc_filter']) && $_GET['opc_filter'] !== '') {
            $meta_query = array(
                'key' => '_opc_order',
            );
            
            if ($_GET['opc_filter'] === 'opc_only') {
                $meta_query['value'] = 'yes';
            } elseif ($_GET['opc_filter'] === 'non_opc') {
                $meta_query['compare'] = 'NOT EXISTS';
            }
            
            $query->set('meta_query', array($meta_query));
        }
    }
    
    return $query;
}

/**
 * Ajouter des métadonnées à la page de détail de la commande
 */
add_action('woocommerce_admin_order_data_after_order_details', 'opc_display_order_meta');
function opc_display_order_meta($order) {
    if (opc_is_opc_order($order->get_id())) {
        $order_date = $order->get_meta('_opc_order_date');
        ?>
        <div class="order_data_column" style="clear:both; padding-top:12px;">
            <h3><?php _e('Informations One Page COD', 'one-page-cod'); ?></h3>
            <p>
                <strong><?php _e('Type de commande:', 'one-page-cod'); ?></strong><br>
                <?php _e('Commande One Page COD', 'one-page-cod'); ?>
            </p>
            <?php if ($order_date) : ?>
            <p>
                <strong><?php _e('Date de création OPC:', 'one-page-cod'); ?></strong><br>
                <?php echo esc_html(date_i18n(get_option('date_format') . ' ' . get_option('time_format'), strtotime($order_date))); ?>
            </p>
            <?php endif; ?>
        </div>
        <?php
    }
}

/**
 * Hook pour personnaliser le comportement après la création d'une commande
 * Exemple d'utilisation dans un autre plugin ou theme:
 * 
 * add_action('opc_order_created', 'my_custom_function', 10, 2);
 * function my_custom_function($order_id, $customer_data) {
 *     // Votre code personnalisé
 * }
 */
