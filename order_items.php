<?php
include 'db.php';

$order_id = $_GET['id'] ?? 0;
$order_id = intval($order_id);

$sql = "SELECT p.name, oi.quantity, oi.price
        FROM order_items oi
        JOIN products p ON oi.product_id = p.id
        WHERE oi.order_id = $order_id";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Order #<?= $order_id ?> Items</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
<main class="container">
  <h1>Items in Order #<?= $order_id ?></h1>
  <table class="cart-table">
    <thead>
      <tr>
        <th>Product</th>
        <th>Quantity</th>
        <th>Price (₹)</th>
        <th>Subtotal (₹)</th>
      </tr>
    </thead>
    <tbody>
      <?php $total = 0; while ($row = $result->fetch_assoc()): 
        $subtotal = $row['price'] * $row['quantity'];
        $total += $subtotal;
      ?>
        <tr>
          <td><?= htmlspecialchars($row['name']) ?></td>
          <td><?= $row['quantity'] ?></td>
          <td><?= $row['price'] ?></td>
          <td><?= $subtotal ?></td>
        </tr>
      <?php endwhile; ?>
    </tbody>
    <tfoot>
      <tr>
        <td colspan="3"><strong>Total</strong></td>
        <td><strong><?= $total ?></strong></td>
      </tr>
    </tfoot>
  </table>
  <p><a href="orders.php">⬅ Back to Orders</a></p>
</main>
</body>
</html>