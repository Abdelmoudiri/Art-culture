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


    public function updateCategory($id, $nom) {
        $query = "UPDATE Categorie SET nom = :nom WHERE id_categorie = :id";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':nom', $nom);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }

    public function deleteCategory($id) {
        $query = "DELETE FROM Categorie WHERE id_categorie = :id";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }
    
}
?>
