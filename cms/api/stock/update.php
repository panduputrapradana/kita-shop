<?php
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");

require_once "../../config/database.php";

$method = $_SERVER['REQUEST_METHOD'];

$table = 'stock';
$table2 = 'product';

if ($method == 'POST') {
    $product_id = $_POST['product_id'];
    $stock_status       = $_POST['stock_status']; // in / out
    $stock_qty        = (int)$_POST['stock_qty'];

    // ambil stok sekarang
    $q = $conn->query("SELECT product_stock FROM $table2 WHERE product_id=$product_id");
    $p = $q->fetch_assoc();
    $currentStock = (int)$p['product_stock'];

    if ($stock_status == 'out' && $stock_qty > $currentStock) {
        echo json_encode(["status" => false, "message" => "Stock tidak cukup"]);
        exit;
    }

    // hitung stok baru
    $newStock = ($stock_status == 'in')
        ? $currentStock + $stock_qty
        : $currentStock - $stock_qty;

    // update product
    $conn->query("UPDATE $table2 SET product_stock=$newStock WHERE product_id=$product_id");

    // simpan history
    $stmt = $conn->prepare("INSERT INTO $table(product_id,stock_status,stock_qty) VALUES(?,?,?)");
    $stmt->bind_param("isi", $product_id, $stock_status, $stock_qty);
    $stmt->execute();

    echo json_encode(["status" => true, "message" => "Stock berhasil diperbarui"]);
}
