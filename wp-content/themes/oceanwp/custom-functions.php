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

// =============================================================================
// META PIXEL (Facebook) — ID + code de base
// =============================================================================
// Funnel HomeDesk : PageView (base) → ViewContent → InitiateCheckout → Lead → Purchase
// Étape 4 : code de base + PageView uniquement. Les autres events sont branchés séparément.

if ( ! defined( 'HOMEDESK_META_PIXEL_ID' ) ) {
	define( 'HOMEDESK_META_PIXEL_ID', '2278544406271252' );
}

add_action( 'wp_head', function () { ?>
<!-- Meta Pixel Code -->
<script>
!function(f,b,e,v,n,t,s)
{if(f.fbq)return;n=f.fbq=function(){n.callMethod?
n.callMethod.apply(n,arguments):n.queue.push(arguments)};
if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
n.queue=[];t=b.createElement(e);t.async=!0;
t.src=v;s=b.getElementsByTagName(e)[0];
s.parentNode.insertBefore(t,s)}(window, document,'script',
'https://connect.facebook.net/en_US/fbevents.js');
fbq('init', '<?php echo esc_js( HOMEDESK_META_PIXEL_ID ); ?>');

// Helper : déclenche l'event côté navigateur ET le relaie en CAPI serveur.
// Le même event_id est utilisé des deux côtés → Meta déduplique automatiquement.
window.hdCapi = {
	ajax: '<?php echo esc_js( admin_url( 'admin-ajax.php' ) ); ?>',
	nonce: '<?php echo esc_js( wp_create_nonce( 'hd_capi' ) ); ?>'
};
window.hdTrack = function (name, custom, user) {
	custom = custom || {};
	var eid = (window.crypto && crypto.randomUUID)
		? crypto.randomUUID()
		: (name + '-' + Date.now() + '-' + Math.random().toString(36).slice(2));
	fbq('track', name, custom, { eventID: eid });
	try {
		var cookie = function (k) {
			var r = document.cookie.match(new RegExp('(^| )' + k + '=([^;]+)'));
			return r ? r[2] : '';
		};
		var body = new URLSearchParams();
		body.append('action', 'opc_capi');
		body.append('nonce', window.hdCapi.nonce);
		body.append('event_name', name);
		body.append('event_id', eid);
		body.append('event_source_url', location.href);
		body.append('custom_data', JSON.stringify(custom));
		body.append('fbp', cookie('_fbp'));
		body.append('fbc', cookie('_fbc'));
		if (user) { body.append('user_data', JSON.stringify(user)); }
		fetch(window.hdCapi.ajax, {
			method: 'POST',
			headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
			body: body.toString(),
			keepalive: true
		}).catch(function () {});
	} catch (e) {}
	return eid;
};

fbq('track', 'PageView'); // PageView = navigateur uniquement (pas de relais CAPI)
</script>
<noscript><img height="1" width="1" style="display:none"
src="https://www.facebook.com/tr?id=<?php echo esc_attr( HOMEDESK_META_PIXEL_ID ); ?>&ev=PageView&noscript=1"
/></noscript>
<!-- End Meta Pixel Code -->
<?php }, 1 );

// -----------------------------------------------------------------------------
// META PIXEL — Données produit (réutilisées par ViewContent + events JS)
// -----------------------------------------------------------------------------
/**
 * Renvoie les données produit normalisées pour le tracking Meta.
 * Pour un produit variable, on prend la variation "Medium" par défaut,
 * afin que le prix corresponde à ce qu'affiche le formulaire COD au chargement.
 *
 * @param WC_Product $product
 * @return array
 */
function homedesk_get_product_pixel_data( $product ) {
	if ( ! $product instanceof WC_Product ) {
		return array();
	}

	$price = wc_get_price_to_display( $product );

	if ( 'variable' === $product->get_type() ) {
		$variations = $product->get_available_variations();
		if ( ! empty( $variations ) ) {
			$default = $variations[0];
			foreach ( $variations as $vd ) {
				foreach ( $vd['attributes'] as $av ) {
					if ( '' !== $av && false !== stripos( $av, 'med' ) ) {
						$default = $vd;
						break 2;
					}
				}
			}
			$var = wc_get_product( $default['variation_id'] );
			if ( $var ) {
				$price = wc_get_price_to_display( $var );
			}
		}
	}

	return array(
		'content_ids'  => array( (string) $product->get_id() ),
		'content_name' => $product->get_name(),
		'content_type' => 'product',
		'value'        => round( (float) $price, 2 ),
		'currency'     => get_woocommerce_currency(),
	);
}

// META PIXEL — ViewContent sur les pages de commande (fiches produit + landings)
add_action( 'wp_head', function () {
	if ( ! homedesk_is_order_page() ) {
		return;
	}

	$product = wc_get_product( homedesk_order_product_id() );
	$data    = homedesk_get_product_pixel_data( $product );

	if ( empty( $data ) ) {
		return;
	}
	?>
<!-- Meta Pixel — ViewContent -->
<script>
window.HD_PIXEL = <?php echo wp_json_encode( $data ); ?>;
hdTrack('ViewContent', window.HD_PIXEL);
</script>
<!-- End Meta Pixel — ViewContent -->
	<?php
}, 5 );

// META PIXEL — Charger le JS des events formulaire (InitiateCheckout, Lead, Purchase) sur les pages de commande
add_action( 'wp_enqueue_scripts', function () {
	if ( ! homedesk_is_order_page() ) {
		return;
	}
	wp_enqueue_script(
		'hd-pixel-events',
		get_template_directory_uri() . '/assets/js/hd-pixel-events.js',
		array(),
		'1.0.0',
		true
	);
} );

