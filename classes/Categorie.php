<?php
require_once __DIR__ . "/database.php";
class Categorie {
    private $pdo;

    public function __construct() {
        $this->pdo = DatabaseConnection::getInstance()->getConnection();
    }

    public function addCategory($nom, $description) {
        $query = "INSERT INTO Categorie (nom, description) VALUES (:nom, :description)";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':nom', $nom);     
        $stmt->bindParam(':description', $description); 
        return $stmt->execute(); 
    }
    


public static function getAllCategories() {
    $pdo = DatabaseConnection::getInstance()->getConnection();
    $query = "SELECT * FROM Categorie";
    $stmt = $pdo->query($query);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

public static function getCategoryById($id) {
    $pdo = DatabaseConnection::getInstance()->getConnection();
    $query = "SELECT * FROM Categorie WHERE id_categorie = :id";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
}


public function updateCategory($id, $nom, $description) {
    try {
        if (empty($id) || empty($nom) || empty($description)) {
            throw new Exception("Les champs id, nom, et description ne peuvent pas être vides.");
        }
        $query = "UPDATE Categorie SET nom = :nom, description = :description WHERE id_categorie = :id";
        $stmt = $this->pdo->prepare($query);

        $stmt->bindParam(':nom', $nom, PDO::PARAM_STR);
        $stmt->bindParam(':description', $description, PDO::PARAM_STR);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        if ($stmt->execute()) {
            return "La catégorie a été mise à jour avec succès.";
        } else {
            return "Échec de la mise à jour de la catégorie.";
        }
    } catch (PDOException $e) {
        return "Erreur PDO : " . $e->getMessage();
    } catch (Exception $e) {
        return "Erreur : " . $e->getMessage();
    }
}


    public function deleteCategory($id) {
        $query = "DELETE FROM Categorie WHERE id_categorie = :id";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }
    
}
?>
