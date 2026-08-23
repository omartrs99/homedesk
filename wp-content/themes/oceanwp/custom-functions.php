<?php
if ( ! defined( 'ABSPATH' ) ) exit;

// =============================================================================
// GOOGLE ANALYTICS (GA4)
// =============================================================================
add_action( 'wp_head', function () { ?>
<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-T7VFMV5V4J"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-T7VFMV5V4J');
</script>
<?php }, 1 );

// Permet les mots de passe d'application en HTTP (environnement local uniquement)
add_filter( 'wp_is_application_passwords_available', '__return_true' );


// =============================================================================
// GUTENBERG — PRODUITS WOOCOMMERCE
// =============================================================================

// Retirer les filtres WooCommerce qui bloquent Gutenberg sur les produits
add_action( 'init', function () {
	remove_filter( 'use_block_editor_for_post_type', [ 'WC_Post_Types', 'gutenberg_can_edit_post_type' ], 10 );
	remove_filter( 'gutenberg_can_edit_post_type',   [ 'WC_Post_Types', 'gutenberg_can_edit_post_type' ], 10 );
}, 20 );

// Callback du filtre déjà hookée dans functions.php:78
function enable_gutenberg_for_products( $can_edit, $post_type ) {
	return ( 'product' === $post_type ) ? true : $can_edit;
}

// Sécurité : hook supplémentaire à priorité haute pour garantir l'override
add_filter( 'use_block_editor_for_post_type', 'enable_gutenberg_for_products', 100, 2 );

// Réactiver le support editor sur le CPT product (WooCommerce peut le retirer)
add_action( 'init', function () {
	add_post_type_support( 'product', 'editor' );
}, 25 );


// =============================================================================
// CHAMP PERSONNALISÉ — HOOK PRODUIT
// =============================================================================

// Enregistrer le meta field _hook_produit (show_in_rest requis pour Gutenberg)
add_action( 'init', function () {
	register_post_meta( 'product', '_hook_produit', [
		'show_in_rest'  => true,
		'single'        => true,
		'type'          => 'string',
		'default'       => '',
		'auth_callback' => function () {
			return current_user_can( 'edit_posts' );
		},
	] );
} );

// Meta box — container div pour le block editor React
add_action( 'add_meta_boxes', function () {
	add_meta_box(
		'hook-produit',
		'Hook Produit',
		function () {
			echo '<div id="hook-produit-editor-container" style="min-height:250px;"></div>';
		},
		'product',
		'normal',
		'high'
	);
} );

// Enqueue JS du block editor uniquement sur la page d'édition produit
add_action( 'enqueue_block_editor_assets', function () {
	global $post;
	if ( ! $post || 'product' !== $post->post_type ) {
		return;
	}
	wp_enqueue_script(
		'homedesk-hook-produit',
		get_template_directory_uri() . '/assets/js/hook-produit-editor.js',
		[ 'wp-plugins', 'wp-edit-post', 'wp-element', 'wp-block-editor',
		  'wp-blocks', 'wp-components', 'wp-data', 'wp-dom-ready' ],
		'1.0.0',
		true
	);
} );


// =============================================================================
// FRONTEND — AFFICHAGE DU HOOK PRODUIT
// =============================================================================

// Afficher _hook_produit avant la description courte  sur la page produit
add_action( 'woocommerce_single_product_summary', function () {
	global $post;
	$content = get_post_meta( $post->ID, '_hook_produit', true );
	if ( ! $content ) {
		return;
	}
	echo '<div class="hook-produit">';
	echo wp_kses_post( apply_filters( 'the_content', $content ) );
	echo '</div>';
}, 1 );


// =============================================================================
// TEMPLATE PRODUIT EMPILÉ (stacked)
// =============================================================================

// Enregistrer la meta _product_template
add_action( 'init', function () {
	register_post_meta( 'product', '_product_template', [
		'type'          => 'string',
		'single'        => true,
		'show_in_rest'  => false,
		'default'       => '',
		'auth_callback' => function () {
			return current_user_can( 'edit_posts' );
		},
	] );
} );

