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
    
}





?>