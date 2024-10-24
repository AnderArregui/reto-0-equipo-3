<?php
class Post {
    private $db;
    
    public function __construct()
    {
        $this->getConection();
    }

    public function getConection()
    {
        $db = new db();
        $this->connection = $db->connection; // Accede a la conexión
    }
    
    public function crear($id_usuario, $id_tema, $contenido) {
        $query = "INSERT INTO posts (id_usuario, id_tema, contenido) VALUES (?, ?, ?)";
        $stmt = $this->db->prepare($query);
        return $stmt->execute([$id_usuario, $id_tema, $contenido]);
    }
    
    public function obtenerPorId($id) {
        $query = "SELECT p.*, u.nombre as nombre_usuario, t.nombre as nombre_tema 
                  FROM posts p 
                  JOIN usuarios u ON p.id_usuario = u.id_usuario 
                  JOIN temas t ON p.id_tema = t.id_tema 
                  WHERE p.id_post = ?";
        $stmt = $this->db->prepare($query);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function obtenerTodos()
{
    $sql = "SELECT p.contenido, p.fecha, p.likes, u.nombre AS nombre_usuario, t.nombre AS nombre_tema, t.caracteristica AS color_tema
            FROM posts p
            LEFT JOIN usuarios u ON p.id_usuario = u.id_usuario
            LEFT JOIN temas t ON p.id_tema = t.id_tema";
    $stmt = $this->connection->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}





    public function obtenerPorTema($id_tema) {
        $query = "SELECT p.*, u.nombre as nombre_usuario 
                  FROM posts p 
                  JOIN usuarios u ON p.id_usuario = u.id_usuario 
                  WHERE p.id_tema = ? 
                  ORDER BY p.fecha DESC";
        $stmt = $this->db->prepare($query);
        $stmt->execute([$id_tema]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function incrementarLikes($id_post) {
        $query = "UPDATE posts SET likes = likes + 1 WHERE id_post = ?";
        $stmt = $this->db->prepare($query);
        return $stmt->execute([$id_post]);
    }
}