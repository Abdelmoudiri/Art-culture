<?php
require_once "../../classes/Article.php";

if (isset($_POST['idArticle'])) {
    $idArticle = (int)$_POST['idArticle'];

    try {
        Article::accepter($idArticle);
        echo "L'article a été accepté avec succès.";
    } catch (Exception $e) {
        echo 'Erreur : ' . $e->getMessage();
    }
} else {
    echo 'Aucun ID d\'article fourni.';
}
?>