// =============================================================================
// META CAPI (Conversions API) — envoi serveur + déduplication via event_id
// =============================================================================
// Le token doit être défini dans wp-config.php :
//     define( 'HOMEDESK_CAPI_TOKEN', 'EAA...votre_token' );
// Optionnel, pour valider dans Events Manager > Tester les événements :
//     define( 'HOMEDESK_CAPI_TEST_CODE', 'TESTxxxxx' );

/**
 * Envoie un événement à la Conversions API de Meta (Graph API).
 * Sans token défini, la fonction ne fait rien (aucune erreur).
 */
function homedesk_send_capi_event( $event_name, $event_id, $custom_data = array(), $user_data = array(), $event_source_url = '', $fbp = '', $fbc = '' ) {
	if ( ! defined( 'HOMEDESK_CAPI_TOKEN' ) || ! HOMEDESK_CAPI_TOKEN ) {
		return; // CAPI désactivée tant qu'aucun token n'est configuré
	}
	if ( ! defined( 'HOMEDESK_META_PIXEL_ID' ) || ! HOMEDESK_META_PIXEL_ID ) {
		return;
	}

	$sha = function ( $v ) {
		$v = trim( strtolower( (string) $v ) );
		return '' !== $v ? hash( 'sha256', $v ) : null;
	};

	$ud = array();
	if ( ! empty( $user_data['email'] ) && is_email( $user_data['email'] ) ) {
		$ud['em'] = array( $sha( $user_data['email'] ) );
	}
	if ( ! empty( $user_data['phone'] ) ) {
		$digits = preg_replace( '/[^0-9]/', '', $user_data['phone'] );
		if ( $digits ) {
			$ud['ph'] = array( hash( 'sha256', $digits ) );
		}
	}
	if ( ! empty( $user_data['first_name'] ) ) { $ud['fn'] = array( $sha( $user_data['first_name'] ) ); }
	if ( ! empty( $user_data['last_name'] ) )  { $ud['ln'] = array( $sha( $user_data['last_name'] ) ); }
	if ( ! empty( $user_data['city'] ) )       { $ud['ct'] = array( $sha( $user_data['city'] ) ); }
	if ( $fbp ) { $ud['fbp'] = $fbp; }
	if ( $fbc ) { $ud['fbc'] = $fbc; }
	$ud['client_ip_address'] = $_SERVER['REMOTE_ADDR'] ?? '';
	$ud['client_user_agent'] = $_SERVER['HTTP_USER_AGENT'] ?? '';

	$event = array(
		'event_name'       => $event_name,
		'event_time'       => time(),
		'event_id'         => $event_id,
		'action_source'    => 'website',
		'event_source_url' => $event_source_url ? $event_source_url : home_url(),
		'user_data'        => $ud,
	);
	if ( ! empty( $custom_data ) ) {
		$event['custom_data'] = $custom_data;
	}

	$payload = array( 'data' => array( $event ) );
	if ( defined( 'HOMEDESK_CAPI_TEST_CODE' ) && HOMEDESK_CAPI_TEST_CODE ) {
		$payload['test_event_code'] = HOMEDESK_CAPI_TEST_CODE;
	}

	$endpoint = 'https://graph.facebook.com/v21.0/' . HOMEDESK_META_PIXEL_ID . '/events?access_token=' . urlencode( HOMEDESK_CAPI_TOKEN );

	wp_remote_post( $endpoint, array(
		'headers'  => array( 'Content-Type' => 'application/json' ),
		'body'     => wp_json_encode( $payload ),
		'timeout'  => 5,
		'blocking' => false, // fire-and-forget : ne ralentit pas le rendu
	) );
}

