<?php

class Usuario {
    private $connection;

    public function __construct() {
        // Cargar la conexión
        $db = new db();
        $this->connection = $db->connection;
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

    public function obtenerPorNombre($nombre) {
        $query = "SELECT * FROM usuarios WHERE nombre = ?";
        $stmt = $this->connection->prepare($query);
        $stmt->execute([$nombre]);
        return $stmt->fetch(); // Retorna todos los datos del usuario
    }
}
?>
