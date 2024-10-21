<?php
class Tema {
    private $db;
    
    public function __construct($db) {
        $this->db = $db;
    }
    
    public function crear($nombre, $caracteristica) {
        $query = "INSERT INTO Temas (nombre, caracteristica) VALUES (?, ?)";
        $stmt = $this->db->prepare($query);
        return $stmt->execute([$nombre, $caracteristica]);
    }
    
    public function obtenerTodos() {
        $query = "SELECT * FROM Temas";
        $stmt = $this->db->query($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function obtenerPorId($id) {
        $query = "SELECT * FROM Temas WHERE id_tema = ?";
        $stmt = $this->db->prepare($query);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}