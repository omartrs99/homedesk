<?php
/**
 * Landing produit, audience « Étudiants », section « hero » : photo façon polaroid + stickers prix / paiement.
 * Source : product-page/lp-etudiants.html (2. HERO). Textes dans templates/landing/etudiants.php.
 */
if ( ! defined( 'ABSPATH' ) ) exit;
?>
<!-- HERO : textes dans templates/landing/etudiants.php -->
<section class="hero">
	<div class="container hero__grid">
		<div>
			<span class="eyebrow"><?php echo esc_html( $hd_content['eyebrow'] ); ?></span>
			<h1><?php echo wp_kses( $hd_content['h1'], array( 'span' => array( 'class' => true ), 'br' => array() ) ); ?></h1>
			<p class="hero__sub"><?php echo wp_kses( $hd_content['sub'], array( 'strong' => array() ) ); ?></p>
			<ul class="hero__bullets">
				<?php foreach ( $hd_content['bullets'] as $hd_bullet ) : ?>
					<li><?php echo esc_html( $hd_bullet ); ?></li>
				<?php endforeach; ?>
			</ul>
			<div class="rating"><span class="rating__stars">★★★★★</span><span><strong>4,9/5</strong> · +200 clients équipés</span></div>
			<div class="cta-wrap">
				<a class="btn" href="#commander"<?php echo $hd_pick; ?>><?php echo esc_html( $hd_content['cta'] ); ?></a>
				<p class="cta-note">💳 Paiement à la livraison · 🚚 Livraison gratuite · ↩️ 3 jours pour essayer</p>
			</div>
		</div>
		<div class="hero__media">
			<figure class="polaroid">
				<span class="sticker sticker--price"><span>dès<b><?php echo esc_html( wp_strip_all_tags( number_format_i18n( $hd_from ) ) ); ?></b>DT</span></span>
				<img src="<?php echo esc_url( $hd_img . $hd_hero_img['src'] ); ?>" alt="<?php echo esc_attr( $hd_hero_img['alt'] ); ?>" width="<?php echo (int) $hd_hero_img['w']; ?>" height="<?php echo (int) $hd_hero_img['h']; ?>" fetchpriority="high">
				<span class="sticker sticker--cod">💳 Tu paies à la livraison</span>
				<figcaption>révisions, mode debout ✌️</figcaption>
			</figure>
		</div>
	</div>
</section>
