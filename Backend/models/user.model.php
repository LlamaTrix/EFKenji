<?php
require_once(__DIR__ . '/../config/database.php');

class User {
    private $conn;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->GetConnection();
    }

    // Crear usuario
    public function create($name, $email, $username, $password) {
        $sql = "INSERT INTO t_user (name, email, username, password)
                VALUES (:name, :email, :username, :password)";
        $stmt = $this->conn->prepare($sql);

        // Hash de contraseña
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $stmt->bindValue(':name', $name);
        $stmt->bindValue(':email', $email);
        $stmt->bindValue(':username', $username);
        $stmt->bindValue(':password', $hashedPassword);

        return $stmt->execute();
    }

    // Buscar usuario por ID
    public function find($id) {
        $sql = "SELECT id, name, email, username FROM t_user WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Eliminar usuario
    public function delete($id) {
        $sql = "DELETE FROM t_user WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);

        return $stmt->execute();
    }
}
