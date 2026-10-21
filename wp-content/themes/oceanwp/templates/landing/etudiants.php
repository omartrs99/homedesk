<?php
/**
 * Landing produit — audience « Étudiants ». Source : product-page/lp-etudiants.html
 * Met en avant la version Solo (sans sac), la moins chère.
 */
if ( ! defined( 'ABSPATH' ) ) exit;

return array(
	'eyebrow'  => '📚 Spécial étudiants',
	'h1'       => 'Le canapé n\'a jamais été<span class="hl">un bureau.</span>',
	'sub'      => 'HomeDesk transforme ta table ou ton bureau en poste <strong>assis-debout</strong> en 5 secondes. Pour réviser autrement que plié en deux sur ton lit.',
	'bullets'  => array(
		'Dès ' . $hd_dt( $hd_from ) . ', payé à la livraison : pas besoin de carte bancaire',
		'Compact : 36 × 22 cm au sol, parfait pour une petite chambre',
		'Écran à hauteur des yeux, assis comme debout',
	),
	'cta'      => 'Je prends le mien à ' . $hd_dt( $hd_from ) . ' →',
	'cta_pick' => array( 'taille' => 'medium', 'sac' => 'non' ),
	'hero'     => array(
		'src' => 'femme-sourire.webp',
		'w'   => 900,
		'h'   => 900,
		'alt' => 'Étudiante souriante qui travaille debout sur son laptop posé sur un HomeDesk',
	),
	'fonts'    => 'https://fonts.googleapis.com/css2?family=Caveat:wght@600;700&family=Fredoka:wght@500;600;700&display=swap',
);
