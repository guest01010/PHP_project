<?php
global $db;
require 'database.php';

if (isset($_GET['id'])) {
    $delete = $db->prepare("DELETE FROM etudiants WHERE id = ?");
    $delete->execute([$_GET['id']]);
}

header("Location: liste_etudiant.php");
?>