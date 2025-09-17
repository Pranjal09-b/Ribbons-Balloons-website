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
?>

<!DOCTYPE html>
<html>
<head>
  <title>Your Cart</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
  <h2>Your Cart</h2>
  <table class="cart-table">
    <tr><th>Item</th><th>Price</th><th>Qty</th><th>Subtotal</th><th>Action</th></tr>
    <?php while($row = $result->fetch_assoc()): 
      $subtotal = $row["price"] * $row["quantity"];
      $total += $subtotal; ?>
      <tr>
        <td><?= $row["name"] ?></td>
        <td>₹<?= $row["price"] ?></td>
        <td><?= $row["quantity"] ?></td>
        <td>₹<?= $subtotal ?></td>
        <td><a href="remove_item.php?id=<?= $row['id'] ?>" class="btn danger">Remove</a></td>
      </tr>
    <?php endwhile; ?>
  </table>
  <div class="cart-summary">Total: ₹<?= $total ?></div>
  <a href="checkout.php" class="checkout-btn">Proceed to Checkout</a>
</div>
</body>
</html>