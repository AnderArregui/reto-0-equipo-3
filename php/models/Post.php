<?php
class Post {
    private $db;
    private $table = "posts";
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
    
    public function crear($id_usuario, $id_tema, $contenido) {
        $query = "INSERT INTO posts (id_usuario, id_tema, contenido) VALUES (?, ?, ?)";
        $stmt = $this->connection->prepare($query);
        return $stmt->execute([$id_usuario, $id_tema, $contenido]);
    }
    
    public function obtenerPorId($id) {
        $query = "SELECT p.*, u.nombre as nombre_usuario, t.nombre as nombre_tema, t.caracteristica as caracteristica 
                  FROM posts p 
                  JOIN usuarios u ON p.id_usuario = u.id_usuario 
                  JOIN temas t ON p.id_tema = t.id_tema 
                  WHERE p.id_post = ?";
        $stmt = $this->connection->prepare($query);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function obtenerTodos($orderBy = 'p.fecha DESC', $limit = 10, $offset = 0) {
        $query = "
            SELECT 
                p.*, 
                t.nombre AS nombre_tema, 
                t.caracteristica AS caracteristica, 
                u.nombre AS nombre_usuario, 
                (SELECT COUNT(*) FROM respuestas r WHERE r.id_post = p.id_post) AS total_respuestas,
                (SELECT u2.nombre 
                 FROM respuestas r2 
                 JOIN usuarios u2 ON r2.id_usuario = u2.id_usuario 
                 WHERE r2.id_post = p.id_post 
                 ORDER BY r2.fecha DESC 
                 LIMIT 1) AS autor_ultimo_mensaje,
                (SELECT TIMESTAMPDIFF(MINUTE, r2.fecha, NOW()) 
                 FROM respuestas r2 
                 WHERE r2.id_post = p.id_post 
                 ORDER BY r2.fecha DESC 
                 LIMIT 1) AS minutos_transcurridos,
                (SELECT MAX(r3.fecha) 
                 FROM respuestas r3 
                 WHERE r3.id_post = p.id_post) AS fecha_ultimo_mensaje
            FROM 
                posts p
            JOIN 
                temas t ON p.id_tema = t.id_tema
            JOIN 
                usuarios u ON p.id_usuario = u.id_usuario
            ORDER BY $orderBy
            LIMIT :limit OFFSET :offset
        ";
    
        $stmt = $this->connection->prepare($query);
        $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function contarTodos() {
        $query = "SELECT COUNT(*) as total FROM posts";
        $stmt = $this->connection->prepare($query);
        $stmt->execute();
        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
        
        return $resultado['total'];
    }

    public function obtenerPorTema($id_tema) {
        $query = "
            SELECT 
                p.*, 
                u.nombre AS nombre_usuario, 
                t.caracteristica, 
                (SELECT COUNT(*) FROM respuestas r WHERE r.id_post = p.id_post) AS total_respuestas,
                (SELECT u2.nombre 
                 FROM respuestas r2 
                 JOIN usuarios u2 ON r2.id_usuario = u2.id_usuario 
                 WHERE r2.id_post = p.id_post 
                 ORDER BY r2.fecha DESC 
                 LIMIT 1) AS autor_ultimo_mensaje,
                (SELECT TIMESTAMPDIFF(MINUTE, r2.fecha, NOW()) 
                 FROM respuestas r2 
                 WHERE r2.id_post = p.id_post 
                 ORDER BY r2.fecha DESC 
                 LIMIT 1) AS minutos_transcurridos
            FROM 
                posts p 
            JOIN 
                usuarios u ON p.id_usuario = u.id_usuario 
            JOIN 
                temas t ON p.id_tema = t.id_tema 
            WHERE 
                p.id_tema = ? 
            ORDER BY 
                p.fecha DESC
        ";
    
        $stmt = $this->connection->prepare($query);
        $stmt->execute([$id_tema]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function incrementarLikes($id_post) {
        $query = "UPDATE posts SET likes = likes + 1 WHERE id_post = ?";
        $stmt = $this->connection->prepare($query);
        return $stmt->execute([$id_post]);
    }
}

?>
