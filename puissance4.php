<?php

$data = json_decode(file_get_contents("php://input"), true);

if (isset($data['player']) && isset($data['colonne'])) {
    $player = $data['player'];
    $colonne = $data['colonne'];

    $grille = lireGrille('./grille.json');
    if ($grille === null) {
        creatfile('./grille.json');
        $grille = lireGrille('./grille.json');
    }

    $cellule = put_cellule($grille, $colonne, $player);

    $reponse = [
        "status" => "success", 
        "player" => $player, 
        "cellule" => $cellule
    ];

    file_put_contents('./grille.json', json_encode($grille));

    echo json_encode($reponse);
} else {
    echo json_encode(["status" => "error", "message" => "Données invalides"]);
}

function put_cellule($grille, $colonne, $player) {
    for ($i = 9; $i >= 0; $i--) {
        if ($grille[$i][$colonne] == 0) {
            $grille[$i][$colonne] = $player;
            return "$colonne-$i";
        }
    }
    return null;
}

function lireGrille($fichier) {
    if (file_exists($fichier)) {
        $contenu = file_get_contents($fichier);
        $grille = json_decode($contenu, true);
        return $grille !== null ? $grille : null;
    }
    return null;
}

function creatfile($fichier) {
    $grille = array_fill(0, 10, array_fill(0, 10, 0));
    file_put_contents($fichier, json_encode($grille));
}

?>
