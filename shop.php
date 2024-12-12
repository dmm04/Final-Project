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
    <title>Jamit! Baskets - Store</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<div style="border: 2px solid transparent; background-color: #0056b3; text-align: center; padding: 50px; color: white;"> 
     <a href="index.php" style="display: inline-block; padding: 15px 30px; font-size: 1.2em; background-color: #ffcc00; color: #0056b3; text-decoration: none; border-radius: 5px;">Home</a>
     <a href="shop.php" style="display: inline-block; padding: 15px 30px; font-size: 1.2em; background-color: #ffcc00; color: #0056b3; text-decoration: none; border-radius: 5px;">Shop Now</a>
     <a href="about.php" style="display: inline-block; padding: 15px 30px; font-size: 1.2em; background-color: #ffcc00; color: #0056b3; text-decoration: none; border-radius: 5px;">About Us</a>
    </div>
    <header class="store-header">
        <h1>Jamit! Baskets Store</h1>
        <nav>
            <a href="store.php">Home</a>
            <a href="cart.php">View Cart (<?php echo array_sum($_SESSION['cart']); ?>)</a>
        </nav>
    </header>
    <main>
        <section class="product-grid">
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "
                    <div class='product-card'>
                        <img src='" . $row['image'] . "' alt='" . $row['name'] . "' class='product-image'>
                        <h2 class='product-name'>" . $row['name'] . "</h2>
                        <p class='product-price'>$" . number_format($row['price'], 2) . "</p>
                        <form method='POST' action='store.php'>
                            <input type='hidden' name='product_id' value='" . $row['id'] . "'>
                            <button type='submit' name='add_to_cart' class='add-to-cart'>Add to Cart</button>
                        </form>
                    </div>";
                }
            } else {
                echo "<p>No products available.</p>";
            }
            ?>
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