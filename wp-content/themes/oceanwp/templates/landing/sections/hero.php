<?php
/**
 * Landing produit, section « hero » (commune à toutes les audiences).
 * Une audience peut la remplacer par templates/landing/{audience}/hero.php.
 */
if ( ! defined( 'ABSPATH' ) ) exit;
?>
<!-- HERO : textes et image dans templates/landing/{audience}.php -->
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
			<div class="hero__price"><b><?php echo $hd_dt( $hd_prices['medium']['price'] ); ?></b><s><?php echo $hd_dt( $hd_prices['medium']['regular'] ); ?></s><span>Sac offert · valeur 85 DT</span></div>
			<div class="rating" style="margin-top:12px"><span class="rating__stars">★★★★★</span><span><strong>4,9/5</strong> · +200 professionnels équipés</span></div>
			<div class="cta-wrap" style="margin-top:22px">
				<a class="btn" href="#commander"<?php echo $hd_pick; ?>><?php echo esc_html( $hd_content['cta'] ); ?></a>
				<p class="cta-note">À partir de <strong><?php echo $hd_dt( $hd_from ); ?></strong> · Paiement à la livraison · Livraison gratuite</p>
			</div>
		</div>
		<div class="gallery" data-gallery>
			<div class="gallery__main">
				<img src="<?php echo esc_url( $hd_img . $hd_hero_img['src'] ); ?>" alt="<?php echo esc_attr( $hd_hero_img['alt'] ); ?>" width="<?php echo (int) $hd_hero_img['w']; ?>" height="<?php echo (int) $hd_hero_img['h']; ?>" fetchpriority="high" data-gallery-main>
				<span class="gallery__badge">Assis ↔ debout en 5 sec</span>
			</div>
			<ul class="gallery__thumbs">
				<?php
				$hd_thumbs = array(
					array( $hd_hero_img['src'], $hd_hero_img['alt'], 'Photo 1' ),
					array( 'femme-sourire.webp', 'Femme travaillant debout dans un bureau avec HomeDesk', 'Photo 2 : au bureau' ),
					array( 'detail-clavier.webp', 'Gros plan sur l\'étagère clavier du HomeDesk', 'Photo 3 : étagère clavier' ),
					array( 'detail-laptop.webp', 'Ordinateur portable posé sur l\'étagère haute du HomeDesk', 'Photo 4 : étagère ordinateur' ),
					array( 'sac-4.webp', 'Sac de transport noir HomeDesk', 'Photo 5 : sac de transport' ),
				);
				if ( 'femme-sourire.webp' === $hd_hero_img['src'] ) {
					$hd_thumbs[1] = array( 'hero-homme-pc.webp', 'Homme souriant travaillant debout, son ordinateur posé sur un HomeDesk', 'Photo 2 : en usage debout' );
				}
				foreach ( $hd_thumbs as $hd_i => $hd_t ) :
					?>
					<li><button type="button" aria-current="<?php echo 0 === $hd_i ? 'true' : 'false'; ?>" aria-label="<?php echo esc_attr( $hd_t[2] ); ?>" data-src="<?php echo esc_url( $hd_img . $hd_t[0] ); ?>" data-alt="<?php echo esc_attr( $hd_t[1] ); ?>"><img src="<?php echo esc_url( $hd_img . $hd_t[0] ); ?>" alt="" width="200" height="200" loading="lazy"></button></li>
				<?php endforeach; ?>
			</ul>
		</div>
	</div>
</section>
