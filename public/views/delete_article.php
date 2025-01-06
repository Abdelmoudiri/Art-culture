<?php
include_once('../../classes/Article.php');
session_start();


// Vérifier si l'ID de l'article est envoyé et l'ID utilisateur est stocké dans la session
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['idArticle']) && isset($_SESSION['id_user'])) {
    // Valider l'ID de l'article pour s'assurer que c'est un entier
    $idArticle = $_POST['idArticle'];

    if ($idArticle === false) {
        echo 'Erreur : ID de l\'article invalide.';
        exit;
    }

    try {
        // Suppression de l'article
        Article::delete(intval($idArticle));

        // Réponse de succès pour AJAX
        echo 'success';
    } catch (Exception $e) {
        // Affichage d'une erreur en cas d'échec
        echo 'Erreur : ' . $e->getMessage();
    }
} else {
    // Si l'ID utilisateur n'est pas disponible ou la méthode POST est incorrecte, afficher un message d'erreur
    echo 'Erreur : L\'utilisateur n\'est pas authentifié ou la requête est invalide.';
}
?>
