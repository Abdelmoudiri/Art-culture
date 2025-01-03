<?php
require_once ('config.php');

class DatabaseConnection {

    private static $instance = null; 
    private $connection;

    private function __construct() {
        try {
            $this->connection = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USERNAME, DB_PASSWORD);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Erreur de connexion : " . $e->getMessage());
        }
    }
    public function __destruct()
    {
        $this->connection=null;
    }
    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new self(); 
        }
        return self::$instance;
    }

    public function getConnection() {
        
        return $this->connection; 

    }
}

$db = DatabaseConnection::getInstance();
$conn = $db->getConnection();
?>