// Relais AJAX : le navigateur envoie ici PageView / ViewContent / InitiateCheckout / Lead
add_action( 'wp_ajax_opc_capi', 'homedesk_capi_relay' );
add_action( 'wp_ajax_nopriv_opc_capi', 'homedesk_capi_relay' );
function homedesk_capi_relay() {
	check_ajax_referer( 'hd_capi', 'nonce' );

	// PageView reste navigateur uniquement ; Purchase est envoyé directement côté serveur → tous deux exclus du relais
	$whitelist = array( 'ViewContent', 'InitiateCheckout', 'Lead' );
	$name = isset( $_POST['event_name'] ) ? sanitize_text_field( wp_unslash( $_POST['event_name'] ) ) : '';
	if ( ! in_array( $name, $whitelist, true ) ) {
		wp_send_json_error();
	}

	// Rate limiting léger par IP
	$ip_key   = 'hd_capi_rate_' . md5( $_SERVER['REMOTE_ADDR'] ?? '' );
	$attempts = (int) get_transient( $ip_key );
	if ( $attempts >= 60 ) {
		wp_send_json_error();
	}
	set_transient( $ip_key, $attempts + 1, 60 );

	$event_id = isset( $_POST['event_id'] ) ? sanitize_text_field( wp_unslash( $_POST['event_id'] ) ) : '';
	$url      = isset( $_POST['event_source_url'] ) ? esc_url_raw( wp_unslash( $_POST['event_source_url'] ) ) : '';
	$fbp      = isset( $_POST['fbp'] ) ? sanitize_text_field( wp_unslash( $_POST['fbp'] ) ) : '';
	$fbc      = isset( $_POST['fbc'] ) ? sanitize_text_field( wp_unslash( $_POST['fbc'] ) ) : '';
	$custom   = isset( $_POST['custom_data'] ) ? json_decode( wp_unslash( $_POST['custom_data'] ), true ) : array();
	$user     = isset( $_POST['user_data'] ) ? json_decode( wp_unslash( $_POST['user_data'] ), true ) : array();
	if ( ! is_array( $custom ) ) { $custom = array(); }
	if ( ! is_array( $user ) )   { $user = array(); }

	homedesk_send_capi_event( $name, $event_id, $custom, $user, $url, $fbp, $fbc );
	wp_send_json_success();
}

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
// Seulement quand ?ver= est la version de WordPress : les versions des fichiers du thème
// (filemtime) restent, sinon les navigateurs gardent un ancien CSS en cache après une modification.
add_filter( 'style_loader_src', function ( $src ) {
	if ( $src && false !== strpos( $src, 'ver=' . get_bloginfo( 'version' ) ) ) {
		$src = remove_query_arg( 'ver', $src );
	}
	return $src;
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
	if ( ! is_front_page() || homedesk_is_landing() ) return; // la landing précharge sa propre image hero
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
            <td class="hd-comp__td"><b>5 kg</b></td>
            <td class="hd-comp__td hd-comp__td--large"><b>7 kg</b></td>
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

/**
 * Bannière hero sur la page boutique (fournit le H1 SEO manquant).
 * Reproduit le style du banner "Notre Solution" (image de fond + voile noir + titre blanc).
 */
add_action( 'woocommerce_before_main_content', function () {
    if ( ! is_shop() ) {
        return;
    }

    // Image de fond de la bannière boutique
    $bg = get_template_directory_uri() . '/assets/img/banner-bootique-homedesk-standing-desk.jpg';
    ?>
    <section class="shop-hero" style="background-image:url('<?php echo esc_url( $bg ); ?>');">
        <span class="shop-hero__overlay" aria-hidden="true"></span>
        <div class="shop-hero__inner">
            <h1 class="shop-hero__title">Tout pour un bureau ergonomique qui soulage votre dos</h1>
            <a href="#content-wrap" class="shop-hero__btn">Prenez soin de votre posture <span aria-hidden="true">👇</span></a>
        </div>
    </section>
    <?php
}, 5 );

/**
 * Sur la page boutique : désactiver le header transparent (style "center").
 * Le header reste blanc/solide et la bannière .shop-hero s'affiche dessous,
 * au lieu que le menu se superpose à l'image (comme la page Notre Solution).
 */
add_filter( 'theme_mod_ocean_center_header_transparent', function ( $value ) {
    if ( function_exists( 'is_shop' ) && is_shop() ) {
        return false;
    }
    return $value;
} );
// =============================================================================
// LANDING PRODUIT — accueil + landings Meta Ads (/lp/{audience}/)
// =============================================================================
// Une page WordPress devient une landing en choisissant le modèle
// « Landing produit HomeDesk » (templates/landing-produit.php), puis l'audience,
// le produit et le profil dans la boîte « Landing HomeDesk ».

define( 'HOMEDESK_LANDING_TEMPLATE', 'templates/landing-produit.php' );

/** Audiences disponibles : slug => libellé (un fichier templates/landing/{slug}.php par audience). */
function homedesk_landing_audiences() {
	return array(
		'generale'     => 'Générale (accueil)',
		'developpeurs' => 'Développeurs',
		'designers'    => 'Designers',
		'dos-cou'      => 'Dos et cou',
		'freelances'   => 'Freelances',
		'etudiants'    => 'Étudiants',
	);
}

/** La page courante utilise-t-elle le modèle landing ? */
function homedesk_is_landing() {
	return is_page_template( HOMEDESK_LANDING_TEMPLATE );
}

/** Page avec formulaire de commande : fiche produit ou landing (tracking Pixel + abandons). */
function homedesk_is_order_page() {
	return ( function_exists( 'is_product' ) && is_product() ) || homedesk_is_landing();
}

/**
 * ID du produit vendu sur la page courante :
 * fiche produit → son ID ; landing → meta _lp_product_id ; sinon le produit principal.
 */
function homedesk_order_product_id() {
	if ( function_exists( 'is_product' ) && is_product() ) {
		return (int) get_queried_object_id();
	}
	if ( is_page() ) {
		$id = (int) get_post_meta( get_queried_object_id(), '_lp_product_id', true );
		if ( $id && 'product' === get_post_type( $id ) ) {
			return $id;
		}
	}
	return homedesk_default_product_id();
}

/** Produit principal : le premier produit publié qui utilise le modèle « stacked ». */
function homedesk_default_product_id() {
	static $id = null;
	if ( null === $id ) {
		$ids = get_posts( array(
			'post_type'      => 'product',
			'post_status'    => 'publish',
			'posts_per_page' => 1,
			'fields'         => 'ids',
			'meta_key'       => '_product_template',
			'meta_value'     => 'stacked',
			'orderby'        => 'date',
			'order'          => 'ASC',
		) );
		$id = $ids ? (int) $ids[0] : 0;
	}
	return $id;
}

/** Réglages de la landing courante (audience, produit, profil présélectionné). */
function homedesk_landing_settings( $post_id = 0 ) {
	$post_id  = $post_id ? $post_id : get_queried_object_id();
	$audience = get_post_meta( $post_id, '_lp_audience', true );
	if ( ! array_key_exists( $audience, homedesk_landing_audiences() ) ) {
		$audience = 'generale';
	}
	return array(
		'audience'   => $audience,
		'product_id' => homedesk_order_product_id(),
		'profil'     => (string) get_post_meta( $post_id, '_lp_profil', true ),
		'slug'       => (string) get_post_field( 'post_name', $post_id ),
	);
}

/**
 * Fichier d'une section de landing : la version de l'audience (templates/landing/{audience}/{section}.php)
 * si elle existe, sinon la version commune (templates/landing/sections/{section}.php).
 */
function homedesk_landing_section( $audience, $section ) {
	$dir = get_template_directory() . '/templates/landing/';
	$own = $dir . sanitize_key( $audience ) . '/' . sanitize_key( $section ) . '.php';
	return file_exists( $own ) ? $own : $dir . 'sections/' . sanitize_key( $section ) . '.php';
}

// Boîte « Landing HomeDesk » dans l'éditeur de page (même pattern que _product_template)
add_action( 'init', function () {
	foreach ( array( '_lp_audience', '_lp_profil' ) as $key ) {
		register_post_meta( 'page', $key, array(
			'type'              => 'string',
			'single'            => true,
			'show_in_rest'      => true,
			'sanitize_callback' => 'sanitize_text_field',
			'auth_callback'     => function () { return current_user_can( 'edit_pages' ); },
		) );
	}
	register_post_meta( 'page', '_lp_product_id', array(
		'type'              => 'integer',
		'single'            => true,
		'show_in_rest'      => true,
		'sanitize_callback' => 'absint',
		'auth_callback'     => function () { return current_user_can( 'edit_pages' ); },
	) );
} );

add_action( 'add_meta_boxes_page', function () {
	add_meta_box( 'homedesk_landing', 'Landing HomeDesk', 'homedesk_landing_meta_box', 'page', 'side', 'high' );
} );

function homedesk_landing_meta_box( $post ) {
	wp_nonce_field( 'homedesk_landing_save', 'homedesk_landing_nonce' );
	$audience   = get_post_meta( $post->ID, '_lp_audience', true );
	$product_id = (int) get_post_meta( $post->ID, '_lp_product_id', true );
	$profil     = get_post_meta( $post->ID, '_lp_profil', true );
	$products   = get_posts( array( 'post_type' => 'product', 'post_status' => 'publish', 'posts_per_page' => 50, 'orderby' => 'title', 'order' => 'ASC' ) );
	$profils    = function_exists( 'opc_get_profil_options' ) ? opc_get_profil_options() : array();
	?>
	<p style="margin-top:0">Utilisé uniquement avec le modèle <strong>Landing produit HomeDesk</strong>.</p>
	<p><label for="hd_lp_audience"><strong>Audience</strong></label><br>
		<select id="hd_lp_audience" name="hd_lp_audience" style="width:100%">
			<?php foreach ( homedesk_landing_audiences() as $slug => $label ) : ?>
				<option value="<?php echo esc_attr( $slug ); ?>" <?php selected( $audience ? $audience : 'generale', $slug ); ?>><?php echo esc_html( $label ); ?></option>
			<?php endforeach; ?>
		</select></p>
	<p><label for="hd_lp_product"><strong>Produit</strong></label><br>
		<select id="hd_lp_product" name="hd_lp_product" style="width:100%">
			<option value="0">Produit principal (par défaut)</option>
			<?php foreach ( $products as $p ) : ?>
				<option value="<?php echo esc_attr( $p->ID ); ?>" <?php selected( $product_id, $p->ID ); ?>><?php echo esc_html( $p->post_title . ' (#' . $p->ID . ')' ); ?></option>
			<?php endforeach; ?>
		</select></p>
	<p><label for="hd_lp_profil"><strong>Profil présélectionné</strong></label><br>
		<select id="hd_lp_profil" name="hd_lp_profil" style="width:100%">
			<option value="">Aucun</option>
			<?php foreach ( $profils as $opt ) : ?>
				<option value="<?php echo esc_attr( $opt ); ?>" <?php selected( $profil, $opt ); ?>><?php echo esc_html( $opt ); ?></option>
			<?php endforeach; ?>
		</select></p>
	<?php
}

add_action( 'save_post_page', function ( $post_id ) {
	if ( ! isset( $_POST['homedesk_landing_nonce'] ) || ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['homedesk_landing_nonce'] ) ), 'homedesk_landing_save' ) ) {
		return;
	}
	if ( ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) || ! current_user_can( 'edit_page', $post_id ) ) {
		return;
	}
	$audience = isset( $_POST['hd_lp_audience'] ) ? sanitize_key( wp_unslash( $_POST['hd_lp_audience'] ) ) : 'generale';
	if ( ! array_key_exists( $audience, homedesk_landing_audiences() ) ) {
		$audience = 'generale';
	}
	update_post_meta( $post_id, '_lp_audience', $audience );
	update_post_meta( $post_id, '_lp_product_id', isset( $_POST['hd_lp_product'] ) ? absint( $_POST['hd_lp_product'] ) : 0 );
	$profil = isset( $_POST['hd_lp_profil'] ) ? sanitize_text_field( wp_unslash( $_POST['hd_lp_profil'] ) ) : '';
	if ( $profil && function_exists( 'opc_get_profil_options' ) && ! in_array( $profil, opc_get_profil_options(), true ) ) {
		$profil = '';
	}
	update_post_meta( $post_id, '_lp_profil', $profil );
} );

