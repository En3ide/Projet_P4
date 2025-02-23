<?php
function make_bdd($id_) {
    $db = new SQLite3($id_.'.sqlite');

    $query = "CREATE TABLE IF NOT EXISTS grid_cells (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        x INTEGER NOT NULL,
        y INTEGER NOT NULL,
        value INTEGER NOT NULL
    )";
    $db->exec($query);
    echo "Table créée avec succès !\nIdentifiant : ".$id_;
}
?>
