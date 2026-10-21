<?php
/**
 * Landing produit, section « garantie » (commune à toutes les audiences).
 * Une audience peut la remplacer par templates/landing/{audience}/garantie.php.
 */
if ( ! defined( 'ABSPATH' ) ) exit;
?>
<!-- GARANTIE -->
<section class="section section--tight">
	<div class="container">
		<div class="guarantee guarantee--pro reveal">
			<div class="seal" aria-hidden="true">
				<svg class="seal__ring" viewBox="0 0 200 200">
					<defs><path id="seal-path" d="M100,100 m-78,0 a78,78 0 1,1 156,0 a78,78 0 1,1 -156,0"/></defs>
					<text><textPath href="#seal-path" textLength="488">SATISFAIT OU REMBOURSÉ · SATISFAIT OU REMBOURSÉ ·</textPath></text>
				</svg>
				<div class="seal__core">
					<svg class="seal__check" viewBox="0 0 24 24"><path d="M12 2 4 5v6c0 5 3.4 9.3 8 11 4.6-1.7 8-6 8-11V5l-8-3Z"/><path class="seal__tick" d="m8.5 12 2.5 2.5 4.5-5"/></svg>
					<b>3 jours</b><small>d'essai</small>
				</div>
			</div>
			<div>
				<span class="eyebrow">Garantie satisfait ou remboursé</span>
				<h3>Essayez-le chez vous, sans engagement</h3>
				<p>Vous payez à la livraison. Ensuite, vous avez 3 jours pour l'essayer dans vos vraies journées de travail. Pas convaincu ? Vous êtes remboursé.</p>
				<ol class="g-steps">
					<li><span>📦</span><div><b>Vous recevez</b> et payez à la livraison</div></li>
					<li><span>🧑‍💻</span><div><b>Vous l'essayez</b> 3 jours chez vous</div></li>
					<li><span>↩️</span><div><b>Pas convaincu ?</b> Vous êtes remboursé</div></li>
				</ol>
				<a class="g-link" href="#faq-remboursement" data-open-faq>Voir les conditions de remboursement →</a>
			</div>
		</div>
	</div>
</section>
