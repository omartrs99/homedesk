<?php
/**
 * Template Name: Retours et remboursement HomeDesk
 *
 * Page /retours-et-remboursement/ : le contenu est ici (versionné dans git) et arrive en prod
 * avec le déploiement. La page WordPress est créée automatiquement (custom-functions.php).
 * Source des conditions : texte fourni par HomeDesk (essai 3 jours, satisfait ou remboursé).
 *
 * Point de départ des 3 jours et e-mail : repris de la politique de confidentialité publiée.
 * Moyens de remboursement (virement, Wafacash, izi) : fournis par HomeDesk.
 * À CONFIRMER avant d'ajouter au texte (non publié sur le site, donc non écrit ici) : frais de retour.
 *
 * @package OceanWP WordPress theme
 */

if ( ! defined( 'ABSPATH' ) ) exit;

$hd_product_id  = function_exists( 'homedesk_default_product_id' ) ? homedesk_default_product_id() : 0;
$hd_product_url = $hd_product_id ? get_permalink( $hd_product_id ) : home_url( '/' );
$hd_contact_url = home_url( '/contactez-nous/' );
$hd_contact     = homedesk_contact_info();

get_header();
?>

<div class="hd-retours">

	<header class="hd-retours__hero">
		<div class="hd-retours__wrap">
			<span class="hd-retours__eyebrow">Garantie satisfait ou remboursé</span>
			<h1>Retours et remboursement</h1>
			<p class="hd-retours__lead">Essayez <a href="<?php echo esc_url( home_url( '/' ) ); ?>">votre support assis-debout HomeDesk</a> chez vous pendant 3 jours. S'il ne vous convient pas, vous êtes remboursé.</p>
		</div>
	</header>

	<section class="hd-retours__wrap" aria-label="L'essentiel">
		<ul class="hd-retours__keys">
			<li><span aria-hidden="true">💳</span><b>Vous payez à la livraison</b>Après avoir vu le produit, jamais avant.</li>
			<li><span aria-hidden="true">🗓️</span><b>3 jours pour l'essayer</b>Dans vos vraies journées de travail, chez vous.</li>
			<li><span aria-hidden="true">↩️</span><b>Remboursement intégral</b>Sous 7 jours ouvrables après validation du retour.</li>
		</ul>
	</section>

	<section class="hd-retours__wrap hd-retours__section">
		<h2>Comment se passe un retour ?</h2>
		<ol class="hd-retours__steps">
			<li><b>Vous recevez votre HomeDesk</b> et vous le payez au livreur. La livraison est gratuite partout en Tunisie.</li>
			<li><b>Vous l'essayez pendant 3 jours</b> à compter de la réception de votre commande, assis et debout, avec votre propre bureau et votre ordinateur.</li>
			<li><b>Il ne vous convient pas ?</b> Demandez votre retour dans ce délai de 3 jours, sur <a href="<?php echo esc_url( $hd_contact['whatsapp_url'] ); ?>" target="_blank" rel="noopener">WhatsApp au <?php echo esc_html( $hd_contact['whatsapp'] ); ?></a>, par e-mail à <a href="mailto:contact@homedesk.tn">contact@homedesk.tn</a> ou depuis la <a href="<?php echo esc_url( $hd_contact_url ); ?>">page contact</a> : notre équipe vous indique comment nous le retourner.</li>
			<li><b>Nous vérifions le produit</b> dès sa réception, pour confirmer qu'il respecte les conditions de retour ci-dessous.</li>
			<li><b>Vous êtes remboursé intégralement</b> du montant payé, dans un délai maximum de 7 jours ouvrables à compter de la validation du retour, par le moyen de votre choix : virement bancaire, Wafacash ou izi.</li>
		</ol>
	</section>

	<section class="hd-retours__wrap hd-retours__section">
		<h2>Conditions pour être remboursé</h2>
		<div class="hd-retours__box">
			<ul class="hd-retours__checks">
				<li><span>Le produit est retourné dans son <b>état d'origine</b>, le même que lors de sa livraison.</span></li>
				<li><span>Il ne présente <b>aucune cassure, détérioration ni salissure</b>.</span></li>
				<li><span><b>Tous les accessoires et éléments fournis</b> sont retournés avec lui.</span></li>
			</ul>
			<p><b>Conseil :</b> pendant l'essai, gardez de côté tous les éléments reçus avec votre HomeDesk, pour pouvoir le retourner complet si besoin.</p>
		</div>
	</section>

	<section class="hd-retours__wrap hd-retours__section">
		<h2>Votre argent vous revient, comme vous le souhaitez</h2>
		<p class="hd-retours__intro">Vous avez payé en espèces au livreur ? Pas de souci : c'est vous qui choisissez comment recevoir votre remboursement. Dites-nous simplement l'option qui vous arrange au moment de votre demande de retour.</p>
		<ul class="hd-retours__keys hd-retours__keys--inline">
			<li><span aria-hidden="true">🏦</span><b>Virement bancaire</b>Directement sur votre compte, avec votre RIB.</li>
			<li><span aria-hidden="true">💵</span><b>Wafacash</b>Vous retirez l'argent en espèces, dans l'agence la plus proche de chez vous.</li>
			<li><span aria-hidden="true">📱</span><b>IZI Zitouna</b>Sur votre portefeuille izi, depuis votre téléphone.</li>
		</ul>
		<p class="hd-retours__intro hd-retours__intro--after">Quel que soit votre choix, vous récupérez <b>l'intégralité du montant payé</b>, sous 7 jours ouvrables maximum après la validation du retour.</p>
	</section>

	<section class="hd-retours__wrap hd-retours__section">
		<h2>Questions fréquentes</h2>
		<div class="hd-retours__faq">
			<details>
				<summary>Comment demander un retour ?</summary>
				<p>Écrivez-nous sur <a href="<?php echo esc_url( $hd_contact['whatsapp_url'] ); ?>" target="_blank" rel="noopener">WhatsApp au <?php echo esc_html( $hd_contact['whatsapp'] ); ?></a>, à <a href="mailto:contact@homedesk.tn">contact@homedesk.tn</a> ou depuis la <a href="<?php echo esc_url( $hd_contact_url ); ?>">page contact</a>, dans les 3 jours qui suivent la réception de votre commande, en indiquant votre nom et le numéro de téléphone utilisé pour la commande. Notre équipe vous explique la marche à suivre.</p>
			</details>
			<details>
				<summary>Quand vais-je être remboursé ?</summary>
				<p>Le remboursement intégral du montant payé est effectué dans un délai maximum de 7 jours ouvrables à compter de la validation de votre retour, après vérification du produit.</p>
			</details>
			<details>
				<summary>Comment vais-je recevoir mon remboursement ?</summary>
				<p>C'est vous qui choisissez : par virement bancaire, par Wafacash ou sur votre portefeuille IZI Zitouna. Indiquez-nous simplement votre préférence lors de votre demande de retour, et nous vous remboursons par ce moyen.</p>
			</details>
			<details>
				<summary>Je ne sais pas quelle taille choisir, que faire ?</summary>
				<p>Pour éviter un retour, comparez les deux versions sur la <a href="<?php echo esc_url( $hd_product_url ); ?>">fiche produit HomeDesk</a> : Medium jusqu'à 1,87 m, Large au-delà. Les dimensions détaillées y sont indiquées.</p>
			</details>
			<details>
				<summary>Est-ce que je paie avant de recevoir le produit ?</summary>
				<p>Non. Vous payez à la livraison, après avoir vu le produit. <a href="<?php echo esc_url( home_url( '/#faq' ) ); ?>">Voir toutes les questions sur HomeDesk</a>.</p>
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
