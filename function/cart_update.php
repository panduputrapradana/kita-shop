<?php
session_start();

foreach ($_POST['t_item_qty'] as $id => $t_item_qty) {
    if (isset($_SESSION['cart'][$id])) {
        $_SESSION['cart'][$id]['t_item_qty'] = (int)$t_item_qty;
    }
}

header("Location: ./../cart.php");
