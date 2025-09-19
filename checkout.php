<?php
// Database connection
$conn = new mysqli("localhost", "root", "", "cake_shop");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get form data
$name = $_POST['customer_name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$address = $_POST['address'];
$payment = $_POST['payment_method'];
$total = $_POST['total_amount'];  // from hidden input in checkout.html

// Insert order (no total_amount, use total)
$sql = "INSERT INTO orders (customer_name, email, phone, address, payment_method, total) 
        VALUES ('$name', '$email', '$phone', '$address', '$payment', '$total')";

if ($conn->query($sql) === TRUE) {
    $order_id = $conn->insert_id; // last inserted order ID
} else {
    die("Error placing order: " . $conn->error);
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Order Receipt</title>
  <style>
    body { font-family: Arial; background: #f4f4f4; padding: 20px; }
    .receipt { background: #fff; padding: 20px; border-radius: 8px; max-width: 500px; margin:auto; }
    h2 { color: purple; }
    .details p { margin: 5px 0; }
    .thankyou { margin-top: 15px; font-size: 18px; font-weight: bold; color: green; }
    .back-btn {
      margin-top: 20px; display: inline-block; padding: 10px 15px;
      background: purple; color: #fff; text-decoration: none; border-radius: 5px;
    }
  </style>
</head>
<body>
  <div class="receipt">
    <h2>Order Receipt</h2>
    <p><strong>Order ID:</strong> <?php echo $order_id; ?></p>
    <p><strong>Name:</strong> <?php echo $name; ?></p>
    <p><strong>Email:</strong> <?php echo $email; ?></p>
    <p><strong>Phone:</strong> <?php echo $phone; ?></p>
    <p><strong>Address:</strong> <?php echo $address; ?></p>
    <p><strong>Payment:</strong> <?php echo $payment; ?></p>
    <p><strong>Total:</strong> ₹<?php echo $total; ?></p>

    <p class="thankyou">🎉 Your order has been placed successfully!</p>
    <a href="index.html" class="back-btn">Back to Home</a>
  </div>
</body>
</html>
