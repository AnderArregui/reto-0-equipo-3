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

    public function obtenerIdPorNombre($nombre_usuario) {
        $query = "SELECT id_usuario FROM usuarios WHERE nombre = :nombre_usuario";
        $stmt = $this->connection->prepare($query);
        $stmt->bindParam(':nombre_usuario', $nombre_usuario);
        $stmt->execute();
        return $stmt->fetchColumn();
    }
    

    public function obtenerPorNombre($nombre) {
        $query = "SELECT * FROM usuarios WHERE nombre = ?";
        $stmt = $this->connection->prepare($query);
        $stmt->execute([$nombre]);
        return $stmt->fetch(); // Retorna todos los datos del usuario
    }

    public function obtenerUsuarioPorId($id_post) {
        $query = "
            SELECT u.nombre AS nombre_usuario
            FROM posts p
            JOIN usuarios u ON p.id_usuario = u.id_usuario
            WHERE p.id_post = ?";
        
        $stmt = $this->connection->prepare($query);
        $stmt->execute([$id_post]); 
        return $stmt->fetch(PDO::FETCH_ASSOC); 
    }
    
}
?>
