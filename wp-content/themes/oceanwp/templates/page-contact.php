<?php
/**
 * Template Name: Contact HomeDesk
 *
 * Page /contactez-nous/ au style de la page Retours et remboursement.
 * Appliqué automatiquement à la page « contactez-nous » (custom-functions.php), sans réglage en base.
 * Le formulaire Contact Form 7 est repris du contenu de la page : son ID peut différer
 * entre le local et la prod, il reste donc géré dans l'admin.
 *
 * @package OceanWP WordPress theme
 */

if ( ! defined( 'ABSPATH' ) ) exit;

$hd_product_id  = function_exists( 'homedesk_default_product_id' ) ? homedesk_default_product_id() : 0;
$hd_product_url = $hd_product_id ? get_permalink( $hd_product_id ) : home_url( '/' );
$hd_retours_url = home_url( '/' . HOMEDESK_RETOURS_SLUG . '/' );

// Formulaire : premier shortcode [contact-form-7 …] trouvé dans le contenu de la page
$hd_form = '';
if ( preg_match( '/\[contact-form-7[^\]]*\]/', (string) get_post_field( 'post_content', get_queried_object_id() ), $hd_m ) ) {
	$hd_form = do_shortcode( $hd_m[0] );
}

get_header();
?>

<div class="hd-retours hd-contact">

	<header class="hd-retours__hero">
		<div class="hd-retours__wrap">
			<span class="hd-retours__eyebrow">Une question ? Nous sommes là</span>
			<h1>Contactez HomeDesk</h1>
			<p class="hd-retours__lead">Une question sur le produit, votre commande, un retour ou un projet pour votre entreprise : écrivez-nous, notre équipe vous répond.</p>
		</div>
	</header>

	<section class="hd-retours__wrap" aria-label="Comment nous joindre">
		<ul class="hd-retours__keys">
			<li><span aria-hidden="true">✉️</span><b>Par e-mail</b><a href="mailto:contact@homedesk.tn">contact@homedesk.tn</a></li>
			<li><span aria-hidden="true">🏢</span><b>Offre entreprise</b>Un devis personnalisé pour équiper vos équipes. <a href="#formulaire">Demander un devis</a></li>
			<li><span aria-hidden="true">↩️</span><b>Retour ou remboursement</b>3 jours pour essayer après la réception. <a href="<?php echo esc_url( $hd_retours_url ); ?>">Voir les conditions</a></li>
		</ul>
	</section>

	<?php if ( $hd_form ) : ?>
		<section class="hd-retours__wrap hd-retours__section" id="formulaire">
			<h2>Écrivez-nous</h2>
			<p class="hd-contact__intro">Pour une demande entreprise, précisez le nombre de postes à équiper dans votre message.</p>
			<div class="hd-contact__form">
				<?php echo $hd_form; // phpcs:ignore -- HTML du formulaire Contact Form 7 ?>
			</div>
		</section>
	<?php endif; ?>

	<section class="hd-retours__wrap hd-retours__section">
		<h2>Avant de nous écrire</h2>
		<div class="hd-retours__faq">
			<details>
				<summary>Quelle taille choisir ?</summary>
				<p>Medium si vous mesurez jusqu'à 1,87 m, Large au-delà. Toutes les dimensions sont sur la <a href="<?php echo esc_url( $hd_product_url ); ?>">fiche produit HomeDesk</a>.</p>
			</details>
			<details>
				<summary>Comment se passe le paiement ?</summary>
				<p>Vous payez à la livraison, après avoir vu le produit. La livraison est gratuite partout en Tunisie. <a href="<?php echo esc_url( home_url( '/#commander' ) ); ?>">Commander HomeDesk</a>.</p>
			</details>
			<details>
				<summary>Comment demander un retour ?</summary>
				<p>Dans les 3 jours qui suivent la réception, écrivez-nous à <a href="mailto:contact@homedesk.tn">contact@homedesk.tn</a>. Les étapes et les conditions sont détaillées sur la page <a href="<?php echo esc_url( $hd_retours_url ); ?>">Retours et remboursement</a>.</p>
			</details>
			<details>
				<summary>D'autres questions sur HomeDesk ?</summary>
				<p>Les réponses aux questions les plus fréquentes sont sur <a href="<?php echo esc_url( home_url( '/#faq' ) ); ?>">notre page d'accueil</a>. Et pour savoir d'où vient HomeDesk, lisez <a href="<?php echo esc_url( home_url( '/notre-histoire/' ) ); ?>">notre histoire</a>.</p>
			</details>
		</div>
	</section>

	<section class="hd-retours__cta">
		<div class="hd-retours__wrap">
			<h2>Essayez-le sans risque</h2>
			<p>Gardez votre bureau, ajoutez la position debout, et changez de posture en 5 secondes. Vous ne payez qu'à la réception.</p>
			<div class="hd-retours__btns">
				<a class="hd-retours__btn" href="<?php echo esc_url( home_url( '/#commander' ) ); ?>">Je commande mon HomeDesk →</a>
				<a class="hd-retours__btn hd-retours__btn--ghost" href="<?php echo esc_url( $hd_product_url ); ?>">Voir la fiche produit</a>
			</div>
		</div>
	</section>

</div>

<?php
get_footer();
