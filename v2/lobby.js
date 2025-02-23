$adresse = document.getElementById("adresse_server");
$list_party = document.getElementById("list_party");

window.onload = setInterval(() => {
    if ($adresse.value.trim() !== "") {
        getparty($adresse.value.trim());
    } else {
        let currentUrl = window.location.href;
        let baseUrl = currentUrl.replace(/\/[^\/]*$/, ''); //retirer la dernière partie de l'URL
        console.log(baseUrl);
        getparty(baseUrl);
    }
}, 1000);

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
            fill_list_party(response);
        })
        .catch(error => console.log("Erreur : " + error));
}

function fill_list_party(response) {
    $list_party.innerHTML = "";
    response["games"].forEach(game => {
        $list_party.innerHTML +=
            '<form class="party" method="POST" action="./Interface.php"><input type="submit" class="party_join" name="party_join" value="Rejoindre" ' +
            (game["status"] === "over" ? 'disabled' : '') +
            '"/><hr/><input class="party_status" value="' + game["status"] + '" disabled/><input class="party_id" name="party_id" value="' +
            game["game_id"] +
            '" disabled/></form>';
    });
}