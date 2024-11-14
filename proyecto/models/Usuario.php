<?php

class Usuario {
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

    public function validateLogin($username, $password) {
        $stmt = $this->connection->prepare("SELECT * FROM usuarios WHERE nombre = :username");
        $stmt->bindParam(':username', $username);
        $stmt->execute();
    
        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($usuario && $usuario['contrasena'] === $password) {
            unset($usuario['contrasena']);
            return $usuario;
        }
    
        return false;
    }

    public function obtenerPorId($id_usuario) {

        $query = "SELECT id_usuario, nombre, contrasena, foto, especialidad, anios_empresa, email, tipo 
                  FROM usuarios WHERE id_usuario = :id_usuario";
        $stmt = $this->connection->prepare($query);
        $stmt->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function obtenerTodosLosUsuarios() {
        try {
            $query = "SELECT id_usuario,foto,nombre,email FROM usuarios";
            $stmt = $this->connection->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Error al obtener usuarios: " . $e->getMessage());
            return [];
        }
    }

    public function obtenerInfoUsuario($id_usuario) {
        try {
            $query = "SELECT 
            u.id_usuario AS id_usuario,
    u.nombre AS nombre,
    u.email AS email,
    u.especialidad AS especialidad,
    u.anios_empresa AS anios_empresa,
    u.foto AS foto,
    (SELECT COUNT(*) FROM posts WHERE id_usuario = u.id_usuario) AS total_preguntas, 
    (SELECT COUNT(*) FROM respuestas WHERE id_usuario = u.id_usuario) AS total_respuestas,
    (SELECT COUNT(*) FROM likeUsuario WHERE id_usuario = u.id_usuario) AS total_likes,
    (SELECT TIMESTAMPDIFF(MINUTE, MAX(r.fecha), NOW()) 
     FROM respuestas r 
     WHERE r.id_usuario = u.id_usuario) AS minutos_desde_ultima_respuesta
        FROM 
            usuarios u
        WHERE 
            u.id_usuario = :id_usuario;";

            $stmt = $this->connection->prepare($query);
            $stmt->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
                    echo "Error en la consulta: " . $e->getMessage();
                }
        }

        public function actualizarImagenPerfil($id_usuario, $newImageUrl) {
            try {
                $stmt = $this->connection->prepare("UPDATE usuarios SET foto = ? WHERE id_usuario = ?");
                $stmt->execute([$newImageUrl, $id_usuario]);
            } catch (PDOException $e) {
                echo json_encode(["success" => false, "message" => "Error al actualizar la imagen de perfil: " . $e->getMessage()]);
            }
            exit();
        }
        



        public function obtenerUsuarioPorId($id_usuario) {
            $query = "SELECT id_usuario, foto, nombre, especialidad, anios_empresa, email FROM usuarios WHERE id_usuario = :id_usuario";
            $stmt = $this->connection->prepare($query);
            $stmt->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }

        public function obtenerPreguntasPorUsuario($id_usuario) {
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
                WHERE 
                    p.id_usuario = :id_usuario
            ";
        
            $stmt = $this->connection->prepare($query);
            $stmt->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        

        public function obtenerRespuestasPorUsuario($id_usuario) {
            $query = "SELECT id_respuesta, id_post, contenido, fecha FROM respuestas WHERE id_usuario = :id_usuario";
            $stmt = $this->connection->prepare($query);
            $stmt->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }


        public function eliminarPregunta($id_post) {
            try {
                $this->connection->beginTransaction();

                $stmtLikes = $this->connection->prepare("DELETE lu FROM likeUsuario lu
                                                        INNER JOIN respuestas r ON lu.id_respuesta = r.id_respuesta
                                                        WHERE r.id_post = :id_post");
                $stmtLikes->bindParam(':id_post', $id_post, PDO::PARAM_INT);
                $stmtLikes->execute();

                $stmtResponses = $this->connection->prepare("DELETE FROM respuestas WHERE id_post = :id_post");
                $stmtResponses->bindParam(':id_post', $id_post, PDO::PARAM_INT);
                $stmtResponses->execute();

                $stmtGuardado = $this->connection->prepare("DELETE FROM guardado WHERE id_post = :id_post");
                $stmtGuardado->bindParam(':id_post', $id_post, PDO::PARAM_INT);
                $stmtGuardado->execute();

                $stmtPost = $this->connection->prepare("DELETE FROM posts WHERE id_post = :id_post");
                $stmtPost->bindParam(':id_post', $id_post, PDO::PARAM_INT);
                $stmtPost->execute();

                $this->connection->commit();
                return true;
            } catch (PDOException $e) {
                $this->connection->rollBack();
                error_log("Error al eliminar pregunta: " . $e->getMessage());
                return false;
            }
        }

        public function eliminarRes($id_respuesta) {
            try {
                $stmtLikes = $this->connection->prepare("DELETE lu FROM likeUsuario lu
                                                         JOIN respuestas r ON lu.id_respuesta = r.id_respuesta
                                                         WHERE r.id_respuesta = :id_respuesta");
                $stmtLikes->bindParam(':id_respuesta', $id_respuesta, PDO::PARAM_INT);
                $stmtLikes->execute();
        
                $stmt = $this->connection->prepare("DELETE FROM respuestas WHERE id_respuesta = :id_respuesta");
                $stmt->bindParam(':id_respuesta', $id_respuesta, PDO::PARAM_INT);
                return $stmt->execute();
            } catch (PDOException $e) {
                error_log("Error al eliminar respuesta: " . $e->getMessage());
                return false;
            }
        }
        


        public function eliminarUsuario($id_usuario) {
            try {
                $this->connection->beginTransaction();

                $stmtDeleteLikes = $this->connection->prepare("DELETE FROM likeUsuario WHERE id_usuario = :id_usuario");
                $stmtDeleteLikes->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
                $stmtDeleteLikes->execute();

                $stmtDeleteSaved = $this->connection->prepare("DELETE FROM guardado WHERE id_usuario = :id_usuario");
                $stmtDeleteSaved->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
                $stmtDeleteSaved->execute();

                $stmtUpdateResponses = $this->connection->prepare("UPDATE respuestas SET id_usuario = 33 WHERE id_usuario = :id_usuario");
                $stmtUpdateResponses->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
                $stmtUpdateResponses->execute();

                $stmtUpdatePosts = $this->connection->prepare("UPDATE posts SET id_usuario = 33 WHERE id_usuario = :id_usuario");
                $stmtUpdatePosts->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
                $stmtUpdatePosts->execute();

                print_r($id_usuario);
                $stmtDeleteUser = $this->connection->prepare("DELETE FROM usuarios WHERE id_usuario = :id_usuario");
                $stmtDeleteUser->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
                $stmtDeleteUser->execute();

                $this->connection->commit();
                return true;
            } catch (PDOException $e) {
                $this->connection->rollBack();
                error_log("Error al eliminar usuario: " . $e->getMessage());
                return false;
            }

        }

        public function crearUsuario($nombre, $email, $contrasena, $especialidad, $anios_empresa, $tipo, $foto) {
            try {
                $query = "INSERT INTO usuarios (nombre, email, contrasena, especialidad, anios_empresa, tipo, foto) 
                          VALUES (:nombre, :email, :contrasena, :especialidad, :anios_empresa, :tipo, :foto)";
                $stmt = $this->connection->prepare($query);
                $stmt->bindParam(':nombre', $nombre);
                $stmt->bindParam(':email', $email);
                $stmt->bindParam(':contrasena', $contrasena);
                $stmt->bindParam(':especialidad', $especialidad);
                $stmt->bindParam(':anios_empresa', $anios_empresa, PDO::PARAM_INT);
                $stmt->bindParam(':tipo', $tipo);
                $stmt->bindParam(':foto', $foto);
                
                return $stmt->execute();
            } catch (PDOException $e) {
                error_log("Error al crear usuario: " . $e->getMessage());
                return false;
            }
        }

    

        /*
        modificar el usuario desde admin
        */

        public function actualizarUsuario($id_usuario, $nombre, $email, $especialidad, $anios_empresa, $tipo, $nueva_contrasena = null, $foto = null) {
            try {
                $this->connection->beginTransaction();
        
                $query = "UPDATE usuarios SET nombre = :nombre, email = :email, especialidad = :especialidad, 
                          anios_empresa = :anios_empresa, tipo = :tipo";
                $params = [
                    ':id_usuario' => $id_usuario,
                    ':nombre' => $nombre,
                    ':email' => $email,
                    ':especialidad' => $especialidad,
                    ':anios_empresa' => $anios_empresa,
                    ':tipo' => $tipo
                ];
        
                if ($nueva_contrasena) {
                    $query .= ", contrasena = :contrasena";
                    $params[':contrasena'] = $nueva_contrasena;
                }
        
                if ($foto) {
                    $query .= ", foto = :foto";
                    $params[':foto'] = $foto;
                }
        
                $query .= " WHERE id_usuario = :id_usuario";
        
                $stmt = $this->connection->prepare($query);
                $stmt->execute($params);
        
                $this->connection->commit();
                return true;
            } catch (PDOException $e) {
                $this->connection->rollBack();
                error_log("Error al actualizar usuario: " . $e->getMessage());
                return false;
            }
        }
        public function obtenerUsuariosPaginados($offset, $limit) {
            try {
                $query = "SELECT id_usuario, foto, nombre, email FROM usuarios LIMIT :offset, :limit";
                $stmt = $this->connection->prepare($query);
                $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
                $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
                $stmt->execute();
                return $stmt->fetchAll(PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
                error_log("Error al obtener usuarios paginados: " . $e->getMessage());
                return [];
            }
        }
        
        public function contarTotalUsuarios() {
            try {
                $query = "SELECT COUNT(*) FROM usuarios";
                $stmt = $this->connection->prepare($query);
                $stmt->execute();
                return $stmt->fetchColumn();
            } catch (PDOException $e) {
                error_log("Error al contar total de usuarios: " . $e->getMessage());
                return 0;
            }
        }
}