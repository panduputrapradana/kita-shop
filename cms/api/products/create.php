<?php
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");

require_once "../../config/database.php";

$method = $_SERVER['REQUEST_METHOD'];

$table = 'product';


if ($method == 'POST') {

    $name   = $_POST['product_name'];
    $desc   = $_POST['product_description'];
    $cat    = $_POST['product_category'];
    $subcat = !empty($_POST['product_sub_category'])
        ? (int)$_POST['product_sub_category']
        : NULL;
    $price  = $_POST['product_price'];
    $stock  = $_POST['product_stock'];
    $status = 1;

    // Validasi sederhana
    if (empty($name) || empty($cat) || empty($price) || empty($stock)) {
        echo json_encode([
            "status" => false,
            "message" => "Field wajib belum diisi"
        ]);
        exit;
    }

    // ==== Upload gambar ====
    $imageName = "";
    if (isset($_FILES['product_pict'])) {
        $file = $_FILES['product_pict'];
        $ext  = pathinfo($file['name'], PATHINFO_EXTENSION);
        $imageName = time() . "_" . rand() . "." . $ext;
        move_uploaded_file($file['tmp_name'], "../../../assets/uploads/" . $imageName);
    }

    // ==== Simpan ke DB ====
    $stmt = $conn->prepare("INSERT INTO product 
        (product_name, product_pict, product_description, product_category, product_sub_category, product_price, product_stock, product_status)
        VALUES (?,?,?,?,?,?,?,?)
    ");

    $stmt->bind_param("sssiiiii", $name, $imageName, $desc, $cat, $subcat, $price, $stock, $status);

    if ($stmt->execute()) {
        echo json_encode([
            "status" => true,
            "message" => "Product berhasil ditambahkan"
        ]);
    } else {
        echo json_encode([
            "status" => false,
            "message" => "Gagal menyimpan product"
        ]);
    }
}
