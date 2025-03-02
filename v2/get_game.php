<?php
header("Content-Type: application/json");
$db = new SQLite3('game_database.sqlite');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents("php://input"), true);
    if (!$data) {
        echo json_encode(["error" => 1,
                        "error_message" => "Aucune donnée JSON reçue."]);
        exit;
    }
    if (!isset($data['game_id']) || !isset($data['game_path']) || !isset($data['player'])) {
        echo json_encode(["error" => 1,
                        "error_message" => "Paramètres manquants. Veuillez fournir 'game_id', 'game_path', et 'player'."]);
        exit;
    }

    $game_id = $data['game_id'];
    $game_path = $data['game_path'];
    $player = $data['player'];

    $db->exec('BEGIN TRANSACTION');
    try {
    $stmt = $db->prepare("SELECT * FROM games WHERE game_id = :game_id AND game_path = :game_path");
    $stmt->bindValue(':game_id', $game_id, SQLITE3_INTEGER);
    $stmt->bindValue(':game_path', $game_path, SQLITE3_TEXT);

    $result = $stmt->execute();
    $objdb->exec('COMMIT');
    $reponse = $result->fetchArray(SQLITE3_ASSOC);
    if (!$reponse) {
        echo json_encode(["error" => 1,
                        "error_message" => "Aucun jeu trouvé avec cet ID et chemin."]);
        exit;
    }

    echo json_encode([
        "error" => 0,
        "error_message" => "",
        "game_id" => $reponse["game_id"],
        "game_name" => $reponse["game_name"],
        "game_path" => $reponse["game_path"],
        "status" => $reponse["status"],
        "board" => json_decode($reponse["board"]),
        "player1" => $reponse["player1"],
        "player1_role" => $reponse["player1_role"],
        "player1_path" => $reponse["player1_path"],
        "player2" => $reponse["player2"],
        "player2_role" => $reponse["player2_role"],
        "player2_path" => $reponse["player2_path"],
        "player_turn" => $reponse["player_turn"],
        "last_move" => $reponse["last_move"],
        "private_key" => (($data["player"] === $reponse["player_turn"]) ? $reponse["private_key"]: "")
    ]);
    } catch(Exception $e) {
        $db->exec('ROLLBACK');
        echo json_encode(["error" => 1,
                        "error_message" => "Erreur lors de la requete vers la bdd !"]);
    }
    exit;

} else {
    echo json_encode(["error" => 1,
                    "error_message" => "Méthode non autorisée."]);
    exit;
}
?>
