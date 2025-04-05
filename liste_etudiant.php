<?php
global $db;
require 'database.php';

// Requête simple sans jointure car la colonne filiere n'existe pas
$etudiants = $db->query("SELECT * FROM etudiants")->fetchAll();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Liste des Étudiants</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary mb-4">
        <div class="container">
            <a class="navbar-brand" href="index.html">Gestion des Étudiants</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="index.html">Accueil</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="ajout_filiere.php">Ajouter une Filière</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="ajout_etudiant.php">Ajouter un Étudiant</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="liste_etudiant.php">Liste des Étudiants</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container">
        <div class="card shadow">
            <div class="card-header bg-light d-flex justify-content-between align-items-center">
                <h2 class="mb-0"><i class="bi bi-list-ul me-2"></i>Liste des Étudiants</h2>
                <a href="ajout_etudiant.php" class="btn btn-success">
                    <i class="bi bi-person-plus-fill me-2"></i>Ajouter un étudiant
                </a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead class="table-light">
                            <tr>
                                <th>Nom</th>
                                <th>Prénoms</th>
                                <th>Email</th>
                                <th>Genre</th>
                                <th>Quartier</th>
                                <th>Contact</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (count($etudiants) > 0): ?>
                                <?php foreach ($etudiants as $etudiant) : ?>
                                    <tr>
                                        <td><?= $etudiant['nom']; ?></td>
                                        <td><?= $etudiant['prenoms']; ?></td>
                                        <td><?= $etudiant['email']; ?></td>
                                        <td>
                                            <?php if ($etudiant['sexe'] == 'M'): ?>
                                                <span class="badge bg-primary">Masculin</span>
                                            <?php else: ?>
                                                <span class="badge bg-danger">Féminin</span>
                                            <?php endif; ?>
                                        </td>
                                        <td><?= $etudiant['quartier']; ?></td>
                                        <td><?= $etudiant['contact']; ?></td>
                                        <td>
                                            <div class="btn-group btn-group-sm">
                                                <a href="details_etudiant.php?id=<?= $etudiant['id']; ?>" class="btn btn-info">
                                                    <i class="bi bi-eye"></i>
                                                </a>
                                                <a href="modifier_etudiant.php?id=<?= $etudiant['id']; ?>" class="btn btn-warning">
                                                    <i class="bi bi-pencil"></i>
                                                </a>
                                                <a href="supprimer_etudiant.php?id=<?= $etudiant['id']; ?>" class="btn btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet étudiant?')">
                                                    <i class="bi bi-trash"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="7" class="text-center">Aucun étudiant trouvé</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>