<?php
$host = "localhost";
$user = "root";
$pass = "";          // default XAMPP MySQL has empty root password
$dbname = "cake_shop";

$conn = new mysqli($host, $user, $pass, $dbname);
if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}
?>