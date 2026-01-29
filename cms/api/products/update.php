<?php
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");

require_once "../../config/database.php";

$method = $_SERVER['REQUEST_METHOD'];

$table = 'product';


// Get Edit
if ($method == 'GET' && isset($_GET['id'])) {
    $id = $_GET['id'];
    $result = $conn->query("SELECT * FROM $table WHERE product_id=$id");
    $row = $result->fetch_assoc();

    echo json_encode([
        "status" => true,
        "data" => $row
    ]);
    exit;
}


// Update
if ($method == 'POST' && $_POST['action'] == 'update') {

    $id     = $_POST['product_id'];
    $name   = $_POST['product_name'];
    $desc   = $_POST['product_description'];
    $cat    = $_POST['product_category'];
    $subcat = !empty($_POST['product_sub_category'])
        ? (int)$_POST['product_sub_category']
        : NULL;
    $price  = $_POST['product_price'];
    $stock = $_POST['product_stock'];

    // Jika tidak upload gambar baru
    if ($_FILES['product_pict']['name'] == "") {
        $sql = "UPDATE product SET 
        product_name=?,
        product_description=?,
        product_category=?,
        product_sub_category=?,
        product_price=?,
        product_stock=?
        WHERE product_id=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssiiiii", $name, $desc, $cat, $subcat, $price, $stock, $id);
    } else {
        // upload baru
        $image = time() . "_" . $_FILES['product_pict']['name'];
        move_uploaded_file($_FILES['product_pict']['tmp_name'], "../../../assets/uploads/" . $image);

        $sql = "UPDATE product SET 
        product_name=?,
        product_pict=?,
        product_description=?,
        product_category=?,
        product_sub_category=?,
        product_price=?,
        product_stock=?
        WHERE product_id=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssiiiii", $name, $image, $desc, $cat, $subcat, $price, $stock, $id);
    }

    if ($stmt->execute()) {
        echo json_encode(["status" => true, "message" => "Product berhasil diupdate"]);
    } else {
        echo json_encode(["status" => false, "message" => "Update gagal"]);
    }
    exit;
}
