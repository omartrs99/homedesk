<?php
/**
 * Landing produit, audience « Étudiants », section « faq ».
 * Source : product-page/lp-etudiants.html (13. FAQ) + conditions de remboursement (communes).
 */
if ( ! defined( 'ABSPATH' ) ) exit;
?>
<!-- FAQ -->
<section class="section section--alt" id="faq">
	<div class="container">
		<div class="section-head center reveal">
			<span class="eyebrow">FAQ</span>
			<h2 class="h2">Tes questions, nos réponses</h2>
		</div>
		<div class="faq">
			<?php if ( $hd_solo > 0 ) : ?>
				<details><summary>C'est quoi la différence entre Solo et la version avec sac ?</summary><p>C'est exactement le même support. La version avec sac (<?php echo $hd_dt( $hd_prices['medium']['price'] ); ?> au lieu de <?php echo $hd_dt( $hd_prices['medium']['price'] - $hd_solo ); ?> pour la Medium) ajoute un sac de transport d'une valeur de 85 DT, pratique si tu l'emmènes à la fac ou à la bibliothèque.</p></details>
			<?php endif; ?>
			<details><summary>Ça rentre dans une petite chambre ?</summary><p>Oui. La version Medium fait 36 × 22 cm au sol pour 55 cm de haut. Elle se pose directement sur ton bureau ou ta table, sans prendre de place en plus.</p></details>
			<details><summary>Quelle taille choisir ?</summary><p>Medium si tu mesures jusqu'à 1,87 m. Large au-delà de 1,87 m (68 cm de haut, avec une étagère pour téléphone ou tablette en plus).</p></details>
			<details><summary>Je n'ai pas de carte bancaire, je peux commander ?</summary><p>Oui. Tu paies en espèces à la livraison, sans acompte. La livraison est gratuite partout en Tunisie.</p></details>
			<details><summary>C'est compliqué à monter ?</summary><p>Non. Les pièces s'assemblent sans outil, en quelques minutes. Ensuite, passer d'assis à debout prend 5 secondes.</p></details>
			<details><summary>Mon laptop va tenir dessus ?</summary><p>Oui, l'étagère haute (40 × 27 cm) accueille un PC portable jusqu'à 17 pouces, et l'étagère du dessous reçoit le clavier et la souris. Le support est en MDF stratifié de 18 mm, découpé à la CNC.</p></details>
			<details id="faq-remboursement"><summary>Et si ça ne me plaît pas ?</summary><p>Tu as 3 jours pour l'essayer chez toi. Pas convaincu ? Tu es remboursé.</p><p>Pour être remboursé, retourne le produit complet, avec tous ses accessoires, dans son état d'origine : sans casse, détérioration ni salissure. Après vérification à réception, tu es remboursé intégralement sous 7 jours ouvrables.</p></details>
		</div>
	</div>
</section>
