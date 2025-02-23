<?php
if(isset($_POST["P4_player1_color"])) 
    setcookie("P4_player1_color", $_POST["P4_player1_color"], time() + 3600, false, false);
if(isset($_POST["P4_player2_color"]))
    setcookie("P4_player2_color", $_POST["P4_player2_color"], time() + 3600, false, false);
if(isset($_POST["P4_player_name"]))
    setcookie("P4_player_name", $_POST["P4_player_name"], time() + 3600, false, false);
// style
isset($_COOKIE["P4_bg_color"]) ? $bg_color = $_COOKIE["P4_bg_color"] : $bg_color = "white";
isset($_COOKIE["P4_font_color"]) ? $font_color = $_COOKIE["P4_font_color"] : $font_color = "black";
isset($_COOKIE["P4_font_color_secondary"]) ? $font_color_secondary = $_COOKIE["P4_font_color_secondary"] : $font_color_secondary = "white";
isset($_COOKIE["P4_bg_color_ex1"]) ? $bg_color_ex1 = $_COOKIE["P4_bg_color_ex1"] : $bg_color_ex1 = "white";
isset($_COOKIE["P4_bg_color_secondary"]) ? $bg_color_secondary = $_COOKIE["P4_bg_color_secondary"] : $bg_color_secondary = "black";
isset($_COOKIE["P4_bg_color_party"]) ? $bg_color_party = $_COOKIE["P4_bg_color_party"] : $bg_color_party = "black";
isset($_COOKIE["P4_font_color_party"]) ? $font_color_party = $_COOKIE["P4_font_color_party"] : $font_color_party = "white";

echo '
    <style>
        /* Variables CSS */
        :root {
            --font-fam: Arial, Helvetica, sans-serif;
            --bg-color: '. $bg_color .';
            --font-color: '. $font_color .';
            --font-color-secondary: '.$font_color_secondary.';
            --bg-color-ex1: '. $bg_color_ex1.';
            --bg-color-secondary: '. $bg_color_secondary.';
            --bg-color-party: '. $bg_color_party.';
            --font-color-party: '. $font_color_party.';
        }
    </style>';
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Puissance 4</title>
        <meta name="description" content="">
        <html xmlns="http://www.w3.org/1999/xhtml">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="./style_lobby.css">
        <!----<script src="./lobby.js"></script>---->
        </head>
<body>
    <nav>
    <form style="display:flex; flex-direction:column; align-items:center; justify-content:center;" action="lobby.php" method="post">
        <?php
            // color player 1
            if (isset($_POST["P4_player1_color"])) {
                $p1color = $_POST["P4_player1_color"];
            } else if (isset($_COOKIE["P4_player1_color"])) {
                $p1color = $_COOKIE["P4_player1_color"];
            } else {
                $p1color = '#00FFFF';
            }
            // color player 2
            if (isset($_POST["P4_player2_color"])) {
                $p2color = $_POST["P4_player2_color"];
            } else if (isset($_COOKIE["P4_player2_color"])) {
                $p2color = $_COOKIE["P4_player2_color"];
            } else {
                $p2color = '#FF0000';
            }
            // pseudo
            if (isset($_POST["P4_player_name"])) {
                $player_name = $_POST["P4_player_name"];
            } else if (isset($_COOKIE["P4_player_name"])) {
                $player_name = $_COOKIE["P4_player_name"];
            } else {
                $player_name = '#FF0000';
            }
            // type
            if (isset($_POST["P4_player_role"])) {
                $P4_player_role = $_POST["P4_player_role"];
            } else if (isset($_COOKIE["P4_player_role"])) {
                $P4_player_role = $_COOKIE["P4_player_role"];
            } else {
                $P4_player_role = 'human';
            }

            echo '<input id="P4_player1_color" type="color" name="P4_player1_color" value="'.$p1color.'"/>';
            echo '<input id="P4_player2_color" type="color" name="P4_player2_color" value="'.$p2color.'"/>';
        ?>
        <select name="P4_player_role" id="P4_player_role">
            <option value="human" <?php echo $P4_player_role == 'human' ? 'selected' : ''; ?>>Human</option>
            <option value="AI" <?php echo $P4_player_role == 'AI' ? 'selected' : ''; ?>>AI</option>
        </select>
        <input type="text" id="P4_player_name" name="P4_player_name" placeholder="Nom du joueur" value="<?php echo $player_name; ?>"/>
        <input type="submit" value="Valider"/>
        </form>
    </nav>
    <div class="container">
        <h2>Puissance 4</h2>
        <div class="div_lobby">
        <input id="adresse_server" type="url" name="server_host" placeholder="http://adresse" value=""/>
            <div id="list_party">
            </div>
        </div>
    </div>
</body>
    <script>
        $adresse = document.getElementById("adresse_server");
        $list_party = document.getElementById("list_party");

        window.onload = setInterval(() => {
            if ($adresse.value.trim() !== "") {
                getparty($adresse.value.trim());
            } else {
                getparty(baseUrl());
            }
        }, 1000);

        function baseUrl() {
            let currentUrl = window.location.href;
            let baseUrl = currentUrl.replace(/\/[^\/]*$/, ''); //retirer la dernière partie de l'URL
            //console.log(baseUrl);
            return baseUrl;
        }

        function getparty($adresse) {
            fetch($adresse + "/list_games.php", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json"
                    },
                    body: JSON.stringify({
                        "status": "all",
                        "path": "~jean_valjean/"
                    })
                })
                .then(response => response.json())
                .then(response => {
                    console.log(response);
                    fill_list_party(response, $adresse);
                })
                .catch(error => console.log("Erreur : " + error));
        }

        function fill_list_party(response, $addr) {
            $page_party = './requete_test.php';//'./Interface.php';
            $list_party.innerHTML = "";
            response["games"].forEach(game => {
                $list_party.innerHTML +=
                    '<form class="party" method="POST" action="'+ $page_party +'">'+
                    '<input type="submit" class="party_join" name="party_join" value="Rejoindre" '+
                    (game["status"] === "over" ? 'readonly' : '') +'"/><hr/>'+
                    '<input class="party_status" value="'+
                    game["status"] + '" readonly/>'+
                    '<input class="party_id" name="game_id" value="'+
                    game["game_id"]+'" readonly/>'+
                    '<input class="party_player1" name="player1" value="'+
                    game["player1"]+'" readonly/>'+
                    '<input class="party_path" name="game_path" value="'+
                    game["player1_path"]+'" readonly/>'+
                    '<input class="hidden" name="addr" value="'+
                    $addr+'" readonly/>'+
                    '<input class="hidden" name="player2" value="'+
                    (document.getElementById("P4_player_name").value.trim())+'" readonly/>'+
                    '<input class="hidden" name="player2_role" value="'+
                    (document.querySelector('select[name="P4_player_role"]').value.trim()) +'" readonly/>'+
                    '<input class="hidden" name="player2_path" value="'+
                    baseUrl() +'" readonly/>'+
                    '<input class="hidden" name="P4_player1_color" value="'+
                    (document.getElementById("P4_player1_color").value) +'" readonly/>'+
                    '<input class="hidden" name="P4_player2_color" value="'+
                    (document.getElementById("P4_player2_color").value) +'" readonly/>'+
                    '</form>';
            });
        }
    </script>
</html>