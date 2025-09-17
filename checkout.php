<?php
session_start();
include 'db.php';

$user_id = $_SESSION["user_id"];
$sql = "SELECT c.id, p.name, p.price, c.quantity 
        FROM cart c 
        JOIN products p ON c.product_id = p.id 
        WHERE c.user_id='$user_id'";
$result = $conn->query($sql);

$total = 0;
while($row = $result->fetch_assoc()) {
    $total += $row["price"] * $row["quantity"];
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Checkout</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
  <h2>Checkout</h2>
  <p><strong>Total: ₹<?= $total ?></strong></p>
  <form method="post" action="place_order.php">
    <label>Choose Payment Method:</label><br>
    <input type="radio" name="payment" value="COD" required> Cash on Delivery <br>
    <input type="radio" name="payment" value="UPI"> UPI <br>
    <input type="radio" name="payment" value="Card"> Debit/Credit Card <br>
    <br>
    <button type="submit" class="btn primary">Confirm Order</button>
  </form>
</div>
</body>
</html>