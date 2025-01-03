<?php
require_once __DIR__ . "/../../classes/Categorie.php";

session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérer les données de formulaire
    $categoryId = intval($_POST['edit-category-id']);
    $categoryName = htmlspecialchars($_POST['edit-category-name']);
    $categoryDescription = htmlspecialchars($_POST['edit-category-description']);

    // Vérification des champs requis
    if (empty($categoryName) || empty($categoryDescription)) {
        echo json_encode([
            "success" => false,
            "message" => "Les champs 'nom' et 'description' ne peuvent pas être vides.",
        ]);
        exit();
    }

    try {
        $categorie = new Categorie();

        // Mise à jour de la catégorie
        if ($categorie->updateCategory($categoryId, $categoryName, $categoryDescription)) {
            // Récupérer l'ID de l'utilisateur depuis la session
            $userId = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;

            // Si l'ID de l'utilisateur est valide, rediriger vers le tableau de bord de l'admin
            if ($userId) {
                $redirectUrl = "AdminDash.php?id=" . urlencode($userId);
                header("Location: $redirectUrl");
                exit();
            } else {
                // Si l'ID utilisateur n'est pas trouvé dans la session, afficher une erreur
                echo json_encode([
                    "success" => false,
                    "message" => "Utilisateur non connecté. Impossible de rediriger.",
                ]);
                exit();
            }
        } else {
            // Si la mise à jour échoue
            echo json_encode([
                "success" => false,
                "message" => "Échec de la mise à jour de la catégorie. Veuillez réessayer.",
            ]);
            exit();
        }
    } catch (Exception $e) {
        // Gérer les exceptions
        echo json_encode([
            "success" => false,
            "message" => "Une erreur s'est produite : " . $e->getMessage(),
        ]);
        exit();
    }
}
?>
