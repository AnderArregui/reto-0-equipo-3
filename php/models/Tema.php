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
    
}
