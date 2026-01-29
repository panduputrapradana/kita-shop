<?php
require_once 'config/database.php';

session_start();

$username = $_POST['username'];
$password = md5($_POST['password']);

$query = mysqli_query(
    $conn,
    "SELECT * FROM user WHERE username='$username' AND password='$password'"
);

$data = mysqli_fetch_assoc($query);

if ($data) {
    $_SESSION['login'] = true;
    $_SESSION['user']  = $data['username'];
    $_SESSION['name']  = $data['name'];
    header("Location: cms/index.php");
} else {
    header("Location: login.php?error=1");
}