// Assets : la landing a son propre design → on retire les styles du thème et des extensions
add_action( 'wp_enqueue_scripts', function () {
	if ( ! homedesk_is_landing() ) {
		return;
	}
	$dir  = get_template_directory_uri() . '/assets/landing/';
	$path = get_template_directory() . '/assets/landing/';
	// Polices : <link> écrit dans le template (WordPress fusionne les deux paramètres family=)
	wp_enqueue_style( 'homedesk-landing', $dir . 'landing.css', array( 'opc-styles' ), filemtime( $path . 'landing.css' ) );
	wp_enqueue_script( 'homedesk-landing', $dir . 'landing.js', array(), filemtime( $path . 'landing.js' ), true );
	// Styles propres à l'audience (thème, sections remplacées) : assets/landing/parts/{audience}.css
	$part = 'parts/' . homedesk_landing_settings()['audience'] . '.css';
	if ( file_exists( $path . $part ) ) {
		wp_enqueue_style( 'homedesk-landing-audience', $dir . $part, array( 'homedesk-landing' ), filemtime( $path . $part ) );
	}
}, 100 );

/**
 * Retire de la file les styles et scripts du thème / des extensions : ils attendent le DOM d'OceanWP
 * (header, panier, panneau latéral…) et plantent ou s'affichent sans lui sur la landing.
 * On garde la landing, le formulaire COD + abandons, le Pixel, l'attribution WooCommerce,
 * le lazy-load d'images, l'admin bar et WhatsApp (qlwapp-*). Les dépendances restent chargées par WordPress.
 */
