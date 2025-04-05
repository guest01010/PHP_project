<?php
global $db;
require 'database.php';

// Variable pour récupérer les filières

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = htmlspecialchars($_POST["nom"]);
    $prenoms = htmlspecialchars($_POST["prenoms"]);
    $sexe = $_POST["sexe"];
    $email = htmlspecialchars($_POST["email"]);
    $password = md5($_POST["password"]);
    $contact = htmlspecialchars($_POST["contact"]);
    $quartier = htmlspecialchars($_POST["quartier"]);
    $presentation = htmlspecialchars($_POST["presentation"]);

    $check = $db->prepare("SELECT * FROM etudiants WHERE email = ?");
    $check->execute([$email]);

    if ($check->rowCount() == 0) {
        $insert = $db->prepare("INSERT INTO etudiants (nom, prenoms, sexe, email, password, contact, quartier, presentation) 
                               VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        if ($insert->execute([$nom, $prenoms, $sexe, $email, $password, $contact, $quartier, $presentation])) {
            $success = "Étudiant ajouté avec succès.";
        } else {
            $error = "Erreur lors de l'ajout.";
        }
    } else {
        $error = "Cet email est déjà utilisé.";
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Ajouter un Étudiant</title>
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
                        <a class="nav-link active" href="ajout_etudiant.php">Ajouter un Étudiant</a>
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
            <div class="col-lg-8 mx-auto">
                <div class="card shadow">
                    <div class="card-header bg-light">
                        <h2 class="mb-0"><i class="bi bi-person-plus me-2"></i>Ajouter un Étudiant</h2>
                    </div>
                    <div class="card-body">
                        <?php if (isset($success)): ?>
                            <div class="alert alert-success"><?= $success ?></div>
                        <?php endif; ?>
                        
                        <?php if (isset($error)): ?>
                            <div class="alert alert-danger"><?= $error ?></div>
                        <?php endif; ?>

                        <form method="POST">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="nom" class="form-label">Nom</label>
                                    <input type="text" class="form-control" id="nom" name="nom" placeholder="Nom" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="prenoms" class="form-label">Prénoms</label>
                                    <input type="text" class="form-control" id="prenoms" name="prenoms" placeholder="Prénoms" required>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="sexe" class="form-label">Genre</label>
                                    <select class="form-select" id="sexe" name="sexe" required>
                                        <option value="" selected disabled>Choisir le genre</option>
                                        <option value="M">Masculin</option>
                                        <option value="F">Féminin</option>
                                    </select>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="email" name="email" placeholder="Email" required>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="password" class="form-label">Mot de passe</label>
                                    <input type="password" class="form-control" id="password" name="password" placeholder="Mot de passe" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="contact" class="form-label">Contact</label>
                                    <input type="text" class="form-control" id="contact" name="contact" placeholder="Contact" required>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="quartier" class="form-label">Quartier</label>
                                    <input type="text" class="form-control" id="quartier" name="quartier" placeholder="Quartier" required>
                                </div>
                            </div>
                            
                            <div class="mb-3">
                                <label for="presentation" class="form-label">Présentation</label>
                                <textarea class="form-control" id="presentation" name="presentation" rows="3" placeholder="Présentation"></textarea>
                            </div>
                            
                            <button type="submit" class="btn btn-success">
                                <i class="bi bi-person-plus-fill me-2"></i>Ajouter
                            </button>
                            <a href="index.html" class="btn btn-secondary">
                                <i class="bi bi-arrow-left me-2"></i>Retour
                            </a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>