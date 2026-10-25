<?php
/**
 * Landing produit, section « objection » pour l'audience Développeurs.
 * Source : product-page/lp-developpeurs.html (ton tutoiement, univers IDE).
 */
if ( ! defined( 'ABSPATH' ) ) exit;
?>
<!-- OBJECTION PRINCIPALE : stabilité (fiche en JSON) -->
<section class="section section--alt">
	<div class="container objection">
		<div class="objection__imgs reveal">
			<img src="<?php echo esc_url( $hd_img . 'post-stable.webp' ); ?>" alt="HomeDesk : structure stable en MDF" width="800" height="1006" loading="lazy">
			<img src="<?php echo esc_url( $hd_img . 'detail-clavier.webp' ); ?>" alt="Mains sur un clavier posé sur l'étagère inférieure de HomeDesk" width="500" height="500" loading="lazy">
			<img src="<?php echo esc_url( $hd_img . 'gal-2.webp' ); ?>" alt="Femme qui tape au clavier debout devant son HomeDesk, PC portable posé sur l'étagère haute" width="500" height="500" loading="lazy">
		</div>
		<div class="reveal">
			<span class="eyebrow">issue #1</span>
			<h2 class="h2">«&nbsp;Ça reste stable quand je tape&nbsp;?&nbsp;»</h2>
			<p class="lead">C'est la première question des devs, et c'est normal. HomeDesk est découpé à la CNC dans du MDF stratifié de 18 mm d'épaisseur. Le clavier a sa propre étagère, sous celle de l'écran : tu tapes sans faire bouger ton laptop.</p>
<pre class="spec"><span class="c">// homedesk.config.json — version Medium</span>
{
  <span class="k">"materiau"</span>:  <span class="s">"MDF stratifié blanc, 18 mm"</span>,
  <span class="k">"etagere_ecran"</span>: <span class="s">"40 × 27 cm"</span>,
  <span class="k">"etagere_clavier"</span>: <span class="s">"54 × 22 cm"</span>,
  <span class="k">"pc_max"</span>:    <span class="s">"17 pouces"</span>,
  <span class="k">"hauteur"</span>:   <span class="s">"55 cm"</span>,
  <span class="k">"moteur"</span>:    null
}</pre>
			<div class="cta-wrap">
				<a class="btn" href="#commander">Je teste 3 jours chez moi →</a>
				<p class="cta-note">Pas convaincu ? <strong>Satisfait ou remboursé.</strong></p>
			</div>
		</div>
	</div>
</section>
