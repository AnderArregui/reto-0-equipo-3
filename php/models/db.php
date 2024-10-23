<?php
require_once 'config/config.php';

class db {
    private $host;
    private $db;
    private $username;
    private $password;
    public $connection;

    public function __construct(){
        $this->host = constant("DB_HOST");
        $this->db = constant("DB_NAME"); // Cambié a 'DB_NAME'
        $this->username = constant("DB_USER");
        $this->password = constant("DB_PASS");

        try {
            $this->connection = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db, $this->username, $this->password);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo $e->getMessage();
            exit;
        }
    }
}
?>

