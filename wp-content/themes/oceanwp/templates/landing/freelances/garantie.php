<?php
/**
 * Landing produit, audience « Freelances », section « garantie ».
 * Source : product-page/lp-freelances.html (12. GARANTIE), avec le sceau animé de la section commune.
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
				<h3>Teste-le sur tes vrais lieux de travail</h3>
				<p>Tu paies seulement quand tu reçois ton HomeDesk. Ensuite, tu as 3 jours pour l'emmener au café, au coworking ou chez un client. Pas convaincu ? Tu es remboursé.</p>
				<ol class="g-steps">
					<li><span>📦</span><div><b>Tu reçois</b> et paies à la livraison</div></li>
					<li><span>🧑‍💻</span><div><b>Tu l'essaies</b> 3 jours, où tu travailles</div></li>
					<li><span>↩️</span><div><b>Pas convaincu ?</b> Tu es remboursé</div></li>
				</ol>
				<a class="g-link" href="#faq-remboursement" data-open-faq>Voir les conditions de remboursement →</a>
			</div>
		</div>
	</div>
</section>
