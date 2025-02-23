<?php
    // je recupere les données postées
    $donnees = $_POST; 
    
    // je fais mon traitement
	$tab = ["game" => "1", board => [[0,1,0],[2,1,0],[2,2,1]]];
    
    // au lieu de générer une page html, je renvoie un flux json
	echo json_encode($tab);
?>
