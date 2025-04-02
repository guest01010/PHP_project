<?php
global $db;
require 'database.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = htmlspecialchars($_POST["nom"]);
    $prenoms = htmlspecialchars($_POST["prenoms"]);
    $sexe = $_POST["sexe"];
    $email = htmlspecialchars($_POST["email"]);
    $password = md5($_POST["password"]);
    $contact = htmlspecialchars($_POST["contact"]);
    $quartier = htmlspecialchars($_POST["quartier"]);
    $presentation = htmlspecialchars($_POST["presentation"]);
    $filiere = htmlspecialchars($_POST["filiere"]);

    $check = $db->prepare("SELECT * FROM etudiants WHERE email = ?");
    $check->execute([$email]);

    if ($check->rowCount() == 0) {
        $insert = $db->prepare("INSERT INTO etudiants (nom, prenoms, sexe, email, password, contact, quartier, presentation, filiere) 
                               VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
        if ($insert->execute([$nom, $prenoms, $sexe, $email, $password, $contact, $quartier, $presentation, $filiere])) {
            echo "Étudiant ajouté avec succès.";
        } else {
            echo "Erreur lors de l'ajout.";
        }
    } else {
        echo "Cet email est déjà utilisé.";
    }
}
?>

<form method="POST">
    <input type="text" name="nom" placeholder="Nom">
    <input type="text" name="prenoms" placeholder="Prénoms">
    <select name="sexe">
        <option value="M">Masculin</option>
        <option value="F">Féminin</option>
    </select>
    <input type="email" name="email" placeholder="Email">
    <input type="password" name="password" placeholder="Mot de passe">
    <input type="text" name="contact" placeholder="Contact">
    <input type="text" name="quartier" placeholder="Quartier">
    <textarea name="presentation" placeholder="Présentation"></textarea>
    <input type="number" name="filiere" placeholder="ID Filière">
    <button type="submit">Ajouter</button>
</form>