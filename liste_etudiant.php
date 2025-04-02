<?php
global $db;
require 'database.php';

$etudiants = $db->query("SELECT * FROM etudiants")->fetchAll();
?>

<a href="ajout_etudiant.php">Ajouter un étudiant</a>
<table border="1">
    <tr>
        <th>Nom</th>
        <th>Prénoms</th>
        <th>Email</th>
        <th>genre</th>
        <th>quartier</th>
        <th>contact</th>

        <th>Actions</th>
    </tr>
    <?php foreach ($etudiants as $etudiant) : ?>
        <tr>
            <td><?= $etudiant['nom']; ?></td>
            <td><?= $etudiant['prenoms']; ?></td>
            <td><?= $etudiant['email']; ?></td>
            <td><?= $etudiant['sexe']?></td>
            <td><?= $etudiant['quartier']?></td>
            <td><?= $etudiant['contact']?></td>
            <td>
                <a href="details_etudiant.php? id=<?= $etudiant['id']; ?>">Détails</a>
                <a href="modifier_etudiant.php? id=<?= $etudiant['id']; ?>">Modifier</a>
                <a href="supprimer_etudiant.php? id=<?= $etudiant['id']; ?>">Supprimer</a>
            </td>
        </tr>
    <?php endforeach; ?>
</table>