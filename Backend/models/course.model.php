<?php
require_once(__DIR__ . '/../config/database.php');

class Course {
    private $conn;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->GetConnection();
    }

    // Crear curso
    public function create($title, $description, $portrait) {
        $sql = "INSERT INTO t_course (title, description, portrait)
                VALUES (:title, :description, :portrait)";
        $stmt = $this->conn->prepare($sql);

        $stmt->bindValue(':title', $title);
        $stmt->bindValue(':description', $description);
        $stmt->bindValue(':portrait', $portrait);

        return $stmt->execute();
    }

    // Buscar curso por ID
    public function find($id) {
        $sql = "SELECT * FROM t_course WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }


    // Eliminar curso
    public function delete($id) {
        $sql = "DELETE FROM t_course WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);

        return $stmt->execute();
    }
}
