<?php

include_once __DIR__ . "/database.php";
class User {
    protected $nom;
    protected $prenom;
    protected $email;
    protected $password;
    protected $role;
    

    public function __construct($nom, $prenom, $email, $password, $role) {
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->email = $email;
        $this->password = $password;
        $this->role = $role;
    }

    // Login method
    public static function login($email, $password) {
        try {
            $conn = DatabaseConnection::getInstance()->getConnection();
            $query = "SELECT * FROM User WHERE email = :email";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':email', $email, PDO::PARAM_STR);
            $stmt->execute();
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($user && $user["password"] === $password) {
                return $user;
            } else {
                return false;
            }
        } catch (PDOException $e) {
            die("La connexion a échoué : " . $e->getMessage());
        }
    }
    public function getIdUser($email) {
        try {
            $conn = DatabaseConnection::getInstance()->getConnection();
            $query = "SELECT id_user FROM User WHERE email = :email";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':email', $email, PDO::PARAM_STR);
            $stmt->execute();
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            
            if ($user) {
                return $user['id_user'];
            } else {
                return null; 
            }
        } catch (PDOException $e) {
            die("La connexion a échoué : " . $e->getMessage());
        }
    }

    public static function getUserById($id_user) {
        try {
            $pdo = DatabaseConnection::getInstance()->getConnection();
            $query = "SELECT * FROM User WHERE id_user = :id_user";
            $stmt = $pdo->prepare($query);
            $stmt->bindParam(':id_user', $id_user, PDO::PARAM_INT);
            $stmt->execute();
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            return $user;
        } catch (PDOException $e) {
            die("Erreur : " . $e->getMessage());
        }
    }
}

?>
