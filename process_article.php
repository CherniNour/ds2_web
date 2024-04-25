<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
require_once('newpost.php');
// Récupérer les données du formulaire
$donnees_article = array(
    'title' => $_POST['articleTitle'],
    'desc' => $_POST['articleDesc'],
    'contenu' => $_POST['articleContent'],
    'image' => $_POST['articleImage'] // À adapter si vous utilisez un champ de fichier
);

// Créer un nouvel objet Article avec les données du formulaire
$nouvel_article = new Article($donnees_article);

// Connexion à la base de données
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bd_ds2_binome";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // Configuration pour afficher les erreurs PDO
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Créer un objet NouvArticle avec la connexion à la base de données
    $nouv_article = new NouvArticle($conn);

    // Appeler la méthode pour ajouter l'article dans la base de données
    $nouv_article->ajouterArticle($nouvel_article);
    exit();
} catch(PDOException $e) {
    echo "Erreur: " . $e->getMessage();
}
// Fermeture de la connexion à la base de données
$conn = null;
}
?>