<?php
session_start();

// Database configuration
$servername = "localhost";
$username = "root"; 
$password = "mysql"; 
$dbname = "final";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Initialize the cart if not already set
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// Handle Add to Cart action
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_to_cart'])) {
    $product_id = intval($_POST['product_id']);
    if (isset($_SESSION['cart'][$product_id])) {
        $_SESSION['cart'][$product_id] += 1;
    } else {
        $_SESSION['cart'][$product_id] = 1;
    }
    echo "<p>Product added to cart successfully!</p>";
}

// Fetch products
$sql = "SELECT id, name, price, image FROM products";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jamit! Baskets - Cart</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header class="store-header">
        <h1>Your Cart</h1>
        <nav>
            <a href="shop.php">Continue Shopping</a>
        </nav>
    </header>
    <main>
        <section class="cart-section">
            <?php if (!empty($cart_items)): ?>
                <table>
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $grand_total = 0;
                        foreach ($cart_items as $product_id => $quantity):
                            $product = $product_list[$product_id];
                            $total = $product['price'] * $quantity;
                            $grand_total += $total;
                        ?>
                            <tr>
                                <td><?php echo $product['name']; ?></td>
                                <td>$<?php echo number_format($product['price'], 2); ?></td>
                                <td><?php echo $quantity; ?></td>
                                <td>$<?php echo number_format($total, 2); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <h3>Grand Total: $<?php echo number_format($grand_total, 2); ?></h3>
            <?php else: ?>
                <p>Your cart is empty.</p>
            <?php endif; ?>
        </section>
    </main>
    <footer class="store-footer">
        <p>&copy; 2024 Jamit! Baskets. All rights reserved.</p>
    </footer>
</body>
</html>

<?php
$conn->close();
?>