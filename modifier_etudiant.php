<?php
global $db;
require 'database.php';

if (!isset($_GET['id'])) {
    header("Location: liste_etudiant.php");
    exit();
}

$id = $_GET['id'];
$etudiant = $db->prepare("SELECT * FROM etudiants WHERE id = ?");
$etudiant->execute([$id]);
$etudiant = $etudiant->fetch();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = htmlspecialchars($_POST["nom"]);
    $prenoms = htmlspecialchars($_POST["prenoms"]);

    $update = $db->prepare("UPDATE etudiants SET nom = ?, prenoms = ? WHERE id = ?");
    $update->execute([$nom, $prenoms, $id]);

    header("Location: liste_etudiant.php");
}
?>

<form method="POST">
    <input type="text" name="nom" value="<?= $etudiant['nom']; ?>">
    <input type="text" name="prenoms" value="<?= $etudiant['prenoms']; ?>">
    <button type="submit">Modifier</button>
</form>