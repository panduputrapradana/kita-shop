<?php
session_start();

require_once './../config/database.php';

$product_id = (int)$_POST['product_id'];
$t_item_qty = (int)$_POST['t_item_qty'];

// ambil data produk
$q = $conn->query("SELECT * FROM product WHERE product_id=$product_id");
$p = $q->fetch_assoc();

// inisialisasi cart session
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// jika produk sudah ada di cart → tambah qty
if (isset($_SESSION['cart'][$product_id])) {
    $_SESSION['cart'][$product_id]['t_item_qty'] += $t_item_qty;
} else {
    $_SESSION['cart'][$product_id] = [
        "product_id" => $p['product_id'],
        "name" => $p['product_name'],
        "price" => $p['product_price'],
        "stock" => $p['product_stock'],
        "pict" => $p['product_pict'],
        "t_item_qty" => $t_item_qty
    ];
}

header("Location: ./../cart.php");