// Meta box — sélecteur de mise en page dans l'éditeur produit
add_action( 'add_meta_boxes', function () {
	add_meta_box(
		'product_template_selector',
		'Mise en page du produit',
		function ( $post ) {
			$val = get_post_meta( $post->ID, '_product_template', true );
			wp_nonce_field( 'save_product_template', '_pt_nonce' );
			?>
			<select name="product_template" style="width:100%">
				<option value=""        <?php selected( $val, '' );        ?>>Défaut (galerie + summary côte à côte)</option>
				<option value="stacked" <?php selected( $val, 'stacked' ); ?>>Empilé (hook_produit → galerie → description → tabs)</option>
			</select>
			<?php
		},
		'product', 'side', 'high'
	);
} );

// Sauvegarder la meta _product_template
add_action( 'save_post_product', function ( $post_id ) {
	if ( ! isset( $_POST['_pt_nonce'] ) || ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['_pt_nonce'] ) ), 'save_product_template' ) ) {
		return;
	}
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	if ( ! current_user_can( 'edit_post', $post_id ) ) {
		return;
	}
	$val = isset( $_POST['product_template'] ) ? sanitize_key( $_POST['product_template'] ) : '';
	if ( $val ) {
		update_post_meta( $post_id, '_product_template', $val );
	} else {
		delete_post_meta( $post_id, '_product_template' );
	}
} );

// Charger le template empilé pour les produits qui l'ont sélectionné
add_filter( 'wc_get_template_part', function ( $template, $slug, $name ) {
	if ( 'content' === $slug && 'single-product' === $name && is_product() ) {
		$post_id = get_the_ID();
		if ( $post_id && 'stacked' === get_post_meta( $post_id, '_product_template', true ) ) {
			$custom = get_template_directory() . '/woocommerce/content-single-product-stacked.php';
			if ( file_exists( $custom ) ) {
				return $custom;
			}
		}
	}
	return $template;
}, 10, 3 );


// =============================================================================
// SHORTCODE — CAROUSEL CLIENTS [homedesk_carousel]
// =============================================================================

add_shortcode( 'homedesk_carousel', function () {
    $dir_path = get_template_directory()     . '/assets/img/carousel-clients-homedesk/';
    $dir_url  = get_template_directory_uri() . '/assets/img/carousel-clients-homedesk/';

    if ( ! is_dir( $dir_path ) ) return '';

    $images = [];
    foreach ( scandir( $dir_path ) as $file ) {
        if ( in_array( strtolower( pathinfo( $file, PATHINFO_EXTENSION ) ), [ 'jpg', 'jpeg', 'png', 'webp' ], true ) ) {
            $images[] = $dir_url . $file;
        }
    }

    if ( empty( $images ) ) return '';

    ob_start(); ?>
    <div class="hd-carousel-block">
        <div class="hd-carousel-block__inner">
            <div class="swiper hd-carousel-swiper">
                <div class="swiper-wrapper">
                    <?php foreach ( $images as $src ) : ?>
                    <div class="swiper-slide">
                        <div class="hd-carousel-slide">
                            <img src="<?php echo esc_url( $src ); ?>" alt="Avis client HomeDesk" loading="lazy">
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
                <div class="swiper-pagination hd-carousel-pagination"></div>
                <div class="swiper-button-prev hd-carousel-prev"></div>
                <div class="swiper-button-next hd-carousel-next"></div>
            </div>
        </div>
    </div>
    <?php
    return ob_get_clean();
} );


// Désactiver l'onglet avis clients
add_filter( 'woocommerce_product_tabs', function( $tabs ) {
    unset( $tabs['reviews'] );
    return $tabs;
} );


// Badge de réduction dynamique sur les pages produit
add_filter( 'woocommerce_get_price_html', function( $price_html, $product ) {
    if ( ! is_product() || ! $product->is_on_sale() ) {
        return $price_html;
    }
    $regular = (float) $product->get_regular_price();
    $sale    = (float) $product->get_sale_price();
    if ( $regular <= 0 || $sale <= 0 ) {
        return $price_html;
    }
    $pct = round( ( 1 - $sale / $regular ) * 100 );
    return $price_html . '<span class="opc-discount-badge">-' . $pct . '%</span>';
}, 10, 2 );


// =============================================================================
// SÉCURITÉ — VERSION & ÉNUMÉRATION
// =============================================================================

