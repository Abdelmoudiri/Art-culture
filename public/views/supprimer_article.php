<?php
require_once "../../classes/Article.php";

if (isset($_POST['idArticle'])) {
    $idArticle = (int)$_POST['idArticle'];

    try {
        // Appeler la méthode delete() de la classe Article pour supprimer l'article
        Article::delete($idArticle);
        echo "L'article a été supprimé avec succès.";
    } catch (Exception $e) {
        echo 'Erreur : ' . $e->getMessage(); // Afficher l'erreur
    }
} else {
    echo 'Aucun ID d\'article fourni.';
}
?>
