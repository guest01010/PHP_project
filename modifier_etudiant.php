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
    $email = htmlspecialchars($_POST["email"]);
    $quartier = htmlspecialchars($_POST["quartier"]);
    $contact = htmlspecialchars($_POST["contact"]);
    $sexe = $_POST["sexe"];

    $update = $db->prepare("UPDATE etudiants SET nom = ?, prenoms = ?, email = ?, quartier = ?, contact = ?, sexe = ? WHERE id = ?");
    $update->execute([$nom, $prenoms, $email, $quartier, $contact, $sexe, $id]);
    
    $success = "Étudiant modifié avec succès.";
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Modifier un Étudiant</title>
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
                    <div class="card-header bg-warning text-dark d-flex justify-content-between align-items-center">
                        <h2 class="mb-0"><i class="bi bi-pencil-square me-2"></i>Modifier l'étudiant</h2>
                        <a href="liste_etudiant.php" class="btn btn-outline-dark">
                            <i class="bi bi-arrow-left me-2"></i>Retour à la liste
                        </a>
                    </div>
                    <div class="card-body">
                        <?php if (isset($success)): ?>
                            <div class="alert alert-success">
                                <i class="bi bi-check-circle me-2"></i><?= $success ?>
                                <div class="mt-2">
                                    <a href="details_etudiant.php?id=<?= $id ?>" class="btn btn-sm btn-info">Voir les détails</a>
                                    <a href="liste_etudiant.php" class="btn btn-sm btn-secondary">Retour à la liste</a>
                                </div>
                            </div>
                        <?php endif; ?>
                        
                        <form method="POST">
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="nom" class="form-label">Nom</label>
                                    <input type="text" class="form-control" id="nom" name="nom" value="<?= $etudiant['nom']; ?>" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="prenoms" class="form-label">Prénoms</label>
                                    <input type="text" class="form-control" id="prenoms" name="prenoms" value="<?= $etudiant['prenoms']; ?>" required>
                                </div>
                            </div>
                            
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="email" name="email" value="<?= $etudiant['email']; ?>" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="sexe" class="form-label">Genre</label>
                                    <select class="form-select" id="sexe" name="sexe" required>
                                        <option value="M" <?= $etudiant['sexe'] == 'M' ? 'selected' : '' ?>>Masculin</option>
                                        <option value="F" <?= $etudiant['sexe'] == 'F' ? 'selected' : '' ?>>Féminin</option>
                                    </select>
                                </div>
                            </div>
                            
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="quartier" class="form-label">Quartier</label>
                                    <input type="text" class="form-control" id="quartier" name="quartier" value="<?= $etudiant['quartier']; ?>">
                                </div>
                                <div class="col-md-6">
                                    <label for="contact" class="form-label">Contact</label>
                                    <input type="text" class="form-control" id="contact" name="contact" value="<?= $etudiant['contact']; ?>">
                                </div>
                            </div>
                            
                            <div class="d-flex justify-content-between mt-4">
                                <button type="submit" class="btn btn-warning">
                                    <i class="bi bi-save me-2"></i>Enregistrer les modifications
                                </button>
                                <a href="details_etudiant.php?id=<?= $etudiant['id']; ?>" class="btn btn-info">
                                    <i class="bi bi-eye me-2"></i>Voir les détails
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>