function homedesk_landing_dequeue_styles() {
	if ( ! homedesk_is_landing() ) {
		return;
	}
	global $wp_styles, $wp_scripts;
	$keep_styles = array( 'homedesk-landing', 'homedesk-landing-audience', 'opc-styles', 'admin-bar', 'dashicons' );
	foreach ( (array) $wp_styles->queue as $handle ) {
		if ( ! in_array( $handle, $keep_styles, true ) && 0 !== strpos( $handle, 'qlwapp' ) ) {
			wp_dequeue_style( $handle );
		}
	}
	$keep_scripts = array( 'homedesk-landing', 'opc-scripts', 'opc-leads', 'hd-pixel-events', 'wc-order-attribution', 'eio-lazy-load', 'admin-bar' );
	foreach ( (array) $wp_scripts->queue as $handle ) {
		if ( ! in_array( $handle, $keep_scripts, true ) && 0 !== strpos( $handle, 'qlwapp' ) ) {
			wp_dequeue_script( $handle );
		}
	}
}
// CSS inline du thème (Customizer OceanWP + CSS additionnel) : inutile et en conflit sur la landing
add_action( 'wp', function () {
	if ( ! homedesk_is_landing() ) {
		return;
	}
	remove_action( 'wp_head', array( 'OCEANWP_Theme_Class', 'custom_css' ), 999 );
	remove_action( 'wp_head', 'wp_custom_css_cb', 101 );
	// Emojis natifs (sinon WordPress les remplace par des <img> dont le style est retiré)
	remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
	remove_action( 'wp_print_styles', 'print_emoji_styles' );
	remove_action( 'wp_enqueue_scripts', 'wp_enqueue_emoji_styles' );
} );
// Blocs du thème injectés en bas de page (aperçu rapide, mini-panier, panneau latéral) : inutiles sur la landing
add_action( 'wp_footer', function () {
	if ( ! homedesk_is_landing() ) {
		return;
	}
	global $wp_filter;
	$unwanted = array( 'quick_view_template', 'get_mini_cart_sidebar', 'get_off_canvas_sidebar', 'side_panel', 'side_panel_overlay' );
	if ( empty( $wp_filter['wp_footer'] ) ) {
		return;
	}
	foreach ( $wp_filter['wp_footer']->callbacks as $priority => $callbacks ) {
		foreach ( $callbacks as $cb ) {
			$fn = $cb['function'];
			if ( is_array( $fn ) && isset( $fn[1] ) && in_array( $fn[1], $unwanted, true ) ) {
				remove_action( 'wp_footer', $fn, $priority );
			}
		}
	}
}, 0 );
add_action( 'wp_print_scripts', 'homedesk_landing_dequeue_styles', 1 );         // scripts du <head>
add_action( 'wp_print_styles', 'homedesk_landing_dequeue_styles', 100 );        // styles du <head>
add_action( 'wp_print_footer_scripts', 'homedesk_landing_dequeue_styles', 1 );  // styles ajoutés en cours de page

// Abandons du formulaire (plugin one-page-cod) : aussi sur les landings
add_filter( 'opc_is_order_page', function ( $is ) {
	return $is || homedesk_is_landing();
} );

// La version sans sac s'appelle « HomeDesk Solo » (libellé affiché sur la commande)
add_filter( 'opc_nobag_label', function () {
	return 'HomeDesk Solo (sans sac)';
} );

// Formulaire COD : libellés des choix Taille / Version (même texte que la maquette product-page.html)
add_filter( 'opc_variation_label', function ( $label, $attribute ) {
	return 'pa_version' === $attribute ? 'Taille' : $label;
}, 10, 2 );
add_filter( 'opc_variation_option_hint', function ( $hint, $option ) {
	$hints = array(
		'medium' => "jusqu'à 1,87 m",
		'large'  => 'plus de 1,87 m',
	);
	return isset( $hints[ $option ] ) ? $hints[ $option ] : $hint;
}, 10, 2 );
add_filter( 'opc_bag_option_hint', function () {
	return 'offert · valeur 85 DT';
} );
add_filter( 'opc_nobag_short_label', function () {
	return 'Solo';
} );

/** Landing Ads = landing qui n'est pas la page d'accueil → noindex + hors sitemap. */
function homedesk_is_ads_landing( $post_id = 0 ) {
	$post_id = $post_id ? $post_id : get_queried_object_id();
	return $post_id
		&& HOMEDESK_LANDING_TEMPLATE === get_page_template_slug( $post_id )
		&& (int) get_option( 'page_on_front' ) !== (int) $post_id;
}

