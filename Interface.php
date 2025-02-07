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
        <!--[if lt IE 7]>
            <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="#">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
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
            <tr>
                <td class="cellule-ronde" id="0-0"></td>
                <td class="cellule-ronde" id="1-0"></td>
                <td class="cellule-ronde" id="2-0"></td>
                <td class="cellule-ronde" id="3-0"></td>
                <td class="cellule-ronde" id="4-0"></td>
                <td class="cellule-ronde" id="5-0"></td>
                <td class="cellule-ronde" id="6-0"></td>
                <td class="cellule-ronde" id="7-0"></td>
                <td class="cellule-ronde" id="8-0"></td>
                <td class="cellule-ronde" id="9-0"></td>
            </tr>
            <tr>
                <td class="cellule-ronde" id="0-1"></td>
                <td class="cellule-ronde" id="1-1"></td>
                <td class="cellule-ronde" id="2-1"></td>
                <td class="cellule-ronde" id="3-1"></td>
                <td class="cellule-ronde" id="4-1"></td>
                <td class="cellule-ronde" id="5-1"></td>
                <td class="cellule-ronde" id="6-1"></td>
                <td class="cellule-ronde" id="7-1"></td>
                <td class="cellule-ronde" id="8-1"></td>
                <td class="cellule-ronde" id="9-1"></td>
            </tr>
            <tr>
                <td class="cellule-ronde" id="0-2"></td>
                <td class="cellule-ronde" id="1-2"></td>
                <td class="cellule-ronde" id="2-2"></td>
                <td class="cellule-ronde" id="3-2"></td>
                <td class="cellule-ronde" id="4-2"></td>
                <td class="cellule-ronde" id="5-2"></td>
                <td class="cellule-ronde" id="6-2"></td>
                <td class="cellule-ronde" id="7-2"></td>
                <td class="cellule-ronde" id="8-2"></td>
                <td class="cellule-ronde" id="9-2"></td>
            </tr>
            <tr>
                <td class="cellule-ronde" id="0-3"></td>
                <td class="cellule-ronde" id="1-3"></td>
                <td class="cellule-ronde" id="2-3"></td>
                <td class="cellule-ronde" id="3-3"></td>
                <td class="cellule-ronde" id="4-3"></td>
                <td class="cellule-ronde" id="5-3"></td>
                <td class="cellule-ronde" id="6-3"></td>
                <td class="cellule-ronde" id="7-3"></td>
                <td class="cellule-ronde" id="8-3"></td>
                <td class="cellule-ronde" id="9-3"></td>
            </tr>
            <tr>
                <td class="cellule-ronde" id="0-4"></td>
                <td class="cellule-ronde" id="1-4"></td>
                <td class="cellule-ronde" id="2-4"></td>
                <td class="cellule-ronde" id="3-4"></td>
                <td class="cellule-ronde" id="4-4"></td>
                <td class="cellule-ronde" id="5-4"></td>
                <td class="cellule-ronde" id="6-4"></td>
                <td class="cellule-ronde" id="7-4"></td>
                <td class="cellule-ronde" id="8-4"></td>
                <td class="cellule-ronde" id="9-4"></td>
            </tr>
            <tr>
                <td class="cellule-ronde" id="0-5"></td>
                <td class="cellule-ronde" id="1-5"></td>
                <td class="cellule-ronde" id="2-5"></td>
                <td class="cellule-ronde" id="3-5"></td>
                <td class="cellule-ronde" id="4-5"></td>
                <td class="cellule-ronde" id="5-5"></td>
                <td class="cellule-ronde" id="6-5"></td>
                <td class="cellule-ronde" id="7-5"></td>
                <td class="cellule-ronde" id="8-5"></td>
                <td class="cellule-ronde" id="9-5"></td>
            </tr>
            <tr>
                <td class="cellule-ronde" id="0-6"></td>
                <td class="cellule-ronde" id="1-6"></td>
                <td class="cellule-ronde" id="2-6"></td>
                <td class="cellule-ronde" id="3-6"></td>
                <td class="cellule-ronde" id="4-6"></td>
                <td class="cellule-ronde" id="5-6"></td>
                <td class="cellule-ronde" id="6-6"></td>
                <td class="cellule-ronde" id="7-6"></td>
                <td class="cellule-ronde" id="8-6"></td>
                <td class="cellule-ronde" id="9-6"></td>
            </tr>
            <tr>
                <td class="cellule-ronde" id="0-7"></td>
                <td class="cellule-ronde" id="1-7"></td>
                <td class="cellule-ronde" id="2-7"></td>
                <td class="cellule-ronde" id="3-7"></td>
                <td class="cellule-ronde" id="4-7"></td>
                <td class="cellule-ronde" id="5-7"></td>
                <td class="cellule-ronde" id="6-7"></td>
                <td class="cellule-ronde" id="7-7"></td>
                <td class="cellule-ronde" id="8-7"></td>
                <td class="cellule-ronde" id="9-7"></td>
            </tr>
            <tr>
                <td class="cellule-ronde" id="0-8"></td>
                <td class="cellule-ronde" id="1-8"></td>
                <td class="cellule-ronde" id="2-8"></td>
                <td class="cellule-ronde" id="3-8"></td>
                <td class="cellule-ronde" id="4-8"></td>
                <td class="cellule-ronde" id="5-8"></td>
                <td class="cellule-ronde" id="6-8"></td>
                <td class="cellule-ronde" id="7-8"></td>
                <td class="cellule-ronde" id="8-8"></td>
                <td class="cellule-ronde" id="9-8"></td>
            </tr>
            <tr>
                <td class="cellule-ronde" id="0-9"></td>
                <td class="cellule-ronde" id="1-9"></td>
                <td class="cellule-ronde" id="2-9"></td>
                <td class="cellule-ronde" id="3-9"></td>
                <td class="cellule-ronde" id="4-9"></td>
                <td class="cellule-ronde" id="5-9"></td>
                <td class="cellule-ronde" id="6-9"></td>
                <td class="cellule-ronde" id="7-9"></td>
                <td class="cellule-ronde" id="8-9"></td>
                <td class="cellule-ronde" id="9-9"></td>
            </tr>
        </tbody>
        </table>
        <button onclick="clear();" id="clear">Clear Grille</button>
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
                            document.getElementById("grille").addEventListener("click", function(event) {
                                event.preventDefault();
                            });
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