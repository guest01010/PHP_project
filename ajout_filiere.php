<?php
global $db;
require 'database.php';

if (isset($_POST["valider"]) && !empty($_POST["nom_filiere"]) && !empty($_POST["description_filiere"])) {
    $nom = htmlspecialchars($_POST["nom_filiere"]);
    $description = htmlspecialchars($_POST["description_filiere"]);

    $check = $db->prepare("SELECT * FROM filieres WHERE nom_filiere = ?");
    $check->execute([$nom]);

    if ($check->rowCount() == 0) {
        $insert = $db->prepare("INSERT INTO filieres(nom_filiere, description_filiere) VALUES (?, ?)");
        if ($insert->execute([$nom, $description])) {
            $success = "Filière ajoutée avec succès.";
        } else {
            $error = "Erreur lors de l'ajout.";
        }
    } else {
        $error = "Cette filière existe déjà.";
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Ajouter une Filière</title>
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
                        <a class="nav-link active" href="ajout_filiere.php">Ajouter une Filière</a>
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
                    <div class="card-header bg-light">
                        <h2 class="mb-0"><i class="bi bi-folder-plus me-2"></i>Ajouter une Filière</h2>
                    </div>
                    <div class="card-body">
                        <?php if (isset($success)): ?>
                            <div class="alert alert-success"><?= $success ?></div>
                        <?php endif; ?>
                        
                        <?php if (isset($error)): ?>
                            <div class="alert alert-danger"><?= $error ?></div>
                        <?php endif; ?>

                        <form method="POST">
                            <div class="mb-3">
                                <label for="nom_filiere" class="form-label">Nom de la filière</label>
                                <input type="text" class="form-control" id="nom_filiere" name="nom_filiere" placeholder="Nom de la filière" required>
                            </div>
                            <div class="mb-3">
                                <label for="description_filiere" class="form-label">Description</label>
                                <textarea class="form-control" id="description_filiere" name="description_filiere" rows="3" placeholder="Description de la filière" required></textarea>
                            </div>
                            <button type="submit" name="valider" class="btn btn-primary">
                                <i class="bi bi-save me-2"></i>Ajouter
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