<?php

$db = new SQLite3('game_database.sqlite');

$query = "CREATE TABLE IF NOT EXISTS games (
    game_id INTEGER PRIMARY KEY AUTOINCREMENT,
    game_name TEXT NOT NULL,
    game_path TEXT NOT NULL,
    status TEXT CHECK(status IN ('play', 'pause', 'end')) NOT NULL,
    board TEXT NOT NULL, -- on stocke la grille en JSON vue que de toute façon on la renvoie completement à chaque fois
    player1 TEXT NOT NULL,
    player1_role TEXT CHECK(player1_role IN ('human', 'AI')) NOT NULL,
    player1_path TEXT NOT NULL,
    player2 TEXT,
    player2_role TEXT CHECK(player2_role IN ('human', 'AI')),
    player2_path TEXT,
    player_turn INTEGER 1,
    last_move INTEGER,
    private_key TEXT NOT NULL
);";

$db->exec($query);

echo json_encode(["error" => 0,
                "error_message" =>"",
                "status" => "success"]
                , JSON_PRETTY_PRINT);

?>
