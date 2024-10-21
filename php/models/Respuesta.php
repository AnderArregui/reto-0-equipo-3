<?php
class Respuesta {
    private $db;
    
    public function __construct($db) {
        $this->db = $db;
    }
    
    public function crear($id_post, $id_usuario, $contenido, $ruta = null) {
        $query = "INSERT INTO Respuestas (id_post, id_usuario, contenido, ruta) VALUES (?, ?, ?, ?)";
        $stmt = $this->db->prepare($query);
        return $stmt->execute([$id_post, $id_usuario, $contenido, $ruta]);
    }
    
    public function obtenerPorPost($id_post) {
        $query = "SELECT r.*, u.nombre as nombre_usuario 
                  FROM Respuestas r 
                  JOIN Usuarios u ON r.id_usuario = u.id_usuario 
                  WHERE r.id_post = ? 
                  ORDER BY r.fecha ASC";
        $stmt = $this->db->prepare($query);
        $stmt->execute([$id_post]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function incrementarLikes($id_respuesta) {
        $query = "UPDATE Respuestas SET likes = likes + 1 WHERE id_respuesta = ?";
        $stmt = $this->db->prepare($query);
        return $stmt->execute([$id_respuesta]);
    }
}