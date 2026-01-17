<?php

$hostname = 'localhost';
$username = 'root';
$password = '';
$database = 'e-commerce';

$conn = mysqli_connect($hostname, $username, $password, $database);

if (!$conn) {
    die('Koneksi gagal: ' . mysqli_connect_error());
}