// Supprimer la version WordPress du <head>, des flux RSS et des URLs de scripts/styles
remove_action( 'wp_head', 'wp_generator' );
add_filter( 'the_generator', '__return_empty_string' );
add_filter( 'style_loader_src', function ( $src ) {
	return $src ? remove_query_arg( 'ver', $src ) : $src;
} );

// Bloquer l'énumération des utilisateurs via /?author=1
add_action( 'template_redirect', function () {
	if ( is_author() ) {
		wp_redirect( home_url(), 301 );
		exit;
	}
} );


// =============================================================================
// PERFORMANCE — PRELOAD LCP (ogb-columns-bg)
// =============================================================================

// render_block capture l'URL du ogb-columns-bg et la stocke en transient (chemin relatif).
// wp_head la lit au prochain chargement et injecte le preload — sans output buffering.
add_filter( 'render_block', function ( $content, $block ) {
	if ( get_transient( 'homedesk_lcp_url_v2' ) ) return $content;
	if ( ! is_front_page() ) return $content;
	if ( strpos( $content, 'ogb-columns-bg' ) === false ) return $content;
	// Le HTML encode les guillemets en &quot; et peut avoir un espace après ':'.
	if ( preg_match( '#background-image:\s*url\(["\']?([^)"\']+)["\']?\)#', html_entity_decode( $content ), $m ) ) {
		$full_url = trim( $m[1] );
		if ( filter_var( $full_url, FILTER_VALIDATE_URL ) ) {
			set_transient( 'homedesk_lcp_url_v2', $full_url, WEEK_IN_SECONDS );
		}
	}
	return $content;
}, 10, 2 );

add_action( 'wp_head', function () {
	if ( ! is_front_page() ) return;
	$lcp_url = get_transient( 'homedesk_lcp_url_v2' );
	if ( $lcp_url ) {
		echo '<link rel="preload" as="image" fetchpriority="high" href="' . esc_url( $lcp_url ) . '">' . "\n";
	}
}, 1 );

add_action( 'wp_enqueue_scripts', function () {
    wp_dequeue_style( 'wp-block-library' );
    wp_dequeue_style( 'wp-block-library-theme' );
    wp_dequeue_style( 'wc-blocks-style' );
}, 100 );

add_filter( 'style_loader_tag', function ( $tag, $handle ) {
    $async_styles = [ 'font-awesome', 'simple-line-icons' ];
    if ( in_array( $handle, $async_styles, true ) ) {
        $tag = str_replace(
            "rel='stylesheet'",
            "rel='preload' as='style' onload=\"this.onload=null;this.rel='stylesheet'\"",
            $tag
        );
        $tag .= '<noscript>' . str_replace(
            "rel='preload' as='style' onload=\"this.onload=null;this.rel='stylesheet'\"",
            "rel='stylesheet'",
            $tag
        ) . '</noscript>';
    }
    return $tag;
}, 10, 2 );

add_filter( 'script_loader_tag', function ( $tag, $handle ) {
    $defer_scripts = [ 'oceanwp-custom', 'swiper-js', 'cookieyes', 'cky-header', 'cookie-law-info' ];
    if ( in_array( $handle, $defer_scripts, true ) ) {
        return str_replace( ' src=', ' defer src=', $tag );
    }
    return $tag;
}, 10, 2 );

add_action( 'wp_head', function () {
    if ( is_product() ) {
        $hero = get_template_directory_uri() . '/assets/img/homedesk-bureau-assis-debout-pc-hero-1.jpg';
        echo '<link rel="preload" as="image" href="' . esc_url( $hero ) . '" fetchpriority="high">' . "\n";
    }
}, 1 );


// =============================================================================
// ACCESSIBILITÉ — ALT IMAGES TESTIMONIALS
// =============================================================================

