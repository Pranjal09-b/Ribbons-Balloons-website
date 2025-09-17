<?php
session_start();
$conn = mysqli_connect("localhost", "root", "", "cake_shop");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Check login
if (!isset($_SESSION['user_id'])) {
    die("❌ Please login first!");
}

$user_id = $_SESSION['user_id'];

// Fetch all orders for this user
$orders = mysqli_query($conn, "SELECT * FROM orders WHERE user_id='$user_id' ORDER BY created_at DESC");
?>

<!DOCTYPE html>
<html>
<head>
    <title>My Orders</title>
</head>
<body>
    <h2>📦 My Order History</h2>

    <?php if (mysqli_num_rows($orders) > 0) { ?>
        <?php while ($order = mysqli_fetch_assoc($orders)) { ?>
            <h3>🆔 Order ID: <?php echo $order['id']; ?></h3>
            <p>💰 Total: ₹<?php echo $order['total']; ?></p>
            <p>📦 Payment: <?php echo $order['payment_method']; ?></p>
            <p>🕒 Date: <?php echo $order['created_at']; ?></p>

            <table border="1" cellpadding="5" cellspacing="0">
                <tr>
                    <th>Product ID</th>
                    <th>Quantity</th>
                </tr>
                <?php
                $order_id = $order['id'];
                $items = mysqli_query($conn, "SELECT * FROM order_items WHERE order_id='$order_id'");
                while ($item = mysqli_fetch_assoc($items)) {
                    echo "<tr>
                            <td>{$item['product_id']}</td>
                            <td>{$item['quantity']}</td>
                          </tr>";
                }
                ?>
            </table>
            <hr>
        <?php } ?>
    <?php } else { ?>
        <p>No orders found!</p>
    <?php } ?>
</body>
</html>