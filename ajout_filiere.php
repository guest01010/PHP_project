
<form method="POST">
    <input type="text" name="nom_filiere" placeholder="Nom de la filière" required>
    <input type="text" name="description_filiere" placeholder="Description">
    <button type="submit" name="valider">Ajouter</button>
    <?php
    include 'database.php';
    global$db;
    if (isset($_POST["valider"]) && !empty($_POST["nom_filiere"])) {
        $nom_filiere = $_POST["nom_filiere"];
        $desc_filiere = $_POST["description_filiere"];
        
        $check = $db->prepare("SELECT * FROM filieres WHERE nom_filiere = ?");
        $check->execute([$nom_filiere]);
        if ($check->rowCount() > 0) {
            echo "Cette filière existe déjà.";
        } else {
            $query = $db->prepare("INSERT INTO filieres (nom_filiere, description_filiere) VALUES (?, ?)");
            if ($query->execute([$nom_filiere, $desc_filiere])) {
                echo "Filière ajoutée avec succès.";
            } else {
                echo "Erreur d'insertion.";
            }
        }
    }
    ?>

</form>
