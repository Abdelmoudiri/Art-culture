<?php

class Admin extends User{

    public function __construct($nom, $prenom, $email, $password, $role = 'Admin')
    {
        parent::__construct($nom, $prenom, $email, $password, $role);
    }
    
    public function deleteMember($id_member)
    {
        require_once __DIR__ . "/database.php";
        $id_m = intval($id_member);
    
        try {
            $query = "UPDATE User SET is_deleted = TRUE WHERE id = :id_member";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':id_member', $id_m, PDO::PARAM_INT);
            $stmt->execute();
            
            if ($stmt->rowCount() > 0) {
                echo "Membre supprimé avec succès.";
            } else {
                echo "Aucun membre trouvé avec cet ID.";
            }
    
        } catch (PDOException $e) {
            echo "Erreur : " . $e->getMessage();
        }
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
        require_once __DIR__ . "/database.php";
    
        $requet = "UPDATE Article SET status = 'accepter' WHERE id_article = :id_article";
    
        try {
            $stmt = $conn->prepare($requet);
    
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
    

    
    
}





?>