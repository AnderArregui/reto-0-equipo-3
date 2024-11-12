<?php 
require_once "Db.php";

class Tema {
    private $connection;
    private $table = "temas";

    public function __construct()
    {
        $this->getConection();
    }

    public function getConection()
    {
        $db = new db();
        $this->connection = $db->connection;
    }

    public function crear($nombre) {
        $query = "INSERT INTO " . $this->table . " (nombre) VALUES (?)";
        $stmt = $this->connection->prepare($query);
        return $stmt->execute([$nombre]);
    }

    public function obtenerTodos()
    {
        $sql = "SELECT * FROM " . $this->table;
        $stmt = $this->connection->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function obtenerPorId($id) {
        $query = "SELECT * FROM " . $this->table . " WHERE id_tema = ?";
        $stmt = $this->connection->prepare($query);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function obtenerIdPorNombre($nombre_tema) {
        $query = "SELECT id_tema FROM temas WHERE nombre = :nombre_tema";
        $stmt = $this->connection->prepare($query);
        $stmt->bindParam(':nombre_tema', $nombre_tema);
        $stmt->execute();
        return $stmt->fetchColumn();
    }

    public function obtenerTemas() {
        try {
            $sql = "SELECT  id_tema, nombre  FROM " . $this->table;
            $stmt = $this->connection->prepare($sql);
            $stmt->execute();
            
            if ($stmt === false) {
                // Log the error
                error_log("Error fetching temas: " . implode(", ", $stmt->errorInfo()));
                return [];
            }
            
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $result;
    
        } catch (PDOException $e) {
            // Log the error
            error_log("Database error in obtenerTemas: " . $e->getMessage());
            return [];
        }
    
    }
    public function obtenerPorNombre($nombre) {
        $query = "SELECT * FROM " . $this->table . " WHERE nombre = ?";
        $stmt = $this->connection->prepare($query);
        $stmt->execute([$nombre]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    





    /*eliminar temas*/


    

    public function eliminarContenidoTema($id_tema) {
        try {
            $this->connection->beginTransaction();

            // Delete likes associated with responses to posts in this theme
            $queryLikes = "DELETE l FROM likeUsuario l
                           INNER JOIN respuestas r ON l.id_respuesta = r.id_respuesta
                           INNER JOIN posts p ON r.id_post = p.id_post
                           WHERE p.id_tema = :id_tema";
            $stmtLikes = $this->connection->prepare($queryLikes);
            $stmtLikes->bindParam(':id_tema', $id_tema, PDO::PARAM_INT);
            $stmtLikes->execute();

            // Delete saved items for posts in this theme
            $querySaved = "DELETE g FROM guardado g
                           INNER JOIN posts p ON g.id_post = p.id_post
                           WHERE p.id_tema = :id_tema";
            $stmtSaved = $this->connection->prepare($querySaved);
            $stmtSaved->bindParam(':id_tema', $id_tema, PDO::PARAM_INT);
            $stmtSaved->execute();

            // Delete responses to posts in this theme
            $queryResponses = "DELETE r FROM respuestas r
                               INNER JOIN posts p ON r.id_post = p.id_post
                               WHERE p.id_tema = :id_tema";
            $stmtResponses = $this->connection->prepare($queryResponses);
            $stmtResponses->bindParam(':id_tema', $id_tema, PDO::PARAM_INT);
            $stmtResponses->execute();

            // Delete posts in this theme
            $queryPosts = "DELETE FROM posts WHERE id_tema = :id_tema";
            $stmtPosts = $this->connection->prepare($queryPosts);
            $stmtPosts->bindParam(':id_tema', $id_tema, PDO::PARAM_INT);
            $stmtPosts->execute();

            $this->connection->commit();
            return true;
        } catch (PDOException $e) {
            $this->connection->rollBack();
            error_log("Database error in eliminarContenidoTema: " . $e->getMessage());
            return false;
        }
    }

    public function moverContenidoATema($id_tema_origen, $id_tema_destino) {
        try {
            $this->connection->beginTransaction();

            // Move posts to the destination theme
            $queryMovePosts = "UPDATE posts SET id_tema = :id_tema_destino WHERE id_tema = :id_tema_origen";
            $stmtMovePosts = $this->connection->prepare($queryMovePosts);
            $stmtMovePosts->bindParam(':id_tema_destino', $id_tema_destino, PDO::PARAM_INT);
            $stmtMovePosts->bindParam(':id_tema_origen', $id_tema_origen, PDO::PARAM_INT);
            $result = $stmtMovePosts->execute();

            if (!$result) {
                throw new PDOException("Failed to move posts to the new theme");
            }

            $rowsMoved = $stmtMovePosts->rowCount();

            $this->connection->commit();
            
            error_log("Moved $rowsMoved posts from theme $id_tema_origen to theme $id_tema_destino");
            
            return true;
        } catch (PDOException $e) {
            $this->connection->rollBack();
            error_log("Database error in moverContenidoATema: " . $e->getMessage());
            return false;
        }
    }

    public function eliminarTema($id_tema) {
        try {
            $query = "DELETE FROM " . $this->table . " WHERE id_tema = :id_tema";
            $stmt = $this->connection->prepare($query);
            $stmt->bindParam(':id_tema', $id_tema, PDO::PARAM_INT);
            $result = $stmt->execute();

            if ($result) {
                error_log("Successfully deleted theme with ID: $id_tema");
            } else {
                error_log("Failed to delete theme with ID: $id_tema");
            }

            return $result;
        } catch (PDOException $e) {
            error_log("Database error in eliminarTema: " . $e->getMessage());
            return false;
        }
    }
   


    public function actualizarTema($id_tema, $nombre, $caracteristica, $imagen = null) {
        try {
            $query = "UPDATE " . $this->table . " SET nombre = :nombre, caracteristica = :caracteristica";
            $params = [
                ':id_tema' => $id_tema,
                ':nombre' => $nombre,
                ':caracteristica' => $caracteristica
            ];

            if ($imagen !== null) {
                $query .= ", imagen = :imagen";
                $params[':imagen'] = $imagen;
            }

            $query .= " WHERE id_tema = :id_tema";

            $stmt = $this->connection->prepare($query);
            $result = $stmt->execute($params);

            if ($result) {
                error_log("Successfully updated theme with ID: $id_tema");
            } else {
                error_log("Failed to update theme with ID: $id_tema");
            }

            return $result;
        } catch (PDOException $e) {
            error_log("Database error in actualizarTema: " . $e->getMessage());
            return false;
        }
    }

   
}