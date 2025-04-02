<?php
global $db;
require 'database.php';

if (isset($_POST["valider"]) && !empty($_POST["nom_filiere"]) && !empty($_POST["description_filiere"])) {
    $nom = htmlspecialchars($_POST["nom_filiere"]);
    $description = htmlspecialchars($_POST["description_filiere"]);

    $check = $db->prepare("SELECT * FROM filieres WHERE nom_filiere = ?");
    $check->execute([$nom]);

    if ($check->rowCount() == 0) {
        $insert = $db->prepare("INSERT INTO filieres(nom_filiere, description_filiere) VALUES (?, ?)");
        if ($insert->execute([$nom, $description])) {
            echo "Filière ajoutée avec succès.";
        } else {
            echo "Erreur lors de l'ajout.";
        }
    } else {
        echo "Cette filière existe déjà.";
    }
}
?>

<form method="POST">
    <input type="text" name="nom_filiere" placeholder="Nom de la filière">
    <input type="text" name="description_filiere" placeholder="Description">
    <button type="submit" name="valider">Ajouter</button>
</form>