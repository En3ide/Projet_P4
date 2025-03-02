<?php
$db = new SQLite3('game_database.sqlite');

$query = "SELECT * FROM games";
$results = $db->query($query);

if ($results->numColumns() == 0) {
    echo "Aucun jeu trouvé.";
    exit;
}

echo "<table border='1'>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nom du Jeu</th>
                <th>Chemin du Jeu</th>
                <th>Statut</th>
                <th>Joueur 1</th>
                <th>Rôle Joueur 1</th>
                <th>Joueur 2</th>
                <th>Rôle Joueur 2</th>
                <th>Tour du Joueur</th>
            </tr>
        </thead>
        <tbody>";

while ($row = $results->fetchArray(SQLITE3_ASSOC)) {
    echo "<tr>
            <td>{$row['id']}</td>
            <td>{$row['game_name']}</td>
            <td>{$row['game_path']}</td>
            <td>{$row['status']}</td>
            <td>{$row['player1']}</td>
            <td>{$row['player1_role']}</td>
            <td>{$row['player2']}</td>
            <td>{$row['player2_role']}</td>
            <td>{$row['player_turn']}</td>
          </tr>";
}

echo "</tbody></table>";

$db->close();
?>
