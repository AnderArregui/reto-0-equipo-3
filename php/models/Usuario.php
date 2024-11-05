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

    public function obtenerTodosLosUsuarios() {
        try {
            $query = "SELECT id_usuario,foto,nombre,email FROM usuarios";
            $stmt = $this->connection->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Error al obtener usuarios: " . $e->getMessage());
            return [];
        }
    }

    public function obtenerInfoUsuario($id_usuario) {
        try {
            $query = "SELECT 
    u.nombre AS nombre,
    u.email AS email,
    u.especialidad AS especialidad,
    u.anios_empresa AS anios_empresa,
    u.foto AS foto,
    (SELECT COUNT(*) FROM posts WHERE id_usuario = u.id_usuario) AS total_preguntas, 
    (SELECT COUNT(*) FROM respuestas WHERE id_usuario = u.id_usuario) AS total_respuestas,
    (SELECT COUNT(*) FROM likeUsuario WHERE id_usuario = u.id_usuario) AS total_likes,
    (SELECT TIMESTAMPDIFF(MINUTE, MAX(r.fecha), NOW()) 
     FROM respuestas r 
     WHERE r.id_usuario = u.id_usuario) AS minutos_desde_ultima_respuesta
FROM 
    usuarios u
WHERE 
    u.id_usuario = :id_usuario;";

    $stmt = $this->connection->prepare($query);
    $stmt->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
            echo "Error en la consulta: " . $e->getMessage();
        }
}

public function actualizarImagenPerfil($id_usuario, $newImageUrl) {
    try {
        $stmt = $this->connection->prepare("UPDATE usuarios SET foto = ? WHERE id_usuario = ?");
        $stmt->bindParam("si", $newImageUrl, $id_usuario);
        $stmt->execute();
        $stmt->close();
    } catch (PDOException $e) {
        echo "Error al actualizar la imagen de perfil: " . $e->getMessage();
    }
    exit();
}
}
?>

