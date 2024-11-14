<?php
class Respuesta {
    private $db;
    private $connection;

    public function __construct() {
        $this->getConection();
    }

    public function getConection() {
        $db = new db();
        $this->connection = $db->connection;
    }

    public function crear($id_post, $id_usuario, $contenido, $ruta_media = null) {
        $query = "INSERT INTO respuestas (id_post, id_usuario, contenido, ruta_media)
                  VALUES (:id_post, :id_usuario, :contenido, :ruta_media)";
        
        $stmt = $this->connection->prepare($query);
        $stmt->execute([
            'id_post' => $id_post,
            'id_usuario' => $id_usuario,
            'contenido' => $contenido,
            'ruta_media' => $ruta_media
        ]);
    }

    public function verificarLike($id_respuesta, $id_usuario) {
        $sql = "SELECT COUNT(*) FROM likeUsuario WHERE id_respuesta = :id_respuesta AND id_usuario = :id_usuario";
        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(':id_respuesta', $id_respuesta, PDO::PARAM_INT);
        $stmt->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
        $stmt->execute();
        
        return $stmt->fetchColumn() > 0;
    }
    

    public function incrementarLikes($id_respuesta, $id_usuario) {
        $checkQuery = "SELECT * FROM likeUsuario WHERE id_respuesta = :id_respuesta AND id_usuario = :id_usuario";
        $stmt = $this->connection->prepare($checkQuery);
        $stmt->execute([
            ':id_respuesta' => $id_respuesta,
            ':id_usuario' => $id_usuario
        ]);
        
        if ($stmt->rowCount() == 0) {
            $insertQuery = "INSERT INTO likeUsuario (id_respuesta, id_usuario) VALUES (:id_respuesta, :id_usuario)";
            $stmt = $this->connection->prepare($insertQuery);
            $stmt->execute([
                ':id_respuesta' => $id_respuesta,
                ':id_usuario' => $id_usuario
            ]);

            $updateQuery = "UPDATE respuestas SET likes = likes + 1 WHERE id_respuesta = :id_respuesta";
            $stmt = $this->connection->prepare($updateQuery);
            $stmt->execute([':id_respuesta' => $id_respuesta]);

            return true;
        }


        return false;
    }
public function quitarLike($id_respuesta, $id_usuario) {
    $checkQuery = "SELECT * FROM likeUsuario WHERE id_respuesta = :id_respuesta AND id_usuario = :id_usuario";
    $stmt = $this->connection->prepare($checkQuery);
    $stmt->execute([
        ':id_respuesta' => $id_respuesta,
        ':id_usuario' => $id_usuario
    ]);
    
    if ($stmt->rowCount() > 0) {
        $deleteQuery = "DELETE FROM likeUsuario WHERE id_respuesta = :id_respuesta AND id_usuario = :id_usuario";
        $stmt = $this->connection->prepare($deleteQuery);
        $stmt->execute([
            ':id_respuesta' => $id_respuesta,
            ':id_usuario' => $id_usuario
        ]);

        $updateQuery = "UPDATE respuestas SET likes = likes - 1 WHERE id_respuesta = :id_respuesta";
        $stmt = $this->connection->prepare($updateQuery);
        $stmt->execute([':id_respuesta' => $id_respuesta]);

        return true;
    }
    
    return false; 
}



    public function obtenerLikesPorUsuario($usuarioId) {
        $query = "SELECT r.*, t.caracteristica 
                  FROM respuestas r 
                  INNER JOIN likeUsuario lu ON r.id_respuesta = lu.id_respuesta
                  LEFT JOIN posts p ON r.id_post = p.id_post
                  LEFT JOIN temas t ON p.id_tema = t.id_tema
                  WHERE lu.id_usuario = :usuarioId";
                  
        $stmt = $this->connection->prepare($query);
        $stmt->bindParam(':usuarioId', $usuarioId, PDO::PARAM_INT);
        
        try {
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Error en la ejecución de la consulta: " . $e->getMessage();
            return [];
        }
    }
    public function obtenerLikesPorRespuesta($id_respuesta) {
        try {
            $stmt = $this->connection->prepare("SELECT COUNT(*) AS total_likes FROM likeUsuario WHERE id_respuesta = :id_respuesta");
            $stmt->bindParam(':id_respuesta', $id_respuesta, PDO::PARAM_INT);
            $stmt->execute();
            
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result['total_likes'] ?? 0;
        } catch (PDOException $e) {
            error_log("Error al obtener likes: " . $e->getMessage());
            return 0;
        }
    }
    
    

    public function obtenerPorPost($id_post) {
        $query = "SELECT r.*, 
                         u.nombre AS nombre_usuario,
                         u.foto AS foto_usuario,  
                         u.especialidad AS especialidad_usuario,
                         (SELECT COUNT(*) FROM likeUsuario lu WHERE lu.id_respuesta = r.id_respuesta) AS likes
                  FROM respuestas r 
                  JOIN usuarios u ON r.id_usuario = u.id_usuario 
                  WHERE r.id_post = ? 
                  ORDER BY r.fecha DESC";
        $stmt = $this->connection->prepare($query);
        $stmt->execute([$id_post]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    public function respuestasPost($id_post) {
        $post = $this->obtenerPost($id_post);
        $respuestas = $this->obtenerPorPost($id_post);

        $this->view = "respuestas";
        return [
            'post' => $post,
            'respuestas' => $respuestas
        ];
    }

    public function obtenerRespuestasPorUsuario($id_usuario)
    {
        try {
            $stmt = $this->connection->prepare("SELECT * FROM respuestas WHERE id_usuario = ?");
            $stmt->execute([$id_usuario]);
            $respuestas = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $respuestas;
        } catch (PDOException $e) {
            echo "Error al obtener las respuestas del usuario: " . $e->getMessage();
            return [];
        }
    }
    public function obtenerPost($id_post) {
        $query = "SELECT * FROM posts WHERE id_post = ?";
        $stmt = $this->connection->prepare($query);
        $stmt->execute([$id_post]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    public function deleteRespuestaById($id_respuesta) {
        $sqlLikes = "DELETE FROM likeUsuario WHERE id_respuesta = ?";
        $stmt = $this->connection->prepare($sqlLikes);
        $stmt->execute([$id_respuesta]);
    
        $sqlRespuesta = "DELETE FROM respuestas WHERE id_respuesta = ?";
        $stmt = $this->connection->prepare($sqlRespuesta);
        $stmt->execute([$id_respuesta]);
    
        return true;
    }
    
    public function obtenerPorId($id) {
        $sql = "SELECT * FROM respuestas WHERE id_respuesta = ?";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function update($param) {
        $contenido = $id_post = "";
        $exists = false;
    
        if (isset($param["id"]) && $param["id"] != '') {
            $actualRespuesta = $this->obtenerPorId($param["id"]);
            
            if (isset($actualRespuesta["id_respuesta"])) {
                $exists = true;
                $id = $param["id"];
                $contenido = $actualRespuesta["contenido"];
                $id_post = $actualRespuesta["id_post"];
            }
        }
    
        if (isset($param["contenido"])) $contenido = $param["contenido"];
        if (isset($param["postSelect"])) $id_post = $param["postSelect"];
    
        if ($exists) {
            $sql = "UPDATE respuestas SET contenido = ?, id_post = ? WHERE id_respuesta = ?";
            $stmt = $this->connection->prepare($sql);
            $stmt->execute([$contenido, $id_post, $id]);
        }
        
        return $id;
    }
    

}
