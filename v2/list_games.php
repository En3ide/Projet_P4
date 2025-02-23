<?php
header("Content-Type: application/json");

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

echo json_encode($response, JSON_PRETTY_PRINT);
?>
