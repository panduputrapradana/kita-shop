<?php
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");

require_once "../../config/database.php";

$method = $_SERVER['REQUEST_METHOD'];

$table = 'product';

if ($method == 'GET') {
    $result = $conn->query("SELECT product_id, product_name, product_category, product_price, product_stock, product_status, category_name 
    FROM $table
    JOIN category ON $table.product_category = category.category_id
    ORDER BY product_id DESC");

    $data = [];
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }

    echo json_encode([
        "status" => true,
        "data" => $data
    ]);
}
