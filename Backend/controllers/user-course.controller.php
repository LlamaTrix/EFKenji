<?php
require_once(__DIR__.'/../models/user-course.model.php');

header("Content-Type: application/json");

$usercourse = new UserCourse();
$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case 'POST': // Crear usuario-curso
        if (isset($_GET['id_user'], $_GET['id_course'])) {
            $result = $usercourse->create($_GET['id_user'], $_GET['id_course']);
            if ($result) {
                http_response_code(201);
                echo json_encode(["message" => "Curso creado con éxito"]);
            } else {
                http_response_code(400);
                echo json_encode(["error" => "No se pudo crear el usuario-curso"]);
            }
        } else {
            http_response_code(400);
            echo json_encode(["error" => "Faltan parámetros"]);
        }
        break;

    case 'GET': // Buscar usuario-curso por id
        if (isset($_GET['id'])) {
            $result = $usercourse->find($_GET['id']);
            if ($result) {
                echo json_encode($result);
            } else {
                http_response_code(404);
                echo json_encode(["error" => "usuario-curso no encontrado"]);
            }
        } else {
            http_response_code(400);
            echo json_encode(["error" => "Falta parámetro id"]);
        }
        break;

    case 'DELETE': // Eliminar usuario-curso
        if (isset($_GET['id'])) {
            $result = $usercourse->delete($_GET['id']);
            if ($result) {
                echo json_encode(["message" => "usuario-curso eliminado"]);
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
