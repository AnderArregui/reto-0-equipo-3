<?php
class Resultado {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function buscarTemas($termino) {
        $termino = trim($termino);
        
        if (empty($termino)) {
            return [];
        }
    
        try {
            $query = "SELECT * FROM temas WHERE nombre LIKE :termino OR caracteristica LIKE :termino";
            $stmt = $this->db->prepare($query);
            $stmt->bindValue(':termino', '%' . $termino . '%', PDO::PARAM_STR);
            $stmt->execute();
            
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
            
        } catch (PDOException $e) {
            error_log("Error en la búsqueda de temas: " . $e->getMessage());
            return [];
        }
    }

    public function buscarPreguntas($termino) {
        $termino = trim($termino);
        
        if (empty($termino)) {
            return [];
        }
    
        try {
            $query = "
            SELECT 
                p.*, 
                u.nombre AS nombre_usuario, 
                t.caracteristica AS caracteristica, 
                t.nombre AS nombre_tema,
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
            LEFT JOIN 
                temas t ON p.id_tema = t.id_tema
            LEFT JOIN 
                usuarios u ON p.id_usuario = u.id_usuario
            WHERE 
                p.contenido LIKE :termino OR t.nombre LIKE :termino 
        ";
        
            $stmt = $this->db->prepare($query);
            $stmt->bindValue(':termino', '%' . $termino . '%', PDO::PARAM_STR);
            $stmt->execute();
            
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
            
        } catch (PDOException $e) {
            error_log("Error en la búsqueda de preguntas: " . $e->getMessage());
            return [];
        }
    }
}