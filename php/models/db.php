<?php
require_once 'config/config.php';

class db {
    private $host;
    private $db;
    private $username;
    private $password;
    public $conection;

    public function __construct(){
        $this->host = constant("DB_HOST");
        $this->db = constant("DB");
        $this->username = constant("DB_USER");
        $this->password = constant("DB_PASS");

        try {
            $this->conection = new PDO("mysql:host=" .$this->host. 'dbname=' .$this->db, $this->username, $this->password);

        }catch (PDOException $e){
            echo $e->getMessage();
            exit;
        }
    }
}
?>