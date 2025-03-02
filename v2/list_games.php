<?php
header("Content-Type: application/json");

$db = new SQLite3('game_database.sqlite');

if($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents("php://input"), true);

    if (!$data) {
        echo json_encode(["error" => 1,
            "error_message" => "Pas d'entré json données."],
            JSON_PRETTY_PRINT);
        exit;
    }

    $required_fields = ["status","path"];
    $error = ["error" => 0,
              "error_message" => ""];
    foreach ($required_fields as $field) {
        if (!isset($data[$field])) {
            $error["error"]++;
            $error["error_message"] .= "Information non fourni : $field\n";
        }
    }
    if($error["error"] >= 1) {
        echo json_encode($error,
            JSON_PRETTY_PRINT);
        exit;
    }
    try {
        $db->exec('BEGIN TRANSACTION');

        switch($data["status"]) {
            case "waiting":
                $stmt = $db->prepare("SELECT game_id, status, player1, player1_role, player1_path, player2, player2_role, player2_path, player_turn FROM games WHERE status = 'waiting'");
                break;
            case "play":
                $stmt = $db->prepare("SELECT game_id, status, player1, player1_role, player1_path, player2, player2_role, player2_path, player_turn FROM games WHERE status = 'play'");
                break;
            case "over":
                $stmt = $db->prepare("SELECT game_id, status, player1, player1_role, player1_path, player2, player2_role, player2_path, player_turn, winner FROM games WHERE status = 'over'");
                break;
            case "all":
                $stmt = $db->prepare("SELECT game_id, status, player1, player1_role, player1_path, player2, player2_role, player2_path, player_turn, winner FROM games");    
                break;
            case "test":
                $response = [
                    "games" => [
                        [
                            "game_id" => 124,
                            "status" => "waiting",
                            "player1" => "Jean",
                            "player1_role" => "human",
                            "player1_path" => "~jean_valjean/",
                            "player2" => "",
                            "player2_role" => "",
                            "player2_path" => "",
                            "player_turn" => 1
                        ],
                        [
                            "game_id" => 123,
                            "status" => "play",
                            "player1" => "Jean",
                            "player1_role" => "human",
                            "player1_path" => "~jean_valjean/",
                            "player2" => "Sam",
                            "player2_role" => "human",
                            "player2_path" => "~sam_gamegie/SAE/",
                            "player_turn" => 1
                        ],
                        [
                            "game_id" => 122,
                            "status" => "over",
                            "player1" => "Jean",
                            "player1_role" => "human",
                            "player1_path" => "~jean_valjean/",
                            "player2" => "Sam",
                            "player2_role" => "human",
                            "player2_path" => "~sam_gamegie/SAE/",
                            "winner" => 1
                        ],
                        [
                            "game_id" => 122,
                            "status" => "over",
                            "player1" => "Jean",
                            "player1_role" => "human",
                            "player1_path" => "~jean_valjean/",
                            "player2" => "Sam",
                            "player2_role" => "human",
                            "player2_path" => "~sam_gamegie/SAE/",
                            "winner" => 1
                        ],
                        [
                            "game_id" => 122,
                            "status" => "over",
                            "player1" => "Jean",
                            "player1_role" => "human",
                            "player1_path" => "~jean_valjean/",
                            "player2" => "Sam",
                            "player2_role" => "human",
                            "player2_path" => "~sam_gamegie/SAE/",
                            "winner" => 1
                        ],
                        [
                            "game_id" => 122,
                            "status" => "over",
                            "player1" => "Jean",
                            "player1_role" => "human",
                            "player1_path" => "~jean_valjean/",
                            "player2" => "Sam",
                            "player2_role" => "human",
                            "player2_path" => "~sam_gamegie/SAE/",
                            "winner" => 1
                        ],
                        [
                            "game_id" => 122,
                            "status" => "over",
                            "player1" => "Jean",
                            "player1_role" => "human",
                            "player1_path" => "~jean_valjean/",
                            "player2" => "Sam",
                            "player2_role" => "human",
                            "player2_path" => "~sam_gamegie/SAE/",
                            "winner" => 1
                        ],
                        [
                            "game_id" => 122,
                            "status" => "over",
                            "player1" => "Jean",
                            "player1_role" => "human",
                            "player1_path" => "~jean_valjean/",
                            "player2" => "Sam",
                            "player2_role" => "human",
                            "player2_path" => "~sam_gamegie/SAE/",
                            "winner" => 1
                        ],
                        [
                            "game_id" => 122,
                            "status" => "over",
                            "player1" => "Jean",
                            "player1_role" => "human",
                            "player1_path" => "~jean_valjean/",
                            "player2" => "Sam",
                            "player2_role" => "human",
                            "player2_path" => "~sam_gamegie/SAE/",
                            "winner" => 1
                        ]
                    ]
                ];
                echo json_encode($response,
                    JSON_PRETTY_PRINT);
                exit;
            default:
                echo json_encode(["error" => 1,
                    "error_message" => "Statut invalide."],
                    JSON_PRETTY_PRINT);
                exit;
        }
        
        if (!$stmt) {
            echo json_encode(["error" => 1,
                "error_message" => "Statut invalide."],
                JSON_PRETTY_PRINT);
            exit;
        }

        $result = $stmt->execute();
        if (!$result) {
            echo json_encode(["error" => 1,
                "error_message" => "Statut invalide."],
                JSON_PRETTY_PRINT);
            exit;
        }
        $db->exec('COMMIT');
        $games = [];
        while ($reponse = $result->fetchArray(SQLITE3_ASSOC)) {
            $game = [
                "game_id" => $reponse["game_id"],
                "status" => $reponse["status"],
                "player1" => $reponse["player1"],
                "player1_role" => $reponse["player1_role"],
                "player1_path" => $reponse["player1_path"],
                "player2" => $reponse["player2"],
                "player2_role" => $reponse["player2_role"],
                "player2_path" => $reponse["player2_path"],
                "player_turn" => $reponse["player_turn"]
            ];
            // on ajoute le gagnant si la partie est fini
            if ($reponse["status"] === "over" && isset($reponse["winner"])) {
                $game["winner"] = $reponse["winner"];
            }

            $games[] = $game;
        }

        echo json_encode(["games" => $games],
            JSON_PRETTY_PRINT);
    } catch (Exception $e) {
        echo json_encode(["error" => 1, 
            "error_message" => $e->getMessage()],
            JSON_PRETTY_PRINT);
    }
}else {
    echo json_encode(["error" => 1,
                    "error_message" => "Méthode non autorisé"],
                    JSON_PRETTY_PRINT);
    exit;
}
?>
