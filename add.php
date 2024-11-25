<?php
include 'connexion.php';
include 'header.php';


if ($_SERVER["REQUEST_METHOD"] == "POST")
/* vérifier si la requête HTTP qui a été envoyée au serveur utilise la méthode POST. */ 
{
    /* definit les valeurs des parametres */
    $titre = $_POST['titre'];/* titre est la clé du tableau associatif $_post */
    $contenu = $_POST['contenu'];/* attribut html */
    $date_creation = date('Y-m-d H:i:s');
    $auteur = $_POST['auteur'];

    $stmt = $conn->prepare("INSERT INTO/* ajoute une nouvelle ligne */ articles (titre, contenu, date_creation, auteur) VALUES (?, ?, ?, ?)");
    /* prepare()methode de l'objet $conn qui prepare la requete , elle prend une chane de caractere qui prend la requete sql*/
    $stmt->bind_param("ssss", $titre, $contenu, $date_creation, $auteur);
/* associe une variable à un parametre */
    if ($stmt->execute()) {
        echo "<div class='alert alert-success'>Nouvel article ajouté avec succès.</div>";
    } else {
        echo "<div class='alert alert-danger'>Erreur: " . $stmt->error . "</div>";
    }

    $stmt->close();
}

?>

<div class="container mt-5">
    <h2>Ajouter un nouvel article</h2>
    <form action="add.php" method="post">
        <div class="form-group">
            <label for="titre">Titre :</label>
            <input type="text" id="titre" name="titre" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="contenu">Contenu :</label>
            <textarea id="contenu" name="contenu" class="form-control" required></textarea>
        </div>
        <div class="form-group">
            <label for="auteur">Auteur :</label>
            <input type="text" id="auteur" name="auteur" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Publier</button>
    </form>
</div>

<?php
include 'footer.php';
$conn->close();
?>