add_filter( 'render_block', function ( $block_content, $block ) {
    if ( 'ogb/testimonial' !== $block['blockName'] ) {
        return $block_content;
    }

    // Priorité 1 : alt défini dans la médiathèque WP (champ "Texte alternatif")
    $media_id = ! empty( $block['attrs']['mediaId'] ) ? (int) $block['attrs']['mediaId'] : 0;
    $alt      = $media_id ? trim( get_post_meta( $media_id, '_wp_attachment_image_alt', true ) ) : '';

    // Priorité 2 : prénom de la personne
    if ( '' === $alt && ! empty( $block['attrs']['personName'] ) ) {
        $alt = 'Photo de ' . esc_attr( $block['attrs']['personName'] );
    }

    // Priorité 3 : valeur générique
    if ( '' === $alt ) {
        $alt = 'Témoignage client';
    }

    $block_content = preg_replace_callback(
        '/<img\b([^>]*)>/i',
        function ( $matches ) use ( $alt ) {
            $attrs = $matches[1];
            if ( false === strpos( $attrs, 'alt=' ) ) {
                $attrs .= ' alt="' . esc_attr( $alt ) . '"';
            }
            return '<img' . $attrs . '>';
        },
        $block_content
    );

    // Liens décoratifs href="#" → spans (délimiteur ~ pour éviter conflit avec # dans l'URL)
    foreach ( [ 'ogb-testimonial-name', 'ogb-testimonial-company' ] as $cls ) {
        $block_content = preg_replace(
            '~<a\s[^>]*class="' . $cls . '"[^>]*href="#">(.*?)</a>~is',
            '<span class="' . $cls . '">$1</span>',
            $block_content
        );
    }

    return $block_content;
}, 10, 2 );

// Déqueue la copie OGB de Font Awesome (même version que le thème — évite le double chargement)
add_action( 'wp_enqueue_scripts', function () {
    wp_dequeue_style( 'fontawesome' );
    wp_deregister_style( 'fontawesome' );
}, 1000 );


// =============================================================================
// ACCESSIBILITÉ — WHATSAPP BUTTON ARIA-LABEL
// =============================================================================

// Le plugin qlwapp (wp-whatsapp-chat) génère un bouton sans texte ni aria-label.
// Ce snippet inline s'exécute après le rendu pour corriger l'attribut manquant.
add_action( 'wp_footer', function () {
    ?>
    <script>
    (function(){
        var btn = document.querySelector('.qlwapp__button');
        if (btn && !btn.getAttribute('aria-label')) {
            btn.setAttribute('aria-label', 'Ouvrir le chat WhatsApp');
        }
    })();
    </script>
    <?php
} );


// Téléphone obligatoire — Région et Code postal facultatifs
add_filter( 'woocommerce_checkout_fields', function ( $fields ) {
	$fields['billing']['billing_phone']['required']    = true;
	$fields['billing']['billing_state']['required']    = false;
	$fields['billing']['billing_postcode']['required'] = false;
	return $fields;
} );

// Bouton "Retour à la boutique" → redirige vers la page d'accueil
add_filter( 'woocommerce_return_to_shop_redirect', function() {
    return home_url( '/' );
} );
add_filter( 'woocommerce_return_to_shop_text', function() {
    return __( 'Retour à la page d\'accueil', 'woocommerce' );
} );


// =============================================================================
// RÉSEAUX SOCIAUX — FOOTER MOBILE
// =============================================================================

// Réinjecte le bloc social du topbar dans le footer (après #copyright),
// uniquement visible en mobile via CSS. L'id est renommé en "footer-social"
// pour ne pas avoir deux éléments avec le même id sur la page.
add_action( 'ocean_after_footer_bottom_inner', function () {
	ob_start();
	get_template_part( 'partials/topbar/social' );
	$html = ob_get_clean();
	if ( ! $html ) return;
	$html = str_replace( 'id="top-bar-social"', 'id="footer-social"', $html );
	$html = preg_replace( '/\b(top-bar-left|top-bar-right|top-bar-centered)\b/', '', $html );
	echo '<div class="footer-social-wrap container clr">' . $html . '</div>';
} );

// Attribution de commande OPC — affiche "Form COD" au lieu de "Inconnu"
add_filter( 'wc_order_attribution_origin_label', function( $label, $source_type, $source ) {
	if ( 'Form COD' === $source ) {
		return ''; // Pas de préfixe "Source: " → WooCommerce affiche directement la source
	}
	return $label;
}, 10, 3 );

add_filter( 'rest_endpoints', function( $endpoints ) {
    if ( ! is_user_logged_in() ) {
        unset( $endpoints['/wp/v2/users'] );
        unset( $endpoints['/wp/v2/users/(?P<id>[\d]+)'] );
    }
    return $endpoints;
} );


