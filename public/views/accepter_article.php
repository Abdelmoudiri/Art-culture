<?php
require_once "../../classes/Article.php";

if (isset($_POST['idArticle'])) {
    $idArticle = (int)$_POST['idArticle'];

    try {
        // Appeler la méthode accept() de la classe Article pour accepter l'article
        Article::accepter($idArticle);
        echo "L'article a été accepté avec succès.";
    } catch (Exception $e) {
        echo 'Erreur : ' . $e->getMessage(); // Afficher l'erreur
    }
} else {
    echo 'Aucun ID d\'article fourni.';
}
?>
