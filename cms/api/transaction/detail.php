<?php
header("Content-Type: application/json");
require_once "../../config/database.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $id = $_POST['transaction_id'];

    // Ambil alamat transaksi
    $trx = $conn->query("SELECT transaction_address 
                         FROM `transaction` 
                         WHERE transaction_id='$id'");
    $trxData = $trx->fetch_assoc();

    // Ambil item produk
    $result = $conn->query("
        SELECT 
            p.product_name,
            p.product_price,
            t.t_item_qty,
            (p.product_price * t.t_item_qty) AS subtotal
        FROM t_item t
        JOIN product p ON t.product_id = p.product_id
        WHERE t.transaction_id = '$id'
    ");

    $items = [];
    while ($row = $result->fetch_assoc()) {
        $items[] = $row;
    }

    echo json_encode([
        "status" => true,
        "address" => $trxData['transaction_address'],
        "items" => $items
    ]);
}
