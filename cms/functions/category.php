<?php

require_once '../config/database.php';

$table = 'category';


function save($data)
{
    global $conn, $table;

    $category_name = $data['category_name'];
    $query = "INSERT INTO $table VALUES('', '$category_name')";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function read()
{
    global $conn, $table;

    $query = "SELECT * FROM $table ORDER BY category_id DESC";

    $result = mysqli_query($conn, $query);

    $rows = [];

    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }

    return $rows;
}

function edit($data)
{
    global $conn, $table;

    $category_id = $data['category_id'];
    $category_name = $data['category_name'];

    $query = "UPDATE $table 
              SET category_name = '$category_name'
              WHERE category_id = $category_id";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function delete($data)
{
    global $conn, $table;

    $category_id = $data['delete_category_id'];

    $query = "DELETE FROM $table WHERE category_id = $category_id";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}
