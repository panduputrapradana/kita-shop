<?php

require_once './config/database.php';


function read($keyword)
{
    global $conn;

    $query = "SELECT product_id, product_name, product_pict, product_description, product_category, product_price, category_name 
              FROM product 
              JOIN category ON product.product_category = category.category_id 
              WHERE product_status = 1 AND product_name LIKE '%$keyword%' OR category_name LIKE '%$keyword%' OR product_description LIKE '%$keyword%'
              ORDER BY product_id DESC";

    $result = mysqli_query($conn, $query);

    $rows = [];

    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }

    return $rows;
}

function other()
{
    global $conn;

    $query = "SELECT product_id, product_name, product_pict, product_description, product_category, product_price, category_name FROM product JOIN category ON product.product_category = category.category_id WHERE product_status = 1 ORDER BY product_id DESC LIMIT 3";

    $result = mysqli_query($conn, $query);

    $rows = [];

    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }

    return $rows;
}

function category()
{
    global $conn;

    $query = "SELECT c.category_id, c.category_name, COUNT(p.product_id) AS total_product
              FROM category c
              LEFT JOIN product p ON p.product_category = c.category_id
              GROUP BY c.category_id, c.category_name
              ORDER BY c.category_name ASC";

    $result = mysqli_query($conn, $query);

    $rows = [];

    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }

    return $rows;
}
