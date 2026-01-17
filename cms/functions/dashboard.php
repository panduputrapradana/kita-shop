<?php

require_once '../config/database.php';


function save($data)
{
    global $conn;

    $category_name = $data['category_name'];
    $query = "INSERT INTO category VALUES('', '$category_name')";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}