add_filter('gettext', function($translated, $text, $domain) {

    if ($domain === 'woocommerce') {
        if (
            strpos($text, 'Shipping options') !== false ||
            strpos($text, 'updated during checkout') !== false
        ) {
            return '';
        }
    }

    return $translated;

}, 10, 3);

/* ── Shortcode [homedesk_comparatif] ───────────────────────── */
add_shortcode( 'homedesk_comparatif', function () {
    $img_base = plugins_url( 'one-page-cod/assets/images/' );
    $img_m    = $img_base . 'homedesk-bureau-assis-debout-pc-hero-medium.jpg';
    $img_l    = $img_base . 'homedesk-bureau-assis-debout-pc-hero-large.jpg';

    $check = '<svg class="hd-comp__check" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="#318b82" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>';
    $cross = '<svg class="hd-comp__cross" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="#c0392b" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>';
    $bag   = '🧳';

    ob_start(); ?>
    <div class="hd-comp">
      <table class="hd-comp__table">
        <thead>
          <tr>
            <th class="hd-comp__th-feat">Caractéristique</th>
            <th class="hd-comp__th">Modèle<br><strong>MÉDIUM</strong></th>
            <th class="hd-comp__th hd-comp__th--large">Modèle<br><strong>LARGE</strong></th>
          </tr>
        </thead>
        <tbody>

          <!-- Images -->
          <tr class="hd-comp__img-row">
            <td class="hd-comp__feat-cell"></td>
            <td class="hd-comp__td">
              <img src="<?php echo esc_url($img_m); ?>" alt="HomeDesk Médium" class="hd-comp__product-img img-popup">
            </td>
            <td class="hd-comp__td hd-comp__td--large">
              <img src="<?php echo esc_url($img_l); ?>" alt="HomeDesk Large" class="hd-comp__product-img img-popup">
            </td>
          </tr>

          <!-- Recommandé si vous mesurez -->
          <tr>
            <td class="hd-comp__feat-cell">
              <div class="hd-comp__feat-inner">
                <span class="hd-comp__icon"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 2v20"/><path d="M5 5l7-3 7 3"/><path d="M5 19l7 3 7-3"/><line x1="8" y1="12" x2="16" y2="12"/></svg></span>
                <span>Recommandé<br>si vous mesurez</span>
              </div>
            </td>
            <td class="hd-comp__td"><b>Taille max : 1,87 m</b></td>
            <td class="hd-comp__td hd-comp__td--large"><b>Plus de 1,87 m</b></td>
          </tr>

          <!-- Largeur / Profondeur -->
          <tr>
            <td class="hd-comp__feat-cell">
              <div class="hd-comp__feat-inner">
                <span class="hd-comp__icon"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="15 3 21 3 21 9"/><polyline points="9 21 3 21 3 15"/><line x1="21" y1="3" x2="14" y2="10"/><line x1="3" y1="21" x2="10" y2="14"/></svg></span>
                <span>Largeur /<br>Profondeur</span>
              </div>
            </td>
            <td class="hd-comp__td">36cm / 22cm</td>
            <td class="hd-comp__td hd-comp__td--large">45cm / 34cm</td>
          </tr>

          <!-- Hauteur -->
          <tr>
            <td class="hd-comp__feat-cell">
              <div class="hd-comp__feat-inner">
                <span class="hd-comp__icon"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="20" x2="12" y2="4"/><polyline points="6 10 12 4 18 10"/><polyline points="6 14 12 20 18 14"/></svg></span>
                <span>Hauteur</span>
              </div>
            </td>
            <td class="hd-comp__td"><b>55cm</b></td>
            <td class="hd-comp__td hd-comp__td--large"><b>68cm</b></td>
          </tr>

          <!-- Étagère supérieure -->
          <tr>
            <td class="hd-comp__feat-cell">
              <div class="hd-comp__feat-inner">
                <span class="hd-comp__icon"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="3" width="20" height="3" rx="1"/><rect x="2" y="10" width="20" height="3" rx="1"/><line x1="6" y1="6" x2="6" y2="10"/><line x1="18" y1="6" x2="18" y2="10"/></svg></span>
                <span>Étagère<br>supérieure (PC / Écran)</span>
              </div>
            </td>
            <td class="hd-comp__td">40 cm × 27 cm</td>
            <td class="hd-comp__td hd-comp__td--large">40 cm × 27 cm</td>
          </tr>

          <!-- Étagère inférieure -->
          <tr>
            <td class="hd-comp__feat-cell">
              <div class="hd-comp__feat-inner">
                <span class="hd-comp__icon"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="11" width="20" height="3" rx="1"/><rect x="2" y="18" width="20" height="3" rx="1"/><line x1="6" y1="14" x2="6" y2="18"/><line x1="18" y1="14" x2="18" y2="18"/></svg></span>
                <span>Étagère<br>inférieure (Clavier, Souris)</span>
              </div>
            </td>
            <td class="hd-comp__td"><b>54 cm × 22 cm</b></td>
            <td class="hd-comp__td hd-comp__td--large"><b>54 cm × 27 cm</b></td>
          </tr>

          <!-- Étagère pour Tél / Tablette -->
          <tr>
            <td class="hd-comp__feat-cell">
              <div class="hd-comp__feat-inner">
                <span class="hd-comp__icon"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="5" y="2" width="14" height="20" rx="2" ry="2"/><line x1="12" y1="18" x2="12" y2="18"/></svg></span>
                <span>Étagère pour<br>Tél / Tablette</span>
              </div>
            </td>
            <td class="hd-comp__td"><?php echo $cross; ?> <b>Non inclus</b></td>
            <td class="hd-comp__td hd-comp__td--large"><?php echo $check; ?> <b>Inclus</b></td>
          </tr>

          <!-- Poids -->
          <tr>
            <td class="hd-comp__feat-cell">
              <div class="hd-comp__feat-inner">
                <span class="hd-comp__icon"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M6 2 3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"/><line x1="3" y1="6" x2="21" y2="6"/><path d="M16 10a4 4 0 0 1-8 0"/></svg></span>
                <span>Poids du support</span>
              </div>
            </td>
            <td class="hd-comp__td"><b>7,5 kg</b></td>
            <td class="hd-comp__td hd-comp__td--large"><b>5 kg</b></td>
          </tr>

          <!-- Max PC -->
          <tr>
            <td class="hd-comp__feat-cell">
              <div class="hd-comp__feat-inner">
                <span class="hd-comp__icon"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="3" width="20" height="14" rx="2" ry="2"/><line x1="8" y1="21" x2="16" y2="21"/><line x1="12" y1="17" x2="12" y2="21"/></svg></span>
                <span>Max PC</span>
              </div>
            </td>
            <td class="hd-comp__td"><?php /* echo $check; */ ?> 17 pouces</td>
            <td class="hd-comp__td hd-comp__td--large"><?php /* echo $check; */ ?> 17 pouces</td>
          </tr>

          <!-- Sac offer -->
          <tr>
            <td class="hd-comp__feat-cell">
              <div class="hd-comp__feat-inner">
                <span class="hd-comp__icon"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="7" width="20" height="14" rx="2"/><path d="M16 7V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v2"/></svg></span>
                <span>Sac offert</span>
              </div>
            </td>
            <td class="hd-comp__td"><?php echo $check; ?> <?php echo '<b>Inclus</b>' //$bag; ?></td>
            <td class="hd-comp__td hd-comp__td--large"><?php echo $check; ?> <?php echo '<b>Inclus</b>' //$bag; ?></td>
          </tr>

          <!-- Prix -->
          <tr class="hd-comp__prix-row">
            <td class="hd-comp__feat-cell">Prix</td>
            <td class="hd-comp__td hd-comp__prix-medium">
              <span class="hd-comp__prix-old"><del>219 TND</del></span>
              <span class="hd-comp__prix-amount">199 TND</span>
              <!--<small>(Normal)</small>-->
            </td>
            <td class="hd-comp__td hd-comp__td--large hd-comp__prix-large">
              <span class="hd-comp__prix-old"><del>229 TND</del></span>
              <span class="hd-comp__prix-amount">209 TND</span>
              <!--<small>(Normal)</small>-->
            </td>
          </tr>

        </tbody>
      </table>
      <div class="hd-comp__cta-wrap">
        <a href="#opc-form-container" class="hd-comp__cta-btn">Commander maintenant</a>
      </div>
    </div>
    <?php
    return ob_get_clean();
} );