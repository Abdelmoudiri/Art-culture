<?php
require_once __DIR__ . "/../../classes/Categorie.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = $_POST['category-name'];
    $description = $_POST['category-description'];

    $categorie = new Categorie(); 

    // Add the category
    if ($categorie->addCategory($nom, $description)) {
        echo "Catégorie ajoutée avec succès.";
        // Redirect or provide feedback
    } else {
        echo "Erreur lors de l'ajout de la catégorie.";
    }
}
?>
