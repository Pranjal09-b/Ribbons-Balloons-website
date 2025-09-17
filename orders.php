<?php
session_start();
include 'db.php';

// (Optional) restrict access only for admin users
// if (!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] !== true) {
//     die("Access denied");
// }

// Fetch all orders
$sql = "SELECT o.id, u.username, o.total, o.payment_method, o.created_at
        FROM orders o
        JOIN users u ON o.user_id = u.id
        ORDER BY o.created_at DESC";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Admin — Orders</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
<header>
  <div class="container topbar">
    <div class="brand"><div class="logo">R&B</div><div>Ribbons & Balloons — Admin</div></div>
    <nav>
      <a href="orders.php" class="active">Orders</a>
      <a href="index.html">Shop</a>
    </nav>
  </div>
</header>

<main class="container">
  <h1>All Orders</h1>
  <table class="cart-table">
    <thead>
      <tr>
        <th>Order ID</th>
        <th>Customer</th>
        <th>Total (₹)</th>
        <th>Payment</th>
        <th>Date</th>
        <th>Items</th>
      </tr>
    </thead>
    <tbody>
      <?php while ($row = $result->fetch_assoc()): ?>
        <tr>
          <td><?= $row['id'] ?></td>
          <td><?= htmlspecialchars($row['username']) ?></td>
          <td><?= $row['total'] ?></td>
          <td><?= $row['payment_method'] ?></td>
          <td><?= $row['created_at'] ?></td>
          <td><a href="order_items.php?id=<?= $row['id'] ?>">View</a></td>
        </tr>
      <?php endwhile; ?>
    </tbody>
  </table>
</main>

<footer>
  <p>© <span id="year"></span> Ribbons & Balloons</p>
</footer>
<script>document.getElementById("year").textContent=new Date().getFullYear();</script>
</body>
</html>