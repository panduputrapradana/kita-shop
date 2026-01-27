<?php

require_once './config/database.php';


function read()
{
    global $conn;

    $query = "SELECT product_id, product_name, product_pict, product_description, product_category, product_price, category_name FROM product JOIN category ON product.product_category = category.category_id WHERE product_status = 1 ORDER BY product_id DESC LIMIT 8";

    $result = mysqli_query($conn, $query);

    $rows = [];

    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }

    return $rows;
}
