<?php
require_once __DIR__ . "/../../Categorie.php"; // Inclusion de la classe Categorie

// Vérifier si un ID a été fourni
if (isset($_POST['id_categorie']) && !empty($_POST['id_categorie'])) {
    $id_categorie = intval($_POST['id_categorie']); // Assurez-vous que l'ID est un entier

    // Initialiser l'instance de la classe Categorie
    $categorie = new Categorie();

    try {
        // Supprimer la catégorie
        if ($categorie->deleteCategory($id_categorie)) {
            // Réponse en cas de succès
            echo json_encode([
                "success" => true,
                "message" => "La catégorie a été supprimée avec succès.",
            ]);
        } else {
            // Réponse en cas d'échec
            echo json_encode([
                "success" => false,
                "message" => "Échec de la suppression de la catégorie.",
            ]);
        }
    } catch (Exception $e) {
        // Gestion des exceptions
        echo json_encode([
            "success" => false,
            "message" => "Une erreur est survenue : " . $e->getMessage(),
        ]);
    }
} else {
    // Réponse si aucun ID n'a été fourni
    echo json_encode([
        "success" => false,
        "message" => "ID de catégorie non fourni.",
    ]);
}
?>
