<?php
session_start();

require_once './../config/database.php';

$transaction_name    = $_POST['transaction_name'];
$transaction_address = $_POST['transaction_address'];
$transaction_phone = $_POST['transaction_phone'];
$transaction_email = $_POST['transaction_email'];

$cart = $_SESSION['cart'];

// hitung total
$total = 0;
foreach ($cart as $item) {
    $total += $item['price'] * $item['t_item_qty'];
}

// generate kode transaksi
$trx_code = "KTS" . date("YmdHis") . rand(100, 999);

$status = "Diproses";

// simpan transaksi
$stmt = $conn->prepare("INSERT INTO `transaction` 
(transaction_id, transaction_name, transaction_address, transaction_phone, transaction_email, transaction_status, transaction_total)
VALUES (?,?,?,?,?,?,?)");
$stmt->bind_param("sssissi", $trx_code, $transaction_name, $transaction_address, $transaction_phone, $transaction_email, $status, $total);
$stmt->execute();

$transaction_id = $trx_code;

// simpan item detail
$stmtItem = $conn->prepare("INSERT INTO t_item 
(transaction_id, product_id, t_item_qty, sub_total) VALUES (?,?,?,?)");

foreach ($cart as $item) {
    $sub_total = $item['price'] * $item['t_item_qty'];

    $stmtItem->bind_param(
        "siii",
        $transaction_id,
        $item['product_id'],
        $item['t_item_qty'],
        $sub_total
    );
    $stmtItem->execute();

    // kurangi stok produk
    $conn->query("UPDATE product 
                  SET product_stock = product_stock - {$item['t_item_qty']}
                  WHERE product_id = {$item['product_id']}");
}

// kosongkan cart
unset($_SESSION['cart']);

// tampilkan alert kode transaksi
echo "
<script>
alert('Pesanan berhasil! Kode Transaksi Anda: $trx_code');
window.location='./../index.php';
</script>
";
