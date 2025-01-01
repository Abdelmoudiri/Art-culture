<?php
require_once "../../classes/Article.php";

if (isset($_POST['idArticle'])) {
    $idArticle = (int)$_POST['idArticle'];

    try {
        // Appeler la méthode reject() de la classe Article pour refuser l'article
        Article::refuser($idArticle);
        echo "L'article a été refusé avec succès.";
    } catch (Exception $e) {
        echo 'Erreur : ' . $e->getMessage(); // Afficher l'erreur
    }
} else {
    echo 'Aucun ID d\'article fourni.';
}
?>
