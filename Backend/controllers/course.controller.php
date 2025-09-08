<?php
require_once(__DIR__.'/../models/course.model.php');

header("Content-Type: application/json");

$course = new Course();
$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case 'POST': // Crear curso
        if (isset($_GET['title'], $_GET['description'], $_GET['portrait'])) {
            $result = $course->create($_GET['title'], $_GET['description'], $_GET['portrait']);
            if ($result) {
                http_response_code(201);
                echo json_encode(["message" => "Curso creado con éxito"]);
            } else {
                http_response_code(400);
                echo json_encode(["error" => "No se pudo crear el curso"]);
            }
        } else {
            http_response_code(400);
            echo json_encode(["error" => "Faltan parámetros"]);
        }
        break;

    case 'GET': // Buscar curso por id
        if (isset($_GET['id'])) {
            $result = $course->find($_GET['id']);
            if ($result) {
                echo json_encode($result);
            } else {
                http_response_code(404);
                echo json_encode(["error" => "Curso no encontrado"]);
            }
        } else {
            http_response_code(400);
            echo json_encode(["error" => "Falta parámetro id"]);
        }
        break;

    case 'DELETE': // Eliminar curso
        if (isset($_GET['id'])) {
            $result = $course->delete($_GET['id']);
            if ($result) {
                echo json_encode(["message" => "Curso eliminado"]);
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
