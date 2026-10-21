<?php
/**
 * Landing produit, audience « Freelances », section « faq ».
 * Source : product-page/lp-freelances.html (13. FAQ), conditions de remboursement de la section commune.
 */
if ( ! defined( 'ABSPATH' ) ) exit;
?>
<!-- FAQ -->
<section class="section section--alt" id="faq">
	<div class="container">
		<div class="section-head center reveal">
			<span class="eyebrow">FAQ</span>
			<h2 class="h2">Tes questions avant de partir</h2>
		</div>
		<div class="faq">
			<details><summary>Ça se transporte vraiment facilement ?</summary><p>Oui. HomeDesk se démonte sans outil et se range dans son sac de transport, livré avec la version principale. Le support pèse 5 kg en Medium et 7 kg en Large.</p></details>
			<details><summary>Il tient sur n'importe quelle table ?</summary><p>Il se pose sur une surface existante : bureau, table de café, table de coworking. Il faut une surface d'environ 36 × 22 cm pour la Medium et 45 × 34 cm pour la Large.</p></details>
			<details><summary>Quelle taille choisir ?</summary><p>Medium si tu mesures jusqu'à 1,87 m (hauteur 55 cm). Large au-delà de 1,87 m (hauteur 68 cm, avec une étagère pour téléphone ou tablette en plus).</p></details>
			<?php if ( $hd_solo > 0 ) : ?>
				<details><summary>Avec ou sans sac, je prends quoi ?</summary><p>Si tu le déplaces, même de temps en temps, prends la version avec sac : il est offert (valeur 85 DT). S'il reste toujours au même endroit, HomeDesk Solo, sans sac, te fait économiser <?php echo $hd_dt( $hd_solo ); ?>.</p></details>
			<?php endif; ?>
			<details><summary>C'est compliqué à monter ?</summary><p>Non. Les pièces s'assemblent sans outil, en quelques minutes. Ensuite, passer d'assis à debout prend 5 secondes.</p></details>
			<details><summary>Comment je paie ?</summary><p>À la livraison, en espèces. Aucun paiement en ligne, aucun acompte. La livraison est gratuite partout en Tunisie.</p></details>
			<details id="faq-remboursement"><summary>Et si ça ne me convient pas ?</summary><p>Tu as 3 jours pour l'essayer. Pas convaincu ? Tu es remboursé.</p><p>Pour être remboursé, retourne le produit complet, avec tous ses accessoires, dans son état d'origine : sans casse, détérioration ni salissure. Après vérification à réception, tu es remboursé intégralement sous 7 jours ouvrables.</p></details>
		</div>
	</div>
</section>
