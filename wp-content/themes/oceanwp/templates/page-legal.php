<?php
/**
 * Template Name: Page d'information HomeDesk
 *
 * Mise en page des pages légales (confidentialité, mentions…) au style de la page
 * Retours et remboursement. Le texte reste celui de l'éditeur WordPress (modifiable dans l'admin).
 * La politique de confidentialité l'utilise automatiquement (custom-functions.php).
 *
 * @package OceanWP WordPress theme
 */

if ( ! defined( 'ABSPATH' ) ) exit;

get_header();

while ( have_posts() ) :
	the_post();
	?>
	<div class="hd-retours">

		<header class="hd-retours__hero">
			<div class="hd-retours__wrap">
				<span class="hd-retours__eyebrow">Informations légales</span>
				<h1><?php the_title(); ?></h1>
				<p class="hd-retours__updated">Dernière mise à jour : <?php echo esc_html( get_the_modified_date() ); ?></p>
			</div>
		</header>

		<article class="hd-retours__wrap hd-prose">
			<?php the_content(); ?>
		</article>

		<section class="hd-retours__cta">
			<div class="hd-retours__wrap">
				<h2>Une question&nbsp;?</h2>
				<p>Notre équipe vous répond. Et si vous découvrez HomeDesk, vous avez 3 jours pour l'essayer chez vous.</p>
				<div class="hd-retours__btns">
					<a class="hd-retours__btn" href="<?php echo esc_url( home_url( '/contactez-nous/' ) ); ?>">Nous contacter →</a>
					<a class="hd-retours__btn hd-retours__btn--ghost" href="<?php echo esc_url( home_url( '/' . HOMEDESK_RETOURS_SLUG . '/' ) ); ?>">Retours et remboursement</a>
				</div>
			</div>
		</section>

	</div>
	<?php
endwhile;

get_footer();
