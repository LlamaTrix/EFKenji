<?php
require_once(__DIR__ . '/../config/database.php');

class Material {
    private $conn;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->GetConnection();
    }

    // Crear usuario
    public function create($id_course, $id_user, $title, $description, $type, $url) {
        $sql = "INSERT INTO t_material (id_course, id_user, title, description, type, url)
                VALUES (:id_course, :id_user, :title, :description, :type, :url)";
        $stmt = $this->conn->prepare($sql);

        $stmt->bindValue(':id_course', $id_course);
        $stmt->bindValue(':id_user', $id_user);
        $stmt->bindValue(':title', $title);
        $stmt->bindValue(':description', $description);
        $stmt->bindValue(':type', $type);
        $stmt->bindValue(':url', $url);

        return $stmt->execute();
    }

    // Buscar usuario por ID
    public function find($id) {
        $sql = "SELECT * FROM t_material WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Eliminar usuario
    public function delete($id) {
        $sql = "DELETE FROM t_material WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);

        return $stmt->execute();
    }
}
