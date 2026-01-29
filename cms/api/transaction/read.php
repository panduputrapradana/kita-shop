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

$table = 'transaction';

if ($method == 'GET') {
    $result = $conn->query("SELECT *
    FROM $table
    ORDER BY created_at DESC");

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
    $id = $_POST['transaction_id'];

    // ambil status lama
    $q = $conn->query("SELECT transaction_status FROM `transaction` WHERE transaction_id='$id'");
    $row = $q->fetch_assoc();

    $newStatus = ($row['transaction_status'] == 'Diproses') ? 'Selesai' : 'Diproses';

    // update
    $conn->query("UPDATE `transaction` SET transaction_status='$newStatus' WHERE transaction_id='$id'");

    echo json_encode([
        "status" => true,
        "new_status" => $newStatus
    ]);
    exit;
}
