<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit;
}

require_once __DIR__ . "/../../config/database.php";

$method = $_SERVER['REQUEST_METHOD'];

$table = 'stock';

if ($method == 'GET') {
    $result = $conn->query("SELECT s.product_id, p.product_name, s.stock_status, s.stock_qty, s.stock_created_at
    FROM `$table` s
    JOIN `product` p ON s.product_id = p.product_id
    ORDER BY stock_created_at DESC");

    $data = [];
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }

    echo json_encode([
        "status" => true,
        "data" => $data
    ]);
}
