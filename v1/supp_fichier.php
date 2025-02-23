<?php
$file = "grille.json";

if (file_exists($file)) {
    if (unlink($file)) {
        echo "Fichier supprimé avec succès.";
    } else {
        echo "Erreur : Impossible de supprimer le fichier.";
    }
} else {
    echo "Erreur : Fichier introuvable.";
}
?>
