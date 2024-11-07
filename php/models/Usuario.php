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



public function obtenerUsuarioPorId($id_usuario) {
    $query = "SELECT id_usuario, foto, nombre, especialidad, anios_empresa, email FROM usuarios WHERE id_usuario = :id_usuario";
    $stmt = $this->connection->prepare($query);
    $stmt->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

public function obtenerPreguntasPorUsuario($id_usuario) {
    $query = "SELECT id_post, contenido, fecha FROM posts WHERE id_usuario = :id_usuario";
    $stmt = $this->connection->prepare($query);
    $stmt->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

public function obtenerRespuestasPorUsuario($id_usuario) {
    $query = "SELECT id_respuesta, id_post, contenido, fecha FROM respuestas WHERE id_usuario = :id_usuario";
    $stmt = $this->connection->prepare($query);
    $stmt->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}


public function eliminarPregunta($id_post) {
    try {
        $this->connection->beginTransaction();

        // Delete associated likes first
        $stmtLikes = $this->connection->prepare("DELETE lu FROM likeUsuario lu
                                                INNER JOIN respuestas r ON lu.id_respuesta = r.id_respuesta
                                                WHERE r.id_post = :id_post");
        $stmtLikes->bindParam(':id_post', $id_post, PDO::PARAM_INT);
        $stmtLikes->execute();

        // Delete associated responses
        $stmtResponses = $this->connection->prepare("DELETE FROM respuestas WHERE id_post = :id_post");
        $stmtResponses->bindParam(':id_post', $id_post, PDO::PARAM_INT);
        $stmtResponses->execute();

        // Delete from guardado table
        $stmtGuardado = $this->connection->prepare("DELETE FROM guardado WHERE id_post = :id_post");
        $stmtGuardado->bindParam(':id_post', $id_post, PDO::PARAM_INT);
        $stmtGuardado->execute();

        // Delete the question
        $stmtPost = $this->connection->prepare("DELETE FROM posts WHERE id_post = :id_post");
        $stmtPost->bindParam(':id_post', $id_post, PDO::PARAM_INT);
        $stmtPost->execute();

        $this->connection->commit();
        return true;
    } catch (PDOException $e) {
        $this->connection->rollBack();
        error_log("Error al eliminar pregunta: " . $e->getMessage());
        return false;
    }
}

public function eliminarRespuesta($id_respuesta) {
    try {
        $stmt = $this->connection->prepare("DELETE FROM respuestas WHERE id_respuesta = :id_respuesta");
        $stmt->bindParam(':id_respuesta', $id_respuesta, PDO::PARAM_INT);
        return $stmt->execute();
    } catch (PDOException $e) {
        error_log("Error al eliminar respuesta: " . $e->getMessage());
        return false;
    }
}

}


