<?php
class Tema {
    private $db;
    private $table = "temas";
    private $connection;

    public function __construct()
    {
        $this->getConection();
    }

    public function getConection()
    {
        $db = new Db();
        $this->connection = $db->connection;
    }

    
    public function crear($nombre, $caracteristica) {
        $query = "INSERT INTO ". $this->table . "(nombre, caracteristica) VALUES (?, ?)";
        $stmt = $this->db->prepare($query);
        return $stmt->execute([$nombre, $caracteristica]);
    }

    public function obtenerTodos()
    {
        $sql = "SELECT * FROM ". $this->table;
        $stmt = $this->connection->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }
    
    public function obtenerPorId($id) {
        $query = "SELECT * FROM temas WHERE id_tema = ?";
        $stmt = $this->db->prepare($query);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
