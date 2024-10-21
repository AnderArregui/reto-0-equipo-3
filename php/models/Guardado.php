<?php
class Guardado {
    private $db;
    
    public function __construct($db) {
        $this->db = $db;
    }
    
    public function guardar($id_post, $id_usuario) {
        $query = "INSERT INTO Guardado (id_post, id_usuario) VALUES (?, ?)";
        $stmt = $this->db->prepare($query);
        return $stmt->execute([$id_post, $id_usuario]);
    }
    
    public function eliminar($id_post, $id_usuario) {
        $query = "DELETE FROM Guardado WHERE id_post = ? AND id_usuario = ?";
        $stmt = $this->db->prepare($query);
        return $stmt->execute([$id_post, $id_usuario]);
    }
    
    public function obtenerGuardadosPorUsuario($id_usuario) {
        $query = "SELECT p.* FROM Posts p 
                  JOIN Guardado g ON p.id_post = g.id_post 
                  WHERE g.id_usuario = ?";
        $stmt = $this->db->prepare($query);
        $stmt->execute([$id_usuario]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}