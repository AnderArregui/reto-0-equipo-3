<?php

class Usuario {
    private $connection;

    public function __construct()
    {
        $this->getConection();
    }

    public function getConection()
    {
        $db = new db();
        $this->connection = $db->connection;
    }

    public function validateLogin($username, $password) {
        $stmt = $this->connection->prepare("SELECT * FROM usuarios WHERE nombre = :username");
        $stmt->bindParam(':username', $username);
        $stmt->execute();
    
        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($usuario && $usuario['contrasena'] === $password) {
            unset($usuario['contrasena']);
            return $usuario;
        }
    
        return false;
    }

    public function obtenerPorId($id_usuario) {

        $query = "SELECT id_usuario, nombre, contrasena, foto, especialidad, anios_empresa, email, tipo 
                  FROM usuarios WHERE id_usuario = :id_usuario";
        $stmt = $this->connection->prepare($query);
        $stmt->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
?>

