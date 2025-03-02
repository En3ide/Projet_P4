<?php
////// créer une nouvelle partie //////
header("Content-Type: application/json"); // Réponse en JSON

$db = new SQLite3('game_database.sqlite');

if($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents("php://input"), true);

    if (!$data) {
        echo json_encode(["error" => 1,
        "error_message" => "Pas d'entré json données."]);
        exit;
    }

    $required_fields = ["game_name", "game_path", "player1", "player1_role", "player1_path", "player2", "player2_role", "player2_path"];
    $error = ["error" => 0,
              "error_message" => ""];
    foreach ($required_fields as $field) {
        if (!isset($data[$field])) {
            $error["error"]++;
            $error["error_message"] .= "Information non fourni : $field\n";
        }
    }
    if($error["error"] >= 1) {
        echo json_encode($error);
        exit;
    }
    $board = array_fill(0, 6, array_fill(0, 6, 0));
    $private_key = bin2hex(random_bytes(32));

    $db->exec('BEGIN TRANSACTION');
    try {
    $stmt = $db->prepare("INSERT INTO games (game_name, game_path, status, board, player1, player1_role, player1_path, player2, player2_role, player2_path, player_turn, last_move, private_key) 
                          VALUES (:game_name, :game_path, :status, :board, :player1, :player1_role, :player1_path, :player2, :player2_role, :player2_path, :player_turn, :last_move, :private_key)");
    //valeur constante donc on utilise bindValue non ????
    $stmt->bindValue(':game_name', $data['game_name'], SQLITE3_TEXT);
    $stmt->bindValue(':game_path', $data['game_path'], SQLITE3_TEXT);
    $stmt->bindValue(':status', $data['status'], SQLITE3_TEXT);
    $stmt->bindValue(':board', json_encode($board), SQLITE3_TEXT);
    $stmt->bindValue(':player1', $data['player1'], SQLITE3_TEXT);
    $stmt->bindValue(':player1_role', $data['player1_role'], SQLITE3_TEXT);
    $stmt->bindValue(':player1_path', $data['player1_path'], SQLITE3_TEXT);
    $stmt->bindValue(':player2', isset($data['player2']) ? $data['player2']: "", SQLITE3_TEXT);
    $stmt->bindValue(':player2_role', isset($data['player2_role']) ? $data['player2_role'] : "", SQLITE3_TEXT);
    $stmt->bindValue(':player2_path', isset($data['player2_path']) ? $data['player2_path'] : "", SQLITE3_TEXT);
    $stmt->bindValue(':player_turn', 1, SQLITE3_INTEGER);
    $stmt->bindValue(':last_move', "", SQLITE3_INTEGER);
    $stmt->bindValue(':private_key', $private_key, SQLITE3_TEXT);

    $stmt->execute();
    $objdb->exec('COMMIT');
    echo json_encode(["error" => 0,
                    "error_message" => "",
                    "game_id" => $db->lastInsertRowID(),
                    "game_name" => $data['game_name'],
                    "game_path" => $data['game_path'],
                    "status" => $data['status'],
                    "board" => $board,
                    "player1" => $data['player1'],
                    "player1_role" => $data['player1_role'],
                    "player1_path" => $data['player1_path'],
                    "player2" => isset($data['player2']) ? $data['player2']: "",
                    "player2_role" => isset($data['player2_role']) ? $data['player2_role'] : "",
                    "player2_path" => isset($data['player2_path']) ? $data['player2_path'] : "",
                    "player_turn" => 1,
                    "last_move" => "",
                    "private_key" => $private_key]);
    } catch (Exception $e) {
        $db->exec('ROLLBACK');
        echo json_encode(["error" => 1,
                        "error_message" => "Erreur lors de la création de la partie"]);
    }
    exit;

}else {
    echo json_encode(["error" => 1,
                    "error_message" => "Méthode non autorisé"]);
    exit;
}
?>