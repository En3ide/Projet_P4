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

    $cellules = put_cellule($grille, $colonne, $player);

    if ($cellules != null) {
        $reponse = [
            "status" => "success",
            "player" => $player,
            "cellule" => [($cellules[0]."-".$cellules[1])],
            "aligne_colonne" => testcolonne($grille, $cellules[0], $cellules[1], $player),
            "aligne_ligne" => testligne($grille, $cellules[0], $cellules[1], $player),
            "aligne_diagonale1" => testdiagonale1($grille, $cellules[0], $cellules[1], $player),
            "aligne_diagonale2" => testdiagonale2($grille, $cellules[0], $cellules[1], $player)
        ];

        file_put_contents('./grille.json', json_encode($grille));

        echo json_encode($reponse);
    } else {
        json_encode(["status" => "error", "message" => "Mouvement impossible"]);
    }
} else {
    echo json_encode(["status" => "error", "message" => "Données invalides"]);
}

function put_cellule(&$grille, $colonne, $player)
{
    for ($i = 9; $i >= 0; $i--) {
        if ($grille[$i][$colonne] == 0) {
            $grille[$i][$colonne] = $player;

            return [$i, $colonne];//$i . "-" . $colonne;
        }
    }
    return null;
}

function testcolonne($grille, $x, $y, $player) {
    $nbCaseAligne = 1;
    for ($i = $x + 1; $i < sizeof($grille); $i++) {
        if ($grille[$i][$y] != $player) {
            break;
        }
        $nbCaseAligne++;
    }
    for ($i = $x - 1; $i >= 0; $i--) {
        if ($grille[$i][$y] != $player) {
            break;
        }
        $nbCaseAligne++;
    }

    return $nbCaseAligne;
}

function testligne($grille, $x, $y, $player) {
    $nbCaseAligne = 1;
    for ($yu = $y + 1; $yu < sizeof($grille[$x]); $yu++) {
        if ($grille[$x][$yu] != $player) {
            break;
        }
        $nbCaseAligne++;
    }
    for ($yu = $y - 1; $yu >= 0; $yu--) {
        if ($grille[$x][$yu] != $player) {
            break;
        }
        $nbCaseAligne++;
    }

    return $nbCaseAligne;
}

function testdiagonale1($grille, $x, $y, $player) {
    $nbCaseAligne = 1;
    //(↘)
    for ($i = 1; $x + $i < sizeof($grille) && $y + $i < sizeof($grille[$x]); $i++) {
        if ($grille[$x + $i][$y + $i] != $player) {
            break;
        }
        $nbCaseAligne++;
    }
    //(↖)
    for ($i = 1; $x - $i >= 0 && $y - $i >= 0; $i++) {
        if ($grille[$x - $i][$y - $i] != $player) {
            break;
        }
        $nbCaseAligne++;
    }

    return $nbCaseAligne;
}

function testdiagonale2($grille, $x, $y, $player) {
    $nbCaseAligne = 1;
    //(↙)
    for ($i = 1; $x + $i < sizeof($grille) && $y - $i >= 0; $i++) {
        if ($grille[$x + $i][$y - $i] != $player) {
            break;
        }
        $nbCaseAligne++;
    }
    //(↗)
    for ($i = 1; $x - $i >= 0 && $y + $i < sizeof($grille[$x]); $i++) {
        if ($grille[$x - $i][$y + $i] != $player) {
            break;
        }
        $nbCaseAligne++;
    }

    return $nbCaseAligne;
}




function nbcasealigne($grille, $x,$y, $player, $required) {
    $caseList = [];
    $nbCaseAligne = 0;
    for($xu = $x; $xu < sizeof($grille); $xu++) {
        if($grille[$xu][$y] != $player) {
            break;
        }
        $nbCaseAligne++;
        $caseList[] = [$xu,$y];
    }
    for($xu = $x; $xu > 0; $xu--) {
        if($grille[$xu][$y] != $player) {
            break;
        }
        $nbCaseAligne++;
        $caseList[] = [$xu,$y];
    }
    if($nbCaseAligne >= $required) {
        return [$nbCaseAligne, $caseList];
    }
    //C'est la vie
    $caseList = [];
    $nbCaseAligne = 0;
    for($xu = $x; $xu < sizeof($grille); $xu++) {
        if($grille[$x][$xu] != $player) {
            break;
        }
        $nbCaseAligne++;
    }
    for($xu = $x; $xu > 0; $xu--) {
        if($grille[$x][$xu] != $player) {
            break;
        }
        $nbCaseAligne++;
    }
    if($nbCaseAligne >= $required) {
        return [$nbCaseAligne, $caseList];
    }
}

function lireGrille($fichier)
{
    if (file_exists($fichier)) {
        $contenu = file_get_contents($fichier);
        $grille = json_decode($contenu, true);
        return $grille !== null ? $grille : null;
    }
    return null;
}

function creatfile($fichier)
{
    $grille = array_fill(0, 10, array_fill(0, 10, 0));
    file_put_contents($fichier, json_encode($grille));
}
