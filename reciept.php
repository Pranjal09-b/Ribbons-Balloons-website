<?php
$conn = new mysqli("localhost", "root", "", "cake_shop");

if ($conn->connect_error) {
    die("DB Connection failed: " . $conn->connect_error);
}

$order_id = $_GET['order_id'] ?? 0;

$sql = "SELECT * FROM orders WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $order_id);
$stmt->execute();
$result = $stmt->get_result();
$order = $result->fetch_assoc();

if (!$order) {
    die("Invalid Order ID");
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Order Receipt</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 50px; }
        .receipt-box { border: 2px solid #6c63ff; padding: 20px; border-radius: 10px; width: 500px; margin: auto; }
        h2 { text-align: center; color: #6c63ff; }
        p { font-size: 16px; }
    </style>
</head>
<body>
    <div class="receipt-box">
        <h2>Order Receipt</h2>
        <p><b>Order ID:</b> <?php echo $order['id']; ?></p>
        <p><b>Name:</b> <?php echo $order['customer_name']; ?></p>
        <p><b>Email:</b> <?php echo $order['email']; ?></p>
        <p><b>Phone:</b> <?php echo $order['phone']; ?></p>
        <p><b>Address:</b> <?php echo $order['address']; ?></p>
        <p><b>Payment Method:</b> <?php echo $order['payment_method']; ?></p>
        <p><b>Total Amount:</b> ₹<?php echo $order['total']; ?></p>
        <hr>
        <p style="text-align:center;">Thank you for your order! 🎂</p>
    </div>
</body>
</html>