add_filter( 'wpseo_robots', function ( $robots ) {
	return ( is_page() && homedesk_is_ads_landing() ) ? 'noindex, follow' : $robots;
} );
add_filter( 'wp_robots', function ( $robots ) {
	if ( is_page() && homedesk_is_ads_landing() ) {
		$robots['noindex'] = true;
		$robots['follow']  = true;
	}
	return $robots;
} );
add_filter( 'wpseo_exclude_from_sitemap_by_post_ids', function ( $ids ) {
	$landing_ids = get_posts( array(
		'post_type'      => 'page',
		'posts_per_page' => -1,
		'fields'         => 'ids',
		'meta_key'       => '_wp_page_template',
		'meta_value'     => HOMEDESK_LANDING_TEMPLATE,
	) );
	$front = (int) get_option( 'page_on_front' );
	foreach ( $landing_ids as $id ) {
		if ( (int) $id !== $front ) {
			$ids[] = (int) $id;
		}
	}
	return $ids;
} );

// =============================================================================
// HEADER + FOOTER LÉGERS — pages internes (contact, histoire, fiche produit, retours…)
// =============================================================================
// Remplace le header / footer OceanWP par une version au style de la landing :
// logo, 3 liens, bouton « Commander ». La landing (modèle landing-produit) a son propre header.

/** Liens du pied de page, partagés par la landing et les pages internes. */
function homedesk_footer_links() {
	$links = array();
	$product_id = function_exists( 'homedesk_default_product_id' ) ? homedesk_default_product_id() : 0;
	/*if ( $product_id ) {
		$links[] = array( get_permalink( $product_id ), 'Fiche produit' );
	}*/
	$links[] = array( home_url( '/notre-histoire/' ), 'Notre histoire' );
	$links[] = array( home_url( '/contactez-nous/' ), 'Contact et offre entreprise' );
	$links[] = array( home_url( '/' . HOMEDESK_RETOURS_SLUG . '/' ), 'Retours et remboursement' );
	$privacy = get_privacy_policy_url();
	$links[] = array( $privacy ? $privacy : home_url( '/politique-de-confidentialite/' ), 'Confidentialité' );
	return $links;
}

/** Les pages internes utilisent le header / footer léger (tout le front sauf la landing). */
function homedesk_use_light_chrome() {
	return ! is_admin() && ! homedesk_is_landing();
}

add_action( 'wp', function () {
	if ( ! homedesk_use_light_chrome() ) {
		return;
	}
	add_filter( 'ocean_display_top_bar', '__return_false' );
	add_filter( 'ocean_display_header', '__return_false' );
	add_filter( 'ocean_display_footer_widgets', '__return_false' );
	add_filter( 'ocean_display_footer_bottom', '__return_false' );
	add_action( 'ocean_header', 'homedesk_light_header', 5 );
	add_action( 'ocean_footer', 'homedesk_light_footer', 5 );
} );

add_action( 'wp_enqueue_scripts', function () {
	if ( ! homedesk_use_light_chrome() ) {
		return;
	}
	$path = get_template_directory() . '/assets/css/site-chrome.css';
	wp_enqueue_style( 'homedesk-site-chrome', get_template_directory_uri() . '/assets/css/site-chrome.css', array(), filemtime( $path ) );
	// Polices de la charte (les deux family= dans une seule URL : enqueue impossible, WordPress les fusionne)
	add_action( 'wp_head', function () {
		echo '<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Montserrat:wght@700;800;900&family=Poppins:wght@400;500;600&display=swap">' . "
";
	}, 6 );

	$dir = get_template_directory();
	$uri = get_template_directory_uri();
	if ( homedesk_is_info_page() ) {
		wp_enqueue_style( 'homedesk-page-info', $uri . '/assets/css/page-info.css', array(), filemtime( $dir . '/assets/css/page-info.css' ) );
	}
	if ( is_page_template( 'templates/page-histoire.php' ) ) {
		wp_enqueue_style( 'homedesk-histoire-fonts', 'https://fonts.googleapis.com/css2?family=Fraunces:ital,opsz,wght@0,9..144,500;0,9..144,700;1,9..144,400;1,9..144,500&display=swap', array(), null );
		wp_enqueue_style( 'homedesk-page-histoire', $uri . '/assets/css/page-histoire.css', array(), filemtime( $dir . '/assets/css/page-histoire.css' ) );
		wp_enqueue_script( 'homedesk-histoire', $uri . '/assets/js/histoire.js', array(), filemtime( $dir . '/assets/js/histoire.js' ), true );
	}
}, 100 );

// Sticky header OceanWP : il cherche le header du thème (#site-header, absent avec le header léger)
// et plante à chaque défilement. L'extension le charge à la priorité 999 → on le retire après.
add_action( 'wp_enqueue_scripts', function () {
	if ( homedesk_use_light_chrome() ) {
		wp_dequeue_script( 'osh-js-scripts' );
		wp_dequeue_style( 'osh-styles' );
	}
}, 1000 );

/** Pages d'information (retours, contact, pages légales) : style commun page-info.css. */
function homedesk_is_info_page() {
	return is_page_template( 'templates/page-retours.php' ) || is_page_template( 'templates/page-legal.php' )
		|| is_page_template( 'templates/page-contact.php' ) || homedesk_is_privacy_page() || homedesk_is_contact_page();
}

/** Page contact (/contactez-nous/). */
function homedesk_is_contact_page() {
	return is_page( 'contactez-nous' );
}

/** Politique de confidentialité (réglage WordPress > Confidentialité). */
function homedesk_is_privacy_page() {
	$privacy_id = (int) get_option( 'wp_page_for_privacy_policy' );
	return $privacy_id && is_page( $privacy_id );
}

