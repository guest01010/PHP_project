<?php
global $db;
require 'database.php';

// Récupérer les filières
$filieres = $db->query("SELECT * FROM filieres")->fetchAll();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Debug Filières</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="card">
            <div class="card-header">
                <h2>Contenu de la table Filières</h2>
            </div>
            <div class="card-body">
                <h3>Structure des données:</h3>
                <pre><?php print_r($filieres); ?></pre>
                
                <h3>Noms des filières:</h3>
                <ul class="list-group">
                    <?php foreach ($filieres as $fil): ?>
                        <li class="list-group-item">
                            <strong>ID:</strong> <?= $fil['id'] ?><br>
                            <strong>Nom filière brut:</strong> <?= $fil['nom_filiere'] ?><br>
                            <strong>Avec htmlspecialchars:</strong> <?= htmlspecialchars($fil['nom_filiere']) ?>
                        </li>
                    <?php endforeach; ?>
                </ul>
                
                <div class="mt-4">
                    <a href="ajout_etudiant.php" class="btn btn-primary">Retour au formulaire</a>
                </div>
            </div>
        </div>
    </div>
</body>
</html> 