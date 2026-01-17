<?php
header("Content-Type: application/json");
require_once '../functions/category.php';

$method = $_SERVER['REQUEST_METHOD'];

if ($method == 'GET') {
    echo json_encode(read());
    exit;
}

if ($method == 'POST') {
    $data = json_decode(file_get_contents("php://input"), true);
    $result = save($data['category_name']);
    echo json_encode(["success" => $result > 0]);
    exit;
}

if ($method == 'PUT') {
    $data = json_decode(file_get_contents("php://input"), true);
    $result = edit($data['category_id'], $data['category_name']);
    echo json_encode(["success" => $result > 0]);
    exit;
}

if ($method == 'DELETE') {
    $data = json_decode(file_get_contents("php://input"), true);
    $result = delete($data['category_id']);
    echo json_encode(["success" => $result > 0]);
    exit;
}
