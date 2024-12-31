<?php

// include_once 'database.php';

class User{
        private $nom;
        private $prenom;
        private $email;
        private $password;
        private $role;

        public function _construct($nom,$prenom,$email,$password,$role)
        {
            $this->nom=$nom;
            $this->prenom=$prenom;
            $this->email=$email;
            $this->password=$password;
            $this->role=$role;
        }

        //setters & getters
        public function getNom() {
            return $this->nom;
        }
    
        public function getPrenom() {
            return $this->prenom;
        }
    
        public function getEmail() {
            return $this->email;
        }
    
        public function getPassword() {
            return $this->password;
        }
    
        public function getRole() {
            return $this->role;
        }
    
        public function setNom($nom) {
            $this->nom = $nom;
        }
    
        public function setPrenom($prenom) {
            $this->prenom = $prenom;
        }
    
        public function setEmail($email) {
            $this->email = $email;
        }
    
        public function setPassword($password) {
            $this->password = $password;
        }
    
        public function setRole($role) {
            $this->role = $role;
        }

        public static function login($email,$password)
        {
            try{

            require_once 'database.php';
            $query="select email,password from User where email = :email";
            $stmt=$conn->prepare($query);
            $stmt->bindParam(':email',$email,PDO::PARAM_STR);
            $stmt->execute();
            $user=$stmt->fetch(PDO::FETCH_ASSOC); 
            if($user && $user["password"])
            {
                return $user;
            }else{
                return false;
            }

            }catch(PDOException $e){
                die("la connexion a echoué : ".$e->getMessage());
            }
        }

}

?>