<?php
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");

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

if ($method == 'POST' && isset($_POST['action']) && $_POST['action'] == 'toggle_status') {
    $id = $_POST['product_id'];

    // ambil status lama
    $q = $conn->query("SELECT product_status FROM product WHERE product_id=$id");
    $row = $q->fetch_assoc();

    $newStatus = ($row['product_status'] == 1) ? 0 : 1;

    // update
    $conn->query("UPDATE $table SET product_status=$newStatus WHERE product_id=$id");

    echo json_encode([
        "status" => true,
        "new_status" => $newStatus
    ]);
    exit;
}
