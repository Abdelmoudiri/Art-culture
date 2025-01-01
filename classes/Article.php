<?php

require_once('database.php');

class Article
{
    private $idArticle;
    private $titre;
    private $content;
    private $datePublication;
    private $image;
    private $etat;
    private $idCategorie;
    private $idAuteur;

    public function __construct($titre, $content, $datePublication, $image, $etat = "En attente", $idCategorie, $idAuteur, $idArticle = null)
    {
        $this->idArticle = $idArticle;
        $this->titre = $titre;
        $this->content = $content;
        $this->datePublication = $datePublication;
        $this->image = $image;
        $this->etat = $etat;
        $this->idCategorie = $idCategorie;
        $this->idAuteur = $idAuteur;
    }

    public function save()
    {
        try {
            $pdo = DatabaseConnection::getInstance()->getConnection();
            $sql = "INSERT INTO Article (titre, content, datePublication, image, etat, id_categorie, id_auteur) 
                    VALUES (:titre, :content, :datePublication, :image, :etat, :idCategorie, :idAuteur)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([
                ':titre' => $this->titre,
                ':content' => $this->content,
                ':datePublication' => $this->datePublication,
                ':image' => $this->image,
                ':etat' => $this->etat,
                ':idCategorie' => $this->idCategorie,
                ':idAuteur' => $this->idAuteur,
            ]);
            $this->idArticle = $pdo->lastInsertId();
        } catch (PDOException $e) {
            throw new Exception("Erreur lors de l'insertion de l'article : " . $e->getMessage());
        }
    }

    // Méthode pour récupérer tous les articles
    public static function getAll()
    {
        try {
            $pdo = DatabaseConnection::getInstance()->getConnection();
            $sql = "SELECT * FROM Article";
            $stmt = $pdo->query($sql);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw new Exception("Erreur lors de la récupération des articles : " . $e->getMessage());
        }
    }
    public static function getPending() {
       
        try {
            $pdo = DatabaseConnection::getInstance()->getConnection();
            $query = "SELECT * FROM Article WHERE etat = 'En attente'";
            $stmt = $pdo->query($query);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw new Exception("Erreur lors de la récupération des articles : " . $e->getMessage());
        }
    }
    

    // Méthode pour mettre à jour un article
    public function update()
    {
        try {
            $pdo = DatabaseConnection::getInstance()->getConnection();
            $sql = "UPDATE Article SET titre = :titre, content = :content, datePublication = :datePublication, 
                    image = :image, etat = :etat, id_categorie = :idCategorie, id_auteur = :idAuteur WHERE id_article = :idArticle";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([
                ':titre' => $this->titre,
                ':content' => $this->content,
                ':datePublication' => $this->datePublication,
                ':image' => $this->image,
                ':etat' => $this->etat,
                ':idCategorie' => $this->idCategorie,
                ':idAuteur' => $this->idAuteur,
                ':idArticle' => $this->idArticle,
            ]);
        } catch (PDOException $e) {
            throw new Exception("Erreur lors de la mise à jour de l'article : " . $e->getMessage());
        }
    }

    public static function accepter($idArticle)
    {
        try {
            $pdo = DatabaseConnection::getInstance()->getConnection();
            $sql = "UPDATE Article SET etat = 'Accepter' WHERE id_article = :idArticle AND etat = 'En attente'";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([':idArticle' => $idArticle]);
    
            // Vérifier si la requête a affecté des lignes (article trouvé et mis à jour)
            if ($stmt->rowCount() == 0) {
                throw new Exception("Aucun article trouvé avec l'ID $idArticle ou l'article n'était pas en attente.");
            }
    
            return "L'article a été accepté avec succès."; // Message corrigé
        } catch (PDOException $e) {
            throw new Exception("Erreur lors de la mise à jour de l'état de l'article : " . $e->getMessage());
        }
    }
    
        
    public static function refuser($idArticle)
{
    try {
        $pdo = DatabaseConnection::getInstance()->getConnection();
        $sql = "UPDATE Article SET etat = 'Refuser' WHERE id_article = :idArticle AND etat = 'En attente'";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':idArticle' => $idArticle]);

        // Vérifier si la requête a affecté des lignes (article trouvé et mis à jour)
        if ($stmt->rowCount() == 0) {
            throw new Exception("Aucun article trouvé avec l'ID $idArticle ou l'article n'était pas en attente.");
        }

        return "L'article a été refusé avec succès.";
    } catch (PDOException $e) {
        throw new Exception("Erreur lors de la mise à jour de l'état de l'article : " . $e->getMessage());
    }
}

    public static function delete($idArticle)
    {
        try {
            $pdo = DatabaseConnection::getInstance()->getConnection();
            $sql = "DELETE FROM Article WHERE id_article = :idArticle";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([':idArticle' => $idArticle]);
        } catch (PDOException $e) {
            throw new Exception("Erreur lors de la suppression de l'article : " . $e->getMessage());
        }
    }

}
