<?php
defined('ABSPATH') || exit;

do_action('woocommerce_before_single_product');

if (post_password_required()) {
    echo get_the_password_form(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
    return;
}
?>
<div id="product-<?php the_ID(); ?>" <?php wc_product_class('product-stacked-layout'); ?>>

	<?php // Ligne 1 : hook_produit + galerie côte à côte ?>
	<div class="product-row-1">
		<?php
		$hook_produit = get_post_meta(get_the_ID(), '_hook_produit', true);
		if ($hook_produit) {
			echo '<div class="hook-produit-stacked">';
			echo apply_filters('the_content', $hook_produit); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			echo '</div>';
		}
		?>

		<div class="product-gallery-stacked">
			<span class="onsale">Le bureau nouvelle génération&nbsp;!</span>
			<?php do_action('woocommerce_before_single_product_summary'); ?>
		</div>
	</div>

	<?php // Bandeau features — pleine largeur ?>
	<div class="product-features-banner">
		<div class="product-features-banner__inner container">
			<div class="feature-item">
				<span class="feature-icon">🚚</span>
				<span class="feature-text">Livraison partout en Tunisie sous 72h</span>
			</div>
			<div class="feature-item">
				<span class="feature-icon">💳</span>
				<span class="feature-text">Paiement à la livraison</span>
			</div>
			<div class="feature-item pulse-text">
				<span class="feature-icon">↩️</span>
				<span class="feature-text ">Convaincu ou remboursé en 3 jours</span>
			</div>
			<div class="feature-item">
				<span class="feature-icon">🛡️</span>
				<span class="feature-text">Confort immédiat</span>
			</div>
		</div>
	</div>

	<?php // Bloc transformations — pleine largeur ?>
	<div class="product-transformations-block">
		<div class="product-transformations-block__inner">
			<p class="transformations-subtitle">CE QUE VOUS GAGNEZ</p>
			<h2 class="transformations-title">4 TRANSFORMATIONS IMMÉDIATES</h2>
			<div class="transformations-cards">
				<div class="transformation-card">
					<div class="transformation-card__icon">
						<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="#318b82" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="2" x2="12" y2="22"/><rect x="9" y="2.5" width="6" height="2.5" rx="1"/><rect x="8.5" y="6.5" width="7" height="2.5" rx="1"/><rect x="9" y="10.5" width="6" height="2.5" rx="1"/><rect x="8.5" y="14.5" width="7" height="2.5" rx="1"/><rect x="9" y="18.5" width="6" height="2.5" rx="1"/></svg>
					</div>
					<h3 class="transformation-card__title">POSTURE PARFAITE</h3>
					<p class="transformation-card__desc">Dos droit, nuque libre, épaules détendues. Tout naturellement.</p>
				</div>
				<div class="transformation-card">
					<div class="transformation-card__icon">
						<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="#318b82" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
					</div>
					<h3 class="transformation-card__title">+40% PRODUCTIVITÉ</h3>
					<p class="transformation-card__desc">Alterner assis/debout booste la concentration et l'énergie tout au long de la journée.</p>
				</div>
				<div class="transformation-card">
					<div class="transformation-card__icon">
						<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="#318b82" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M3 9l9-7 9 7v11a2 2 0 01-2 2H5a2 2 0 01-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
					</div>
					<h3 class="transformation-card__title">DESIGN ÉLÉGANT</h3>
					<p class="transformation-card__desc">Esthétique minimaliste qui s'intègre parfaitement dans votre espace de travail.</p>
				</div>
				<div class="transformation-card">
					<div class="transformation-card__icon">
						<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="#318b82" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
					</div>
					<h3 class="transformation-card__title">ULTRA ROBUSTE</h3>
					<p class="transformation-card__desc">Découpé en CNC haute densité. Construit pour durer des années.</p>
				</div>
			</div>
		</div>
	</div>

	<?php // Bloc sac offert gratuit — pleine largeur ?>
	<div class="product-gift-block">
		<div class="product-gift-block__inner">

			<?php $img_base = esc_url( get_template_directory_uri() ) . '/assets/img/'; ?>

			<!-- Col 1 : Carousel hero -->
			<div class="pgb-hero">
				<div class="pgb-hero__wrap">
					<span class="pgb-hero__badge">Améliorez votre posture</span>
					<div class="pgb-hero__track" id="pgb-hero-track">
						<img src="<?php echo $img_base; ?>homedesk-bureau-assis-debout-pc-hero-1.jpg" alt="HomeDesk vue 1" class="pgb-hero__slide">
						<img src="<?php echo $img_base; ?>homedesk-bureau-assis-debout-pc-hero-2.jpg" alt="HomeDesk vue 2" class="pgb-hero__slide">
						<img src="<?php echo $img_base; ?>homedesk-bureau-assis-debout-pc-hero-3.jpg" alt="HomeDesk vue 3" class="pgb-hero__slide">
					</div>
				</div>
				<div class="pgb-hero__thumbs">
					<img src="<?php echo $img_base; ?>homedesk-bureau-assis-debout-pc-hero-1.jpg" alt="" class="pgb-thumb pgb-thumb--active" data-pgb-hero="0">
					<img src="<?php echo $img_base; ?>homedesk-bureau-assis-debout-pc-hero-2.jpg" alt="" class="pgb-thumb" data-pgb-hero="1">
					<img src="<?php echo $img_base; ?>homedesk-bureau-assis-debout-pc-hero-3.jpg" alt="" class="pgb-thumb" data-pgb-hero="2">
				</div>
			</div>

			<!-- Col 2 : Message offre -->
			<div class="pgb-offer">
				<div class="pgb-offer__icon">
					<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64 64" fill="none">
						<rect x="6" y="26" width="52" height="34" rx="5" stroke="#318b82" stroke-width="3"/>
						<path d="M6 38h52" stroke="#318b82" stroke-width="3"/>
						<path d="M32 26V60" stroke="#318b82" stroke-width="2.5"/>
						<path d="M32 26C32 26 19 6 12 10C5 14 19 26 32 26Z" fill="rgba(49,139,130,0.12)" stroke="#318b82" stroke-width="2"/>
						<path d="M32 26C32 26 45 6 52 10C59 14 45 26 32 26Z" fill="rgba(49,139,130,0.12)" stroke="#318b82" stroke-width="2"/>
						<circle cx="24" cy="20" r="2.5" fill="#318b82"/>
						<circle cx="40" cy="20" r="2.5" fill="#318b82"/>
					</svg>
				</div>
				<p class="pgb-offer__tag">SAC DE TRANSPORT</p>
				<h2 class="pgb-offer__headline">
					<span class="pgb-offer__headline--free">OFFERT</span>
					<span class="pgb-offer__headline--sub">avec votre bureau</span>
				</h2>
				<p class="pgb-offer__desc">Transportez votre bureau assis-debout<br>partout, facilement et en toute sécurité.</p>
				<div class="pgb-offer__value">
					<span class="pgb-offer__value-old">65 DT</span>
					<span class="pgb-offer__value-free">
						<svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
						GRATUIT
					</span>
				</div>
			</div>

			<!-- Col 3 : Mini-galerie slider -->
			<div class="pgb-gallery">
				<div class="pgb-gallery__track" id="pgb-track">
					<img src="<?php echo $img_base; ?>homedesk-sac-1.jpg" alt="Sac vue 1" class="pgb-slide ">
					<img src="<?php echo $img_base; ?>homedesk-sac-2.jpg" alt="Sac vue 2" class="pgb-slide">
					<img src="<?php echo $img_base; ?>homedesk-sac-3.jpg" alt="Sac vue 3" class="pgb-slide">
				</div>
				<div class="pgb-gallery__thumbs">
					<img src="<?php echo $img_base; ?>homedesk-sac-1.jpg" alt="" class="pgb-thumb " data-pgb="0">
					<img src="<?php echo $img_base; ?>homedesk-sac-2.jpg" alt="" class="pgb-thumb" data-pgb="1">
					<img src="<?php echo $img_base; ?>homedesk-sac-3.jpg" alt="" class="pgb-thumb" data-pgb="2">
				</div>
			</div>

		</div><!-- .product-gift-block__inner -->
	</div><!-- .product-gift-block -->

	<?php // Bloc démonstration vidéos — pleine largeur ?>
	<div class="product-demo-block">
		<div class="product-demo-block__inner">
			<p class="demo-subtitle">DÉMONSTRATION</p>
			<!--<h2 class="demo-title">3 VIDÉOS — VOYEZ-LE EN ACTION</h2>-->
			<h2 class="demo-title">VOYEZ-LE EN ACTION</h2>
			
			<div class="demo-section">
				<div class="demo-story-layout">

					<!-- Vidéo gauche -->
					<div class="demo-story-video">
						<div class="demo-story-wrap">
							<iframe src="https://www.youtube.com/embed/S6rd8xwxWzg?rel=0&modestbranding=1"
								frameborder="0"
								allow="accelerometer; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
								allowfullscreen loading="lazy"></iframe>
						</div>
					</div>

					<!-- Texte centre -->
					<div class="demo-story-text">
						<h3 class="demo-story-title">ASSIS. DEBOUT. TOUJOURS CONFORTABLE.</h3>
						<p class="demo-story-desc">Passez d'une position à l'autre en 5 secondes. Votre colonne retrouve son alignement naturel. Votre énergie, elle, ne retombe plus.</p>
					</div>

					<!-- Vidéo droite -->
					<div class="demo-story-video">
						<div class="demo-story-wrap">
							<iframe src="https://www.youtube.com/embed/S6rd8xwxWzg?rel=0&modestbranding=1"
								frameborder="0"
								allow="accelerometer; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
								allowfullscreen loading="lazy"></iframe>
						</div>
					</div>

				</div>
			</div>
			<!--<div class="demo-videos-grid">

				<div class="demo-video-card demo-video-card--active">
					<span class="demo-video-badge">ACTIF</span>
					<div class="demo-video-wrap">
						<iframe src="https://www.youtube.com/embed/idVo6f0G07A?rel=0&modestbranding=1" frameborder="0" allow="accelerometer; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen loading="lazy"></iframe>
					</div>
					<div class="demo-video-meta">
						<span class="demo-video-label">VIDÉO 1</span>
						<p class="demo-video-desc">Assemblage complet en 5 minutes chrono. Sans outil.</p>
					</div>
				</div>

				<div class="demo-video-card demo-video-card--active">
					<div class="demo-video-wrap">
						<iframe src="https://www.youtube.com/embed/S6rd8xwxWzg?rel=0&modestbranding=1" frameborder="0" allow="accelerometer; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen loading="lazy"></iframe>
					</div>
					<div class="demo-video-meta">
						<span class="demo-video-label">VIDÉO 2</span>
						<p class="demo-video-desc">Passage assis → debout en 3 secondes. 3 positions.</p>
					</div>
				</div>

				<div class="demo-video-card demo-video-card--active">
					<div class="demo-video-wrap">
						<iframe src="https://www.youtube.com/embed/cwYyj4Uhev0?rel=0&modestbranding=1" frameborder="0" allow="accelerometer; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen loading="lazy"></iframe>
					</div>
					<div class="demo-video-meta">
						<span class="demo-video-label">VIDÉO 3</span>
						<p class="demo-video-desc">Avant / après en situation.</p>
					</div>
				</div>

			</div> -->

			<!--<p class="demo-swipe-hint">
				<span class="demo-swipe-hint__arrow demo-swipe-hint__arrow--left">&#8592;</span>
				GLISSER
				<span class="demo-swipe-hint__arrow demo-swipe-hint__arrow--right">&#8594;</span>
			</p>-->

			<div class="demo-stats-row">
				<div class="demo-stat">
					<span class="demo-stat__value">5 sec</span>
					<span class="demo-stat__label">MONTAGE SANS OUTIL</span>
				</div>
				<div class="demo-stat">
					<span class="demo-stat__value">2 positions</span>
					<span class="demo-stat__label">ASSIS · DEBOUT</span>
				</div>
				<div class="demo-stat">
					<span class="demo-stat__value">Jour 1</span>
					<span class="demo-stat__label">Votre dos vous remercie</span>
				</div>
			</div>

		</div><!-- .product-demo-block__inner -->
	</div><!-- .product-demo-block -->

	<?php // Bloc galerie détail + formulaire — pleine largeur ?>
	<div class="product-gallery-form-block" id="section-commande">
		<div class="product-gallery-form-block__inner">

			<!-- Colonne gauche : galerie -->
			<div class="pgf-gallery">
				<p class="pgf-subtitle">GALERIE PRODUIT</p>
				<h2 class="pgf-title">CHAQUE DÉTAIL COMPTE</h2>

				<!-- Grande image active -->
				<div class="pgf-main-view" id="pgf-main-view">
					<span class="pgf-badge">La posture idéale pour travailler</span>
					<img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/img/homedesk-bureau-assis-debout-gal1.jpg.webp" alt="Détail produit 1" class="pgf-main-slide">
					<img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/img/homedesk-bureau-assis-debout-gal2.jpg.webp" alt="Détail produit 2" class="pgf-main-slide">
					<img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/img/homedesk-bureau-assis-debout-gal3.jpg.webp" alt="Détail produit 3" class="pgf-main-slide">
					<img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/img/homedesk-bureau-assis-debout-gal4.jpg.webp" alt="Détail produit 4" class="pgf-main-slide">
					<img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/img/homedesk-bureau-assis-debout-gal5.jpg.webp" alt="Détail produit 5" class="pgf-main-slide">
				</div>

				<!-- Strip thumbnails -->
				<div class="pgf-thumbnails" id="pgf-carousel">
					<img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/img/homedesk-bureau-assis-debout-gal1.jpg.webp" alt="Détail produit 1" class="pgf-thumb-slide">
					<img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/img/homedesk-bureau-assis-debout-gal2.jpg.webp" alt="Détail produit 2" class="pgf-thumb-slide">
					<img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/img/homedesk-bureau-assis-debout-gal3.jpg.webp" alt="Détail produit 3" class="pgf-thumb-slide">
					<img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/img/homedesk-bureau-assis-debout-gal4.jpg.webp" alt="Détail produit 4" class="pgf-thumb-slide">
					<img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/img/homedesk-bureau-assis-debout-gal5.jpg.webp" alt="Détail produit 5" class="pgf-thumb-slide">
				</div>
				<div class="pgf-carousel-dots" id="pgf-carousel-dots"></div>
			</div>

			<!-- Colonne droite : formulaire OPC -->
			<div class="pgf-form">
				<?php echo do_shortcode( '[one_page_cod]' ); ?>
			</div>

		</div><!-- .product-gallery-form-block__inner -->
	</div><!-- .product-gallery-form-block -->

	<?php // Bloc avant/après — slider comparatif pleine largeur ?>
	<div class="product-before-after-block">
		<div class="product-before-after-block__inner">

			<p class="bab-subtitle">— TRANSFORMATION RÉELLE —</p>
			<h2 class="bab-title">AVANT / APRÈS HOMEDESK</h2>
			<p class="bab-desc">Transformation immédiate</p>

			<?php
			/* ── Images version mobile — modifiez les URLs ici ── */
			$bab_mobile_avant = esc_url( get_template_directory_uri() ) . '/assets/img/homedesk_mobile-avant.jpg';
			$bab_mobile_apres = esc_url( get_template_directory_uri() ) . '/assets/img/homedesk_mobile-apres.jpg';
			
			?>

			<!-- Version mobile : 2 cartes statiques -->
			<div class="bab-static">

				<div class="bab-static__card bab-static__card--avant" style="background-image:url('<?php echo $bab_mobile_avant; ?>')">
					<span class="bab-badge bab-badge--avant">AVANT</span>
					<div class="bab-static__overlay bab-static__overlay--avant"></div>
					<div class="bab-content">
						<span class="bab-emoji">😰</span>
						<h3 class="bab-panel-title">TRAVAIL ASSIS</h3>
						<ul class="bab-list bab-list--bad">
							<li>Dos bloqué</li>
							<li>Posture courbée</li>
						</ul>
					</div>
				</div>

				<div class="bab-static__card bab-static__card--apres" style="background-image:url('<?php echo $bab_mobile_apres; ?>')">
					<span class="bab-badge bab-badge--apres">APRÈS</span>
					<div class="bab-static__overlay bab-static__overlay--apres"></div>
					<div class="bab-content">
						<span class="bab-emoji">😊</span>
						<h3 class="bab-panel-title">AVEC HOMEDESK</h3>
						<ul class="bab-list bab-list--good">
							<li>Posture parfaite</li>
							<li>Énergie durable</li>
						</ul>
					</div>
				</div>

			</div><!-- .bab-static -->

			<!-- Version desktop : slider draggable -->
			<div class="bab-comparison" id="bab-comparison">

				<!-- Panneau AVANT -->
				<div class="bab-panel bab-panel--avant" style="background-image:url('<?php echo esc_url( get_template_directory_uri() ); ?>/assets/img/homedesk-avant.jpg')">
					<span class="bab-badge bab-badge--avant">AVANT</span>
					<div class="bab-content">
						<span class="bab-emoji">😰</span>
						<h3 class="bab-panel-title">TRAVAIL ASSIS</h3>
						<ul class="bab-list bab-list--bad">
							<li>Dos bloqué</li>
							<li>Posture courbée</li>
							<li>Épaules fatiguées</li>
							<li>Douleurs quotidiennes</li>
						</ul>
					</div>
				</div>

				<!-- Panneau APRÈS -->
				<div class="bab-panel bab-panel--apres" id="bab-apres" style="background-image:url('<?php echo esc_url( get_template_directory_uri() ); ?>/assets/img/homedesk-apres.jpg')">
					<span class="bab-badge bab-badge--apres">APRÈS</span>
					<div class="bab-content">
						<span class="bab-emoji">😊</span>
						<h3 class="bab-panel-title">AVEC HOMEDESK</h3>
						<ul class="bab-list bab-list--good">
							<li>Posture parfaite</li>
							<li>Énergie durable</li>
							<li>Dos soulagé</li>
							<li>Confort total</li>
						</ul>
					</div>
				</div>

				<!-- Diviseur draggable -->
				<div class="bab-slider" id="bab-slider">
					<div class="bab-slider__line"></div>
					<div class="bab-slider__handle">
						<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="15 18 9 12 15 6"/></svg>
						<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 18 15 12 9 6"/></svg>
					</div>
					<div class="bab-slider__line"></div>
				</div>

			</div><!-- .bab-comparison -->

			<p class="bab-hint">&#8592; Glissez pour ressentir la différence &#8594;</p>

		</div><!-- .product-before-after-block__inner -->
	</div><!-- .product-before-after-block -->

	<?php // Bloc CTA — fond #318b82 ?>
	<div class="product-cta-block">
		<div class="product-cta-block__inner">

			<!-- Accroche psychologique -->
			<div class="pcta-hook">
				<h2 class="pcta-hook__title">Offrez à votre dos le confort qu'il mérite.</h2>
				<p class="pcta-hook__text">Chaque heure passée assis sans support détériore silencieusement vos disques vertébraux, votre posture et votre énergie. Ce n'est pas une fatalité — c'est un problème que des milliers de personnes ont déjà résolu. La question n'est pas <em>si</em> vous devez agir, c'est <em>quand</em>.</p>
			</div>

			<div class="pcta-sep"></div>


			<p class="pcta-guarantee">
				<span class="pcta-guarantee__item">
					<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
					Livraison sous 48h partout en Tunisie
				</span>
				<span class="pcta-guarantee__item">
					<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
					Paiement à la livraison — aucun risque
				</span>
				<span class="pcta-guarantee__item">
					<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
					<span class="pulse-text">Pas satisfait ? Remboursé sous 3 jours</span>
				</span>
			</p>

			<a href="#section-commande" class="pcta-btn">Découvrez le plaisir de travailler sans douleurs.</a>

		</div><!-- .product-cta-block__inner -->
	</div><!-- .product-cta-block -->

	<?php
	// Bloc 3 : Short description
	echo '<div class="product-short-desc-stacked">';
	woocommerce_template_single_excerpt();
	echo '</div>';
	?>

	<?php
	// Bloc 4 : Tabs (description, avis, etc.)
	woocommerce_output_product_data_tabs();
	?>

	<?php
	// Données structurées SEO
	if (function_exists('WC') && WC()->structured_data) {
		WC()->structured_data->generate_product_data();
	}
	?>

</div>

<?php do_action('woocommerce_after_single_product'); ?>
