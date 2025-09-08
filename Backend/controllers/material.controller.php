<?php
require_once(__DIR__ . '/../models/material.model.php');

header("Content-Type: application/json");

$material = new Material();
$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case 'POST': // Crear material
        if (isset($_GET['id_course'], $_GET['id_user'], $_GET['title'], $_GET['description'] , $_GET['type'], $_GET['url'])) {
            $result = $material->create($_GET['id_course'], $_GET['id_user'], $_GET['title'], $_GET['description'], $_GET['type'], $_GET['url']);
            if ($result) {
                http_response_code(201);
                echo json_encode(["message" => "Material creado con éxito"]);
            } else {
                http_response_code(400);
                echo json_encode(["error" => "No se pudo crear el material"]);
            }
        } else {
            http_response_code(400);
            echo json_encode(["error" => "Faltan parámetros"]);
        }
        break;

    case 'GET': // Buscar material por id
        if (isset($_GET['id'])) {
            $result = $material->find($_GET['id']);
            if ($result) {
                echo json_encode($result);
            } else {
                http_response_code(404);
                echo json_encode(["error" => "Material no encontrado"]);
            }
        } else {
            http_response_code(400);
            echo json_encode(["error" => "Falta parámetro id"]);
        }
        break;

    case 'DELETE': // Eliminar material
        if (isset($_GET['id'])) {
            $result = $material->delete($_GET['id']);
            if ($result) {
                echo json_encode(["message" => "Material eliminado"]);
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
