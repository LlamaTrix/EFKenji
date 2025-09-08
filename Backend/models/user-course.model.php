<?php
require_once(__DIR__ . '/../config/database.php');

class UserCourse {
    private $conn;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->GetConnection();
    }

    // Crear user-curso
    public function create($id_user, $id_course) {
        $sql = "INSERT INTO t_user_course (id_user, id_course)
                VALUES (:id_user, :id_course)";
        $stmt = $this->conn->prepare($sql);

        $stmt->bindValue(':id_user', $id_user);
        $stmt->bindValue(':id_course', $id_course);

        return $stmt->execute();
    }

    // Buscar user-curso por ID
    public function find($id) {
        $sql = "SELECT * FROM t_user_course WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }


    // Eliminar user-curso
    public function delete($id) {
        $sql = "DELETE FROM t_user_course WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);

        return $stmt->execute();
    }
}
