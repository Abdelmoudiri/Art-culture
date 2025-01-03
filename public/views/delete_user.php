<?php
// Assurez-vous d'inclure la connexion à la base de données et la classe Admin

require_once __DIR__ . '/Admin.php';  // Inclure la classe Admin si nécessaire

if (isset($_POST['user_id'])) {
    $userId = $_POST['user_id'];

    // Créer une instance de la classe Admin pour gérer la suppression
    $admin = new Admin("admin", "admin", "admin", "admin", "admin");

    // Appeler la méthode pour supprimer l'utilisateur
    $isDeleted = $admin->deleteUtilisateur($userId);

    if ($isDeleted) {
        echo "Utilisateur supprimé avec succès.";
    } else {
        echo "Erreur lors de la suppression de l'utilisateur.";
    }
} else {
    echo "Aucun utilisateur spécifié.";
}
?>
