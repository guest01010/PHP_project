<?php
global $db;
require 'database.php';

if ($_FILES['photo']['error'] == 0) {
    $id = $_POST['id'];
    $filename = "uploads/" . basename($_FILES['photo']['name']);
    move_uploaded_file($_FILES['photo']['tmp_name'], $filename);

    $update = $db->prepare("UPDATE etudiants SET photo = ? WHERE id = ?");
    $update->execute([$filename, $id]);
}

header("Location: details_etudiant.php?id=$id");
?>