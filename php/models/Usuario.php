<?php

class Usuario {
    private $connection;

    public function __construct() {
        // Cargar la conexión
        $db = new db();
        $this->connection = $db->connection;
    }



    public function validateLogin($username, $password) {
        $stmt = $this->connection->prepare("SELECT * FROM usuarios WHERE nombre = :username AND contrasena = :password");
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', $password);
        $stmt->execute();

        // Obtener el usuario si existe
        if ($stmt->rowCount() > 0) {
            return $stmt->fetch(PDO::FETCH_ASSOC); // Devuelve el registro del usuario
        }

        return false; // Devuelve falso si no se encontró el usuario
    }

    public function obtenerIdPorNombre($nombre_usuario) {
        $query = "SELECT id_usuario FROM usuarios WHERE nombre = :nombre_usuario";
        $stmt = $this->connection->prepare($query);
        $stmt->bindParam(':nombre_usuario', $nombre_usuario);
        $stmt->execute();
        return $stmt->fetchColumn();
    }
    

    public function obtenerPorNombre($nombre) {
        $query = "SELECT id_usuario, nombre, foto AS foto_perfil, contrasena, especialidad, anios_empresa, email, tipo FROM usuarios WHERE nombre = ?";
        $stmt = $this->connection->prepare($query);
        $stmt->execute([$nombre]);
        return $stmt->fetch(PDO::FETCH_ASSOC); 
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