// La politique de confidentialité prend le modèle « Page d'information » sans réglage en base,
// (son texte reste modifiable dans l'éditeur WordPress)
// Idem pour la page contact avec le modèle « Contact HomeDesk »
add_filter( 'template_include', function ( $template ) {
	if ( 'default' !== ( get_page_template_slug() ?: 'default' ) ) {
		return $template; // un modèle choisi dans l'admin reste prioritaire
	}
	$file = '';
	if ( homedesk_is_privacy_page() ) {
		$file = 'templates/page-legal.php';
	} elseif ( homedesk_is_contact_page() ) {
		$file = 'templates/page-contact.php';
	}
	$found = $file ? locate_template( $file ) : '';
	return $found ? $found : $template;
} );

// Pages avec leur propre en-tête (retours, légales, histoire) : pas de bandeau titre OceanWP
add_filter( 'ocean_display_page_header', function ( $display ) {
	return ( homedesk_is_info_page() || is_page_template( 'templates/page-histoire.php' ) ) ? false : $display;
} );

function homedesk_light_header() {
	$current = untrailingslashit( strtok( home_url( add_query_arg( array() ) ), '?' ) );
	$nav = array(
		array( home_url( '/' ), 'Le produit' ),
		array( home_url( '/notre-histoire/' ), 'Notre histoire' ),
		array( home_url( '/contactez-nous/' ), 'Contact' ),
	);
	?>
	<div class="hd-chrome-topbar"><?php echo homedesk_topbar_content(); // phpcs:ignore -- HTML statique ?></div>
	<header class="hd-chrome-header">
		<div class="hd-chrome-header__inner">
			<a class="hd-chrome-header__logo" href="<?php echo esc_url( home_url( '/' ) ); ?>" aria-label="HomeDesk, accueil">
				<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/landing/img/logo.webp' ); ?>" alt="HomeDesk" width="160" height="22">
			</a>
			<nav class="hd-chrome-nav" aria-label="Menu principal">
				<?php foreach ( $nav as $item ) : ?>
					<a href="<?php echo esc_url( $item[0] ); ?>"<?php echo untrailingslashit( $item[0] ) === $current ? ' aria-current="page"' : ''; ?>><?php echo esc_html( $item[1] ); ?></a>
				<?php endforeach; ?>
			</nav>
			<a class="hd-chrome-header__cta" href="<?php echo esc_url( home_url( '/#commander' ) ); ?>">Commander</a>
		</div>
	</header>
	<?php
}

/** Contenu de la barre d'annonce en haut des pages (landings et pages internes) : icône garantie + texte. */
function homedesk_topbar_content() {
	return '<svg class="topbar-icon" viewBox="0 0 24 24" width="16" height="16" aria-hidden="true"><path d="M12 2 4 5v6c0 5 3.4 9.3 8 11 4.6-1.7 8-6 8-11V5l-8-3Z" fill="none" stroke="currentColor" stroke-width="2" stroke-linejoin="round"/><path d="m8.5 12 2.5 2.5 4.5-5" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>'
		. 'Testez-le 3 jours, satisfait ou remboursé';
}

/** Coordonnées HomeDesk (pages Contact, Retours, footers). */
function homedesk_contact_info() {
	return array(
		'email'        => 'contact@homedesk.tn',
		'whatsapp'     => '+216 56 923 420',
		'whatsapp_url' => 'https://wa.me/21656923420',
	);
}

/** Réseaux sociaux : [ url, nom, icône SVG ]. */
function homedesk_social_links() {
	return array(
		array( 'https://www.facebook.com/homedesktn', 'Facebook', '<svg viewBox="0 0 24 24" aria-hidden="true"><path d="M13.5 21v-7.5H16l.4-3h-2.9V8.6c0-.9.3-1.5 1.5-1.5h1.5V4.4c-.3 0-1.2-.1-2.2-.1-2.2 0-3.8 1.4-3.8 3.9v2.3H8v3h2.5V21h3z"/></svg>' ),
		array( 'https://www.instagram.com/homedesktn/', 'Instagram', '<svg viewBox="0 0 24 24" aria-hidden="true"><path d="M12 7.2a4.8 4.8 0 1 0 0 9.6 4.8 4.8 0 0 0 0-9.6zm0 7.9a3.1 3.1 0 1 1 0-6.2 3.1 3.1 0 0 1 0 6.2zm6.1-8.1a1.1 1.1 0 1 1-2.2 0 1.1 1.1 0 0 1 2.2 0zM12 4.6c2.4 0 2.7 0 3.7.1 2.4.1 3.5 1.2 3.6 3.6.1.9.1 1.2.1 3.7s0 2.8-.1 3.7c-.1 2.4-1.2 3.5-3.6 3.6-.9.1-1.2.1-3.7.1s-2.8 0-3.7-.1c-2.4-.1-3.5-1.2-3.6-3.6-.1-.9-.1-1.2-.1-3.7s0-2.8.1-3.7C4.8 5.9 5.9 4.8 8.3 4.7c.9-.1 1.2-.1 3.7-.1zM12 3c-2.4 0-2.8 0-3.7.1C5 3.2 3.2 5 3.1 8.3 3 9.2 3 9.6 3 12s0 2.8.1 3.7c.1 3.3 1.9 5.1 5.2 5.2.9.1 1.3.1 3.7.1s2.8 0 3.7-.1c3.3-.1 5.1-1.9 5.2-5.2.1-.9.1-1.3.1-3.7s0-2.8-.1-3.7C20.8 5 19 3.2 15.7 3.1 14.8 3 14.4 3 12 3z"/></svg>' ),
		array( 'https://www.tiktok.com/@homedesk_tn', 'TikTok', '<svg viewBox="0 0 24 24" aria-hidden="true"><path d="M16.6 3c.4 2.3 1.8 3.8 4.2 4v3.3c-1.5.1-2.9-.4-4.2-1.2v6.2c0 3.4-2.6 5.7-5.7 5.7a5.6 5.6 0 0 1-5.7-5.6c0-3.6 3-6.2 6.6-5.7V13c-1.7-.4-3.3.8-3.3 2.5 0 1.4 1.1 2.4 2.4 2.4 1.4 0 2.5-1 2.5-2.6V3h3.2z"/></svg>' ),
	);
}

