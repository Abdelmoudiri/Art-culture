
<?php
class Visiteur extends User {

    
    public function __construct($nom, $prenom, $email, $password) {
        parent::__construct($nom, $prenom, $email, $password, 'visiteur');
    }
    
public static function register($nom, $prenom, $email, $password, $role = 'visiteur') {
    try {
        $conn = DatabaseConnection::getInstance()->getConnection();
        $checkQuery = "SELECT * FROM User WHERE email = :email";
        $checkStmt = $conn->prepare($checkQuery);
        $checkStmt->bindParam(':email', $email, PDO::PARAM_STR);
        $checkStmt->execute();
        if ($checkStmt->rowCount() > 0) {
            return "Cet email est déjà enregistré.";
        }

        // $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
        $query = "INSERT INTO User (firstname, lastname, email, password, role) 
                  VALUES (:nom, :prenom, :email, :password, :role)";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':nom', $nom, PDO::PARAM_STR);
        $stmt->bindParam(':prenom', $prenom, PDO::PARAM_STR);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->bindParam(':password', $password, PDO::PARAM_STR);
        $stmt->bindParam(':role', $role, PDO::PARAM_STR);
        $stmt->execute();
        return true; 
    } catch (PDOException $e) {
        die("Erreur lors de l'inscription : " . $e->getMessage());
    }
}
}
?>
