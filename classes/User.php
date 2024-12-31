<?php

include_once 'database.php';
$db = DatabaseConnection::getInstance();
$conn = $db->getConnection();
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

        public static function login($email,$password)
        {
            

        }



}


?>