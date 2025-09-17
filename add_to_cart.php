<?php
session_start();
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_SESSION["user_id"];
    $product_id = $_POST["product_id"];
    $quantity = $_POST["quantity"];

    // Check if already in cart
    $check = "SELECT * FROM cart WHERE user_id='$user_id' AND product_id='$product_id'";
    $res = $conn->query($check);

    if ($res->num_rows > 0) {
        $conn->query("UPDATE cart SET quantity = quantity + $quantity WHERE user_id='$user_id' AND product_id='$product_id'");
    } else {
        $conn->query("INSERT INTO cart (user_id, product_id, quantity) VALUES ('$user_id','$product_id','$quantity')");
    }
    header("Location: cart.php");
}
?>