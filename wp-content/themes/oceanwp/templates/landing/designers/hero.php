<?php
/**
 * Landing produit, audience « Designers » : section « hero » (photo seule avec sa cote,
 * au lieu de la galerie). Textes dans templates/landing/designers.php.
 * Source : product-page/lp-designers.html
 */
if ( ! defined( 'ABSPATH' ) ) exit;
?>
<!-- HERO -->
<section class="hero">
	<div class="container hero__grid">
		<div>
			<span class="eyebrow"><?php echo esc_html( $hd_content['eyebrow'] ); ?></span>
			<h1><?php echo wp_kses( $hd_content['h1'], array( 'span' => array( 'class' => true ), 'br' => array(), 'em' => array() ) ); ?></h1>
			<p class="hero__sub"><?php echo wp_kses( $hd_content['sub'], array( 'strong' => array() ) ); ?></p>
			<ul class="hero__bullets">
				<?php foreach ( $hd_content['bullets'] as $hd_bullet ) : ?>
					<li><?php echo esc_html( $hd_bullet ); ?></li>
				<?php endforeach; ?>
			</ul>
			<div class="hero__price"><b><?php echo $hd_dt( $hd_prices['medium']['price'] ); ?></b><s><?php echo $hd_dt( $hd_prices['medium']['regular'] ); ?></s><span>Sac offert · valeur 85 DT</span></div>
			<div class="rating" style="margin-top:12px"><span class="rating__stars">★★★★★</span><span><strong>4,9/5</strong> · +200 professionnels équipés</span></div>
			<div class="cta-wrap" style="margin-top:22px">
				<a class="btn btn--dark" href="#commander"<?php echo $hd_pick; ?>><?php echo esc_html( $hd_content['cta'] ); ?></a>
				<p class="cta-note">À partir de <strong><?php echo $hd_dt( $hd_from ); ?></strong> · Paiement à la livraison · Livraison gratuite</p>
			</div>
		</div>
		<div class="hero__media">
			<img src="<?php echo esc_url( $hd_img . $hd_hero_img['src'] ); ?>" alt="<?php echo esc_attr( $hd_hero_img['alt'] ); ?>" width="<?php echo (int) $hd_hero_img['w']; ?>" height="<?php echo (int) $hd_hero_img['h']; ?>" fetchpriority="high">
			<div class="hero__dim" aria-hidden="true"><span>Medium · H 55 cm</span></div>
			<div class="hero__caption"><span>N°01 · HomeDesk Medium</span><span>MDF stratifié blanc</span></div>
		</div>
	</div>
</section>
