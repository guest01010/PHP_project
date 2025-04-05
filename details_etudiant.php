<?php
global $db;
require 'database.php';

$id = $_GET['id'];
$etudiant = $db->prepare("SELECT * FROM etudiants WHERE id = ?");
$etudiant->execute([$id]);
$etudiant = $etudiant->fetch();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Détails de l'étudiant</title>
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
                        <a class="nav-link" href="liste_etudiant.php">Liste des Étudiants</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container">
        <div class="row">
            <div class="col-md-8 mx-auto">
                <div class="card shadow">
                    <div class="card-header bg-info text-white d-flex justify-content-between align-items-center">
                        <h2 class="mb-0"><i class="bi bi-person-circle me-2"></i>Détails de l'étudiant</h2>
                        <a href="liste_etudiant.php" class="btn btn-light">
                            <i class="bi bi-arrow-left me-2"></i>Retour à la liste
                        </a>
                    </div>
                    <div class="card-body">
                        <div class="row mb-4">
                            <div class="col-md-4">
                                <div class="text-center mb-3">
                                    <?php if (!empty($etudiant['photo'])): ?>
                                        <img src="<?= $etudiant['photo']; ?>" alt="Photo de profil" class="img-fluid rounded-circle" style="width: 150px; height: 150px; object-fit: cover;">
                                    <?php else: ?>
                                        <div class="bg-light d-flex align-items-center justify-content-center rounded-circle" style="width: 150px; height: 150px; margin: 0 auto;">
                                            <i class="bi bi-person text-secondary" style="font-size: 80px;"></i>
                                        </div>
                                    <?php endif; ?>
                                </div>
                                <form action="Traitement_d'image.php" method="POST" enctype="multipart/form-data" class="text-center">
                                    <input type="hidden" name="id" value="<?= $id; ?>">
                                    <div class="mb-3">
                                        <input type="file" name="photo" class="form-control form-control-sm" id="photoUpload">
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-sm">
                                        <i class="bi bi-upload me-1"></i>Télécharger
                                    </button>
                                </form>
                            </div>
                            <div class="col-md-8">
                                <table class="table table-striped">
                                    <tr>
                                        <th class="bg-light">Nom</th>
                                        <td><?= $etudiant['nom']; ?></td>
                                    </tr>
                                    <tr>
                                        <th class="bg-light">Prénoms</th>
                                        <td><?= $etudiant['prenoms']; ?></td>
                                    </tr>
                                    <tr>
                                        <th class="bg-light">Email</th>
                                        <td><?= $etudiant['email']; ?></td>
                                    </tr>
                                    <tr>
                                        <th class="bg-light">Genre</th>
                                        <td>
                                            <?php if ($etudiant['sexe'] == 'M'): ?>
                                                <span class="badge bg-primary">Masculin</span>
                                            <?php else: ?>
                                                <span class="badge bg-danger">Féminin</span>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="bg-light">Quartier</th>
                                        <td><?= $etudiant['quartier']; ?></td>
                                    </tr>
                                    <tr>
                                        <th class="bg-light">Contact</th>
                                        <td><?= $etudiant['contact']; ?></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        
                        <div class="d-flex justify-content-between">
                            <a href="modifier_etudiant.php?id=<?= $etudiant['id']; ?>" class="btn btn-warning">
                                <i class="bi bi-pencil-square me-2"></i>Modifier
                            </a>
                            <a href="supprimer_etudiant.php?id=<?= $etudiant['id']; ?>" class="btn btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet étudiant?')">
                                <i class="bi bi-trash me-2"></i>Supprimer
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>


