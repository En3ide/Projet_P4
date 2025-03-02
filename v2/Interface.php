<?php
function send_game_data($api_url, $game_id, $game_path, $player2, $player2_role, $player2_path) {
    $data = array(
        "game_id" => $game_id,
        "game_path" => $game_path,
        "player2" => $player2,
        "player2_role" => $player2_role,
        "player2_path" => $player2_path
    );
    $json_data = json_encode($data);
    $ch = curl_init($api_url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);//retourner la réponse au lieu de l'afficher
    curl_setopt($ch, CURLOPT_POST, true);//spécifie une requête POST
    curl_setopt($ch, CURLOPT_POSTFIELDS, $json_data);//ajouter les données JSON dans la requête
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Content-Type: application/json',
        'Content-Length: ' . strlen($json_data)//spécifie la longueur des données
    ));
    $response = curl_exec($ch);
    if(curl_errno($ch)) {
        echo 'Erreur cURL: ' . curl_error($ch);
    }
    curl_close($ch);
    return $response;
}

$api_url = $_POST[""]."/join_game.php";
$game_id = 123;
$game_path = "~jean_valjean/";
$player2 = "Sam";
$player2_role = "human"; // ou "AI"
$player2_path = "~sam_gamegie/SAE/";

$response = send_game_data($api_url, $game_id, $game_path, $player2, $player2_role, $player2_path);

echo $response;

?>

<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]>      <html class="no-js"> <!--<![endif]-->
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Puissance 4</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="./style.css">
        </head>
    <body>
        <h1 id="annonce" style="
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background: rgba(0, 0, 0, 0.7);
            color: white;
            padding: 20px 40px;
            border-radius: 10px;
            font-size: 2rem;
            z-index: 9999;
            text-align: center;"
            >Joueur 1</h1>
        <h2 style="text-align: center;">Puissance 4</h2>
        <table id="grille" summary="Grille du puissance 4">
        <tbody>
            <?php
                // générer la grille
                for($i=0; $i<7; $i++) {
                    echo "<tr>";
                    for($j=0; $j<6; $j++) {
                        echo "<td class='cellule-ronde' id='".$i."-".$j."'></td>";
                    }
                    echo "</tr>";
                }
            ?>
        </tbody>
        </table>
        <div style="display: flex; justify-content: center;">
            <button onclick="" id="make_bdd">Add BDD</button>
            <p id="id_player">id_player : </p>
            <button onclick="" id="make_bdd">sert a rien</button>
            <button onclick="clear();" id="clear">Clear Grille</button>
        </div>
        <script>
            current_player = 1;
            min = 4;

            document.getElementById("grille").addEventListener("click", function send_input(event) {
                let cell = event.target.closest("td");
                if (!cell) return;
                
                let row = cell.parentElement;
                let rowIndex = row.rowIndex;

                console.log("Colonne cliquée :", rowIndex);
                addToken(current_player, rowIndex);
            });

            function addToken(player, column) {
                fetch('./puissance4.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ "player": current_player, "colonne": column })
                })
                .then(response => response.json())
                .then(
                    data => {console.log("Réponse de l'API :", data);
                    if(data["cellule"] != [0] || data["cellule"][0] != null) {
                        if(data["aligne_colonne"] >= min || data["aligne_ligne"] >= min || data["aligne_diagonale1"] >= min || data["aligne_diagonale2"] >= min) {
                            document.getElementById("annonce").style.display = "block";
                            document.getElementById("annonce").innerHTML = "Joueur " + data["player"] + " a gagné !";
                            document.getElementById("grille").removeEventListener("click", send_input);
                        }
                        update_board(data);
                        switch_player();
                        
                    }
                })
                .catch(error => console.error("Erreur :", error));
            }

            function update_board(data) {
                for (let cell of data.cellule) {
                    let elt = document.getElementById(cell)
                    
                    /*
                    if(elt.classList.contains("CJ" + reverse_player()))
                        elt.classList.remove("CJ" + reverse_player());
                    */
                    console.log(elt);
                    elt.classList.add("CJ" + data.player);
                    console.log("cellule", cell);
                    
                }
            }

            function switch_player() {
                current_player = current_player === 1 ? 2 : 1;
                const root = document.documentElement;
                root.style.setProperty('--color-body', 'var(--color-j'+current_player+')');
            }

            function reverse_player() {
                return current_player === 1 ? 2 : 1;
            }

            

            function clear() {
                fetch("./supp_fichier.php", {
                        method: "POST"
                    })
                    .then(response => response.text())
                    .then(data => console.log("Réponse de l'API:", data))
                    .catch(error => console.error("Erreur :", error));
            }

            document.getElementById("clear").addEventListener("click", function(event) {
                clear();
                window.location.replace(window.location.href);
            });

            window.onload = function() {
                clear();
            };
        </script>
        <script src="" async defer></script>
    </body>
</html>