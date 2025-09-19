<?php
error_reporting(E_ALL);
ini_set('display_errors',1);
// Database connection
$conn = new mysqli("localhost", "root", "", "cake_shop");

// Check connection
if ($conn->connect_error) {
    die("DB Connection failed: " . $conn->connect_error);
}

// Get form data safely
$name     = $_POST['name'] ?? '';
$email    = $_POST['email'] ?? '';
$phone    = $_POST['phone'] ?? '';
$address  = $_POST['address'] ?? '';
$payment  = $_POST['payment'] ?? '';
$total    = $_POST['total'] ?? 0;

// Validate
if (empty($name) || empty($email) || empty($phone) || empty($address) || empty($payment)) {
    die("All fields are required");
}

// Insert order
$stmt = $conn->prepare("INSERT INTO orders (customer_name, email, phone, address, payment_method, total) VALUES (?, ?, ?, ?, ?, ?)");
$stmt->bind_param("sssssd", $name, $email, $phone, $address, $payment, $total);

if ($stmt->execute()) {
    $order_id = $stmt->insert_id;
    // Redirect to receipt page
    header("Location: receipt.php?order_id=" . $order_id);
    exit();
} else {
    die("Error: " . $stmt->error);
}

$stmt->close();
$conn->close();
?>
