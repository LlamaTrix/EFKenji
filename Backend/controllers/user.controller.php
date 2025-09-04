<?php
require_once('../config/database.php');
    class User{
        public static function create_user($name, $email, $username, $password){
            $database = new Database();
            $conn = $database->GetConnection();

            $stmt = $conn->prepare('INSERT INTO t_user(name,email,username,password)
                VALUES(:name, :email, :username, :password)');
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':username', $username);
            $stmt->bindParam(':password', $password);

            if ($stmt->execute()) {
                header('HTTP/1.1 201 User creado con exito.');
            } else {
                header('HTTP/1.1 400 No se ha podido crear el usuario.');
            }
        }
    }