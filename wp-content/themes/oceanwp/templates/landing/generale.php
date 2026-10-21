<?php
/**
 * Landing produit — audience « Générale » (page d'accueil).
 * Chaque fichier d'audience renvoie uniquement ce qui change par rapport à la page générale.
 * Source : product-page/product-page.html
 */
if ( ! defined( 'ABSPATH' ) ) exit;

return array(
	'eyebrow'  => 'Support assis-debout · Fabriqué en Tunisie',
	'h1'       => 'Arrêtez de rester assis toute la journée.<span class="hl">Changez de position quand vous voulez.</span>',
	'sub'      => 'HomeDesk se pose sur votre bureau actuel, sans rien changer chez vous. Vous passez <strong>d\'assis à debout en 5 secondes</strong>, l\'écran à hauteur des yeux, à la maison comme au bureau.',
	'bullets'  => array(
		'Rien à brancher, aucun réglage compliqué',
		'Montage sans outil, prêt en quelques minutes',
		'Démontable, avec son sac de transport offert',
	),
	'cta'      => 'Je commande mon HomeDesk →',
	'cta_pick' => array(), // array( 'taille' => 'medium', 'sac' => 'non' ) pour présélectionner une version
	'hero'     => array(
		'src' => 'hero-homme-pc.webp',
		'w'   => 1100,
		'h'   => 1100,
		'alt' => 'Homme souriant travaillant debout, son ordinateur posé sur un HomeDesk',
	),
);
