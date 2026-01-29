<?php
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");

require_once "../../config/database.php";

$method = $_SERVER['REQUEST_METHOD'];

$table = 'product';


if ($method == 'POST' && isset($_POST['action']) && $_POST['action'] == 'delete') {

    $id = intval($_POST['product_id']);

    // Ambil nama file gambar dulu (untuk dihapus dari folder)
    $get = $conn->query("SELECT product_pict FROM $table WHERE product_id=$id");
    $row = $get->fetch_assoc();

    if ($row && !empty($row['product_pict'])) {
        $file = "../../../assets/uploads/" . $row['product_pict'];
        if (file_exists($file)) {
            unlink($file);
        }
    }

    // Hapus dari database
    $stmt = $conn->prepare("DELETE FROM $table WHERE product_id=?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        echo json_encode([
            "status" => true,
            "message" => "Product berhasil dihapus"
        ]);
    } else {
        echo json_encode([
            "status" => false,
            "message" => "Gagal menghapus product"
        ]);
    }
    exit;
}
