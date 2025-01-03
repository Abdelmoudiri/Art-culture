<?php

class Admin extends User{
    private $pdo;

    public function __construct($nom, $prenom, $email, $password, $role = 'Admin')
    {
        parent::__construct($nom, $prenom, $email, $password, $role);
        $this->pdo = DatabaseConnection::getInstance()->getConnection();
    }
    
    
    
    public function createCategorie($nomCategorie)
    {
        require_once __DIR__ . "/database.php";
        $requet = "INSERT INTO Categorie (nom) VALUES (:nom)";
        
        try {
            $stmt = $conn->prepare($requet);
            $stmt->bindParam(':nom', $nomCategorie, PDO::PARAM_STR);
    
            $stmt->execute();
    
            echo "Catégorie créée avec succès.";
        } catch (PDOException $e) {
            die("Erreur : " . $e->getMessage());
        }
    }
    public function deleteCategorie($id_cat)
    {
        $id=intval($id_cat);
        require_once __DIR__ . "/database.php";
        $requet = "DELETE from Categorie where id_categorie= :id_categorie ";
        
        try {
            $stmt = $conn->prepare($requet);
            $stmt->bindParam(':id_categorie', $id, PDO::PARAM_INT);
            $stmt->execute();
    
            echo "Catégorie suprimer avec succès.";
        } catch (PDOException $e) {
            die("Erreur : " . $e->getMessage());
        }
    }
    public function accepterArticle($id_article)
    {
        $id = intval($id_article);
    
    
        $requet = "UPDATE Article SET status = 'accepter' WHERE id_article = :id_article";
        try {
            $stmt = $this->pdo->prepare($requet);
    
            $stmt->bindParam(':id_article', $id, PDO::PARAM_INT);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                echo "Article accepté avec succès.";
            } else {
                echo "Aucun article trouvé avec cet ID.";
            }
        } catch (PDOException $e) {
            die("Erreur : " . $e->getMessage());
        }
    }
    public function refuserArticle($id_article)
    {
        $id = intval($id_article);
        require_once __DIR__ . "/database.php";
    
        $requet = "UPDATE Article SET status = 'refuser' WHERE id_article = :id_article";
    
        try {
            $stmt = $conn->prepare($requet);
    
            $stmt->bindParam(':id_article', $id, PDO::PARAM_INT);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                echo "Article refuser avec succès.";
            } else {
                echo "Aucun article trouvé avec cet ID.";
            }
        } catch (PDOException $e) {
            die("Erreur : " . $e->getMessage());
        }
    }
    



    public function deleteUtilisateur($userId) {
        require_once __DIR__ . '/database.php';

        try {
            $query = "UPDATE User SET is_deleted = TRUE WHERE id_user = :id_user";
            $stmt = $this->pdo->prepare($query);
            $stmt->bindParam(':id_user', $userId, PDO::PARAM_INT);
            $stmt->execute();

            return $stmt->rowCount() > 0;
        } catch (PDOException $e) {
            die("Erreur : " . $e->getMessage());
        }
    }
    public function getAllUtilisateur()
    {        
        try {
            $query = "SELECT * FROM User WHERE is_deleted = FALSE";
            $stmt = $this->pdo->prepare($query);
            $stmt->execute();
            $utilisateurs = $stmt->fetchAll(PDO::FETCH_ASSOC);
            if (!empty($utilisateurs)) {
                return $utilisateurs;
            } else {
                return [];
            }
        } catch (PDOException $e) {
            die("Erreur : " . $e->getMessage());
        }
    }
}

?>