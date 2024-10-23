<?php

class Usuario {
    private $connection;

    public function __construct() {
        // Cargar la conexión
        $this->connection = new PDO("mysql:host=172.20.227.241;dbname=grupo3_2425", "grupo3_2425", "dqwW2[h1v1x)G)6/");
    }



    public function validateLogin($username, $password) {
        // Preparar la consulta para evitar inyecciones SQL
        $stmt = $this->connection->prepare("SELECT * FROM usuarios WHERE nombre = :username AND contrasena = :password");
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', $password);
        $stmt->execute();

        // Retorna true si hay coincidencias
        return $stmt->rowCount() > 0;
    }
}
?>
