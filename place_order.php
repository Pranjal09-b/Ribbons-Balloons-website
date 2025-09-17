<?php
$servername = "localhost";
$username = "root";  // default XAMPP user
$password = "";      // default XAMPP password is empty
$dbname = "cake_shop";

// Connect
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Get JSON from JS
$data = json_decode(file_get_contents("php://input"), true);

$name = $conn->real_escape_string($data["name"]);
$email = $conn->real_escape_string($data["email"]);
$phone = $conn->real_escape_string($data["phone"]);
$address = $conn->real_escape_string($data["address"]);
$payment = $conn->real_escape_string($data["payment"]);
$total = $conn->real_escape_string($data["total"]);
$items = $conn->real_escape_string(json_encode($data["items"]));

// Insert order
$sql = "INSERT INTO orders (name,email,phone,address,payment,total,items)
        VALUES ('$name','$email','$phone','$address','$payment','$total','$items')";

if ($conn->query($sql) === TRUE) {
  echo json_encode(["success" => true, "message" => "Order placed successfully!"]);
} else {
  echo json_encode(["success" => false, "message" => "Error: " . $conn->error]);
}

$conn->close();
?>