<?php
require_once(__DIR__ . '/../models/user.model.php');
require(__DIR__.'/../config/security.php');
$decoded = validateJWT();

header("Content-Type: application/json");

$user = new User();
$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case 'POST': // Crear usuario
        if (isset($_GET['name'], $_GET['email'], $_GET['username'], $_GET['password'])) {
            $result = $user->create($_GET['name'], $_GET['email'], $_GET['username'], $_GET['password']);
            if ($result) {
                http_response_code(201);
                echo json_encode(["message" => "Usuario creado con éxito"]);
            } else {
                http_response_code(400);
                echo json_encode(["error" => "No se pudo crear el usuario"]);
            }
        } else {
            http_response_code(400);
            echo json_encode(["error" => "Faltan parámetros"]);
        }
        break;

    case 'GET': // Buscar usuario por id
        if (isset($_GET['id'])) {
            $result = $user->find($_GET['id']);
            if ($result) {
                echo json_encode($result);
            } else {
                http_response_code(404);
                echo json_encode(["error" => "Usuario no encontrado"]);
            }
        } else {
            http_response_code(400);
            echo json_encode(["error" => "Falta parámetro id"]);
        }
        break;

    case 'DELETE': // Eliminar usuario
        if (isset($_GET['id'])) {
            $result = $user->delete($_GET['id']);
            if ($result) {
                echo json_encode(["message" => "Usuario eliminado"]);
            } else {
                http_response_code(400);
                echo json_encode(["error" => "No se pudo eliminar"]);
            }
        } else {
            http_response_code(400);
            echo json_encode(["error" => "Falta parámetro id"]);
        }
        break;

    default:
        http_response_code(405);
        echo json_encode(["error" => "Método no permitido"]);
}
