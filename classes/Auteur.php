<?php
include_once __DIR__ . "/User.php";

class Auteur extends User {

    public function __construct($nom, $prenom, $email, $password, $role) {
        parent::__construct($nom, $prenom, $email, $password, $role);
    }

    public function getArticles() {
        try {
            $conn = DatabaseConnection::getInstance()->getConnection();
            $query = "SELECT * FROM Article WHERE id_auteur = :id_auteur";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':id_auteur', $this->getIdUser($this->getEmail()), PDO::PARAM_INT);
            $stmt->execute();
            $articles = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $articles;
        } catch (PDOException $e) {
            die("Erreur : " . $e->getMessage());
        }
    }
    
}
?>