/** Bloc footer : WhatsApp + e-mail, puis icônes des réseaux sociaux. $class = préfixe BEM du footer. */
function homedesk_footer_contact( $class ) {
	$c = homedesk_contact_info();
	?>
	<p class="<?php echo esc_attr( $class ); ?>__contact">
		<a href="<?php echo esc_url( $c['whatsapp_url'] ); ?>" target="_blank" rel="noopener">WhatsApp <?php echo esc_html( $c['whatsapp'] ); ?></a>
		· <a href="mailto:<?php echo esc_attr( $c['email'] ); ?>"><?php echo esc_html( $c['email'] ); ?></a>
	</p>
	<ul class="<?php echo esc_attr( $class ); ?>__social" aria-label="HomeDesk sur les réseaux sociaux">
		<?php foreach ( homedesk_social_links() as $s ) : ?>
			<li><a href="<?php echo esc_url( $s[0] ); ?>" target="_blank" rel="noopener" aria-label="HomeDesk sur <?php echo esc_attr( $s[1] ); ?>"><?php echo $s[2]; // phpcs:ignore -- SVG statique ?></a></li>
		<?php endforeach; ?>
	</ul>
	<?php
}

function homedesk_light_footer() {
	?>
	<footer class="hd-chrome-footer">
		<ul class="hd-chrome-footer__links">
			<?php foreach ( homedesk_footer_links() as $link ) : ?>
				<li><a href="<?php echo esc_url( $link[0] ); ?>"><?php echo esc_html( $link[1] ); ?></a></li>
			<?php endforeach; ?>
		</ul>
		<?php homedesk_footer_contact( 'hd-chrome-footer' ); ?>
		<p>Copyright © <?php echo esc_html( gmdate( 'Y' ) ); ?> · HomeDesk · Fabriqué en Tunisie</p>
	</footer>
	<?php
}

// =============================================================================
// PAGE « RETOURS ET REMBOURSEMENT » — contenu versionné dans templates/page-retours.php
// =============================================================================
// La page est créée automatiquement (une seule fois) à la première visite de l'admin,
// en local comme en prod : rien à copier-coller, le contenu arrive avec le déploiement git.

define( 'HOMEDESK_RETOURS_SLUG', 'retours-et-remboursement' );

add_action( 'admin_init', function () {
	if ( get_option( 'homedesk_retours_page_id' ) || ! current_user_can( 'publish_pages' ) ) {
		return;
	}
	$page = get_page_by_path( HOMEDESK_RETOURS_SLUG );
	$id   = $page ? $page->ID : wp_insert_post( array(
		'post_type'    => 'page',
		'post_status'  => 'publish',
		'post_title'   => 'Retours et remboursement',
		'post_name'    => HOMEDESK_RETOURS_SLUG,
		'post_content' => '',
	) );
	if ( $id && ! is_wp_error( $id ) ) {
		update_post_meta( $id, '_wp_page_template', 'templates/page-retours.php' );
		update_post_meta( $id, '_yoast_wpseo_title', 'Retours et remboursement · Essai 3 jours · HomeDesk' );
		update_post_meta( $id, '_yoast_wpseo_metadesc', 'Essayez HomeDesk 3 jours chez vous : s\'il ne vous convient pas, vous êtes remboursé intégralement. Conditions de retour et étapes du remboursement.' );
		update_option( 'homedesk_retours_page_id', (int) $id );
	}
} );

// =============================================================================
// PAGE « NOTRE HISTOIRE » — contenu versionné dans templates/page-histoire.php
// =============================================================================
// À la première visite de l'admin (local et prod) : la page /notre-histoire/ existante
// (ou créée si absente) reçoit le modèle, un titre / une description SEO, et redevient indexable.

add_action( 'admin_init', function () {
	if ( get_option( 'homedesk_histoire_page_id' ) || ! current_user_can( 'publish_pages' ) ) {
		return;
	}
	$page = get_page_by_path( 'notre-histoire' );
	$id   = $page ? $page->ID : wp_insert_post( array(
		'post_type'    => 'page',
		'post_status'  => 'publish',
		'post_title'   => 'Notre histoire',
		'post_name'    => 'notre-histoire',
		'post_content' => '',
	) );
	if ( $id && ! is_wp_error( $id ) ) {
		update_post_meta( $id, '_wp_page_template', 'templates/page-histoire.php' );
		update_post_meta( $id, '_yoast_wpseo_title', 'Notre histoire · Comment est né HomeDesk' );
		update_post_meta( $id, '_yoast_wpseo_metadesc', "Développeur web, il a créé HomeDesk après des années de mal de dos devant l'écran : l'histoire du support assis-debout fabriqué en Tunisie." );
		delete_post_meta( $id, '_yoast_wpseo_meta-robots-noindex' );
		delete_post_meta( $id, '_yoast_wpseo_meta-robots-nofollow' );
		update_option( 'homedesk_histoire_page_id', (int) $id );
	}
} );
