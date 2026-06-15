<?php
if ( ! defined( 'ABSPATH' ) ) exit;

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
	if ( get_transient( 'homedesk_lcp_url' ) ) return $content;
	if ( ! is_front_page() ) return $content;
	if ( strpos( $content, 'ogb-columns-bg' ) === false ) return $content;
	if ( preg_match( '#style="background-image:url\(([^)]+)\)#', $content, $m ) ) {
		$full_url = trim( $m[1], "\"' " );
		set_transient( 'homedesk_lcp_url', $full_url, WEEK_IN_SECONDS );
	}
	return $content;
}, 10, 2 );

add_action( 'wp_head', function () {
	if ( ! is_front_page() ) return;
	$lcp_path = get_transient( 'homedesk_lcp_url' );
	if ( $lcp_path ) {
		echo '<link rel="preload" as="image" fetchpriority="high" href="' . esc_url( $lcp_path ) . '">' . "\n";
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
    $defer_scripts = [ 'oceanwp-custom', 'swiper-js' ];
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
    if ( 'ocean-gutenberg-blocks/testimonial' !== $block['blockName'] ) {
        return $block_content;
    }

    $person_name = ! empty( $block['attrs']['personName'] ) ? esc_attr( $block['attrs']['personName'] ) : '';
    $alt         = $person_name ? 'Photo de ' . $person_name : 'Témoignage client';

    $block_content = preg_replace_callback(
        '/<img\b([^>]*)>/i',
        function ( $matches ) use ( $alt ) {
            $attrs = $matches[1];
            if ( false === strpos( $attrs, 'alt=' ) ) {
                $attrs .= ' alt="' . $alt . '"';
            }
            return '<img' . $attrs . '>';
        },
        $block_content
    );

    return $block_content;
}, 10, 2 );

// Bouton "Retour à la boutique" → redirige vers la page d'accueil
add_filter( 'woocommerce_return_to_shop_redirect', function() {
    return home_url( '/' );
} );
add_filter( 'woocommerce_return_to_shop_text', function() {
    return __( 'Retour à la page d\'accueil', 'woocommerce' );
} );