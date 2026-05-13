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
			<?php do_action('woocommerce_before_single_product_summary'); ?>
		</div>
	</div>

	<?php // Bandeau features — pleine largeur ?>
	<div class="product-features-banner">
		<div class="product-features-banner__inner container">
			<div class="feature-item">
				<span class="feature-icon">🚚</span>
				<span class="feature-text">Livraison partout en Tunisie sous 48h</span>
			</div>
			<div class="feature-item">
				<span class="feature-icon">💳</span>
				<span class="feature-text">Paiement à la livraison</span>
			</div>
			<div class="feature-item">
				<span class="feature-icon">↩️</span>
				<span class="feature-text">Retour 7 jours offert</span>
			</div>
			<div class="feature-item">
				<span class="feature-icon">🛡️</span>
				<span class="feature-text">Garantie 1 an</span>
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
					<p class="transformation-card__desc">Contreplaqué CNC haute densité. Construit pour durer des années.</p>
				</div>
			</div>
		</div>
	</div>

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
