<?php
header("Content-Type: application/json");
$db = new SQLite3('game_database.sqlite');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents("php://input"), true);
    if (!$data) {
        echo json_encode([
            "error" => 1,
            "error_message" => "Aucune donnée JSON reçue."
        ], JSON_PRETTY_PRINT);
        exit;
    }
    if (!isset($data['game_id']) || !isset($data['game_path'])) {
        echo json_encode([
            "error" => 1,
            "error_message" => "Paramètres manquants : game_id ou game_path."
        ], JSON_PRETTY_PRINT);
        exit;
    }
    $game_id = $data['game_id'];
    $game_path = $data['game_path'];

    $stmt = $db->prepare("DELETE FROM games WHERE id = :game_id AND game_path = :game_path");
    $stmt->bindValue(':game_id', $game_id, SQLITE3_INTEGER);
    $stmt->bindValue(':game_path', $game_path, SQLITE3_TEXT);

    $result = $stmt->execute();
    if ($db->changes() > 0) {
        echo json_encode([
            "error" => 0,
            "error_message" => ""
        ], JSON_PRETTY_PRINT);
    } else {
        echo json_encode([
            "error" => 1,
            "error_message" => "Aucune partie trouvée avec les critères fournis."
        ], JSON_PRETTY_PRINT);
    }

    $db->close();
} else {
    echo json_encode([
        "error" => 1,
        "error_message" => "Méthode non autorisée. Utilisez POST."
    ], JSON_PRETTY_PRINT);
    exit;
}
?>
