<?php
global $db;
require 'database.php';

$id = $_GET['id'];
$etudiant = $db->prepare("SELECT * FROM etudiants WHERE id = ?");
$etudiant->execute([$id]);
$etudiant = $etudiant->fetch();
?>

<table border="1">
    <tr>
        <th>Nom</th>
        <td><?= $etudiant['nom']; ?></td>
    </tr>
    <tr>
        <th>Prénoms</th>
        <td><?= $etudiant['prenoms']; ?></td>
    </tr>
    <tr>
        <th>Email</th>
        <td><?= $etudiant['email']; ?></td>
    </tr>
    <tr>
        <th>Genre</th>
        <td><?= $etudiant['sexe']; ?></td>
    </tr>
    <tr>
        <th>Quartier</th>
        <td><?= $etudiant['quartier']; ?></td>
    </tr>
    <tr>
        <th>Contact</th>
        <td><?= $etudiant['contact']; ?></td>
    </tr>
    <tr>
        <th><?= $etudiant['photo']; ?></th>
        <td><form action="Traitement_d’image.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?= $id; ?>">
            <input type="file" name="photo">
            <button type="submit">Uploader</button>
            </form></td>
    </tr>
</table>


