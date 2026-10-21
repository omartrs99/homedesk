<?php
/**
 * Landing produit — audience « Freelances ». Source : product-page/lp-freelances.html
 */
if ( ! defined( 'ABSPATH' ) ) exit;

return array(
	'eyebrow'  => 'Pour les freelances & nomades',
	'h1'       => 'Ton poste pro<span class="hl">te suit partout.</span>',
	'sub'      => 'HomeDesk transforme n\'importe quelle table en poste <strong>assis-debout</strong>. Tu le démontes, tu le glisses dans son sac, et tu retrouves ton setup chez chaque client.',
	'bullets'  => array(
		'Sac de transport offert avec la version principale (valeur 85 DT)',
		'Démontable sans outil, prêt en quelques minutes',
		'Laptop à hauteur des yeux, assis ou debout en 5 sec',
	),
	'cta'      => 'Je prends mon poste nomade →',
	'cta_pick' => array( 'taille' => 'medium', 'sac' => 'oui' ),
	'hero'     => array(
		'src' => 'piscine-nomade.webp',
		'w'   => 900,
		'h'   => 900,
		'alt' => 'Freelance qui travaille sur son laptop au bord d\'une piscine avec HomeDesk',
	),
);
