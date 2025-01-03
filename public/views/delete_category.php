<?php
require_once __DIR__ . "/../../classes/Categorie.php";

header('Content-Type: application/json'); 

try {
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        throw new Exception("Méthode HTTP non prise en charge.");
    }
    if (empty($_POST['action']) || $_POST['action'] !== 'delete') {
        throw new Exception("Action invalide.");
    }
    $categoryId = intval($_POST['id']);

    if ($categoryId <= 0) {
        throw new Exception("ID de catégorie invalide.");
    }

    $categorie = new Categorie();
    if ($categorie->deleteCategory($categoryId)) {
        echo json_encode(["success" => true, "message" => "Catégorie supprimée avec succès."]);
    } else {
        throw new Exception("Erreur lors de la suppression de la catégorie.");
    }
} catch (Exception $e) {
    echo json_encode(["success" => false, "message" => $e->getMessage()]);
    http_response_code(400); 
}
?>
