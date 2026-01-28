<?php

require_once './config/database.php';


function track($transaction_id)
{
    global $conn;

    $query = "SELECT * FROM t_item
              JOIN `transaction` ON t_item.transaction_id = `transaction`.transaction_id
              JOIN product ON t_item.product_id = product.product_id
              WHERE t_item.transaction_id = '$transaction_id' 
              ORDER BY t_item.t_item_id ASC";

    $result = mysqli_query($conn, $query);

    $rows = [];

    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }

    return $rows;
}

function track2($transaction_id)
{
    global $conn;

    $query = "SELECT transaction_id, transaction_status, transaction_total 
              FROM `transaction`
              WHERE transaction_id = '$transaction_id'
              LIMIT 1";

    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        return mysqli_fetch_assoc($result);
    }

    return null;
}
