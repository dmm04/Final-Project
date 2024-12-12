<html lang="en">
<head>
    <title>Store Page</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<div style="border: 2px solid transparent; background-color: #0056b3; text-align: center; padding: 50px; color: white;"> 
     <a href="index.php" style="display: inline-block; padding: 15px 30px; font-size: 1.2em; background-color: #ffcc00; color: #0056b3; text-decoration: none; border-radius: 5px;">Home</a>
     <a href="shop.php" style="display: inline-block; padding: 15px 30px; font-size: 1.2em; background-color: #ffcc00; color: #0056b3; text-decoration: none; border-radius: 5px;">Shop Now</a>
     <a href="about.php" style="display: inline-block; padding: 15px 30px; font-size: 1.2em; background-color: #ffcc00; color: #0056b3; text-decoration: none; border-radius: 5px;">About Us</a>
</div> 
    <section class="featured-products">
        <h2>Featured Baskets</h2>
        <div class="product-grid">
        <?php 
        // Connect to the database 
        $conn = new mysqli('localhost', 'dylan', 'dylan', 'final'); 
        // Check the connection if ($conn->connect_error) 
        { 
            die("Connection failed: " . $conn->connect_error);

        } 
        
        // Fetch products from the database 
        $sql = "SELECT id, name, price FROM products"; 
        $result = $conn->query($sql); 
        if ($result->num_rows > 0) { 
            while($row = $result->fetch_assoc()) { 
                echo '<div class="product-item">'; 
                echo '<h3>' . $row["name"] . '</h3>'; 
                echo '<p>$' . $row["price"] . '</p>'; 
                echo '<a href="add_to_cart.php?id=' . $row["id"] . '" class="button">Add to Cart</a>'; 
                echo '</div>'; 
                } 
            } else { 
                echo "No products available."; 
            } 
            $conn->close(); 
            ?> 
        </div> 
    </section>
            

</body>
</html>

<!--php for adding to cart-->
<?php
session_start();

// Database connection
$conn = new mysqli('localhost', 'dylan', 'dylan', 'final');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get product ID from URL
$product_id = intval($_GET['id']);

// Check if cart session exists
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = array();
}

// Add product to cart
if (!in_array($product_id, $_SESSION['cart'])) {
    $_SESSION['cart'][] = $product_id;
}

// Redirect back to store page
header('Location: store.php');
$conn->close();
exit();
?>

<!--php for removing from cart-->
<?php
session_start();

// Get product ID from URL
$product_id = intval($_GET['id']);

// Check if cart session exists
if (isset($_SESSION['cart'])) {
    // Remove product from cart
    if (($key = array_search($product_id, $_SESSION['cart'])) !== false) {
        unset($_SESSION['cart'][$key]);
    }
}

// Redirect back to store page
header('Location: store.php');
exit();
?>


<section class="cart">
    <h2>Your Cart</h2>
    <div class="cart-items">
        <?php
        if (isset($_SESSION['cart']) && count($_SESSION['cart']) > 0) {
            // Connect to the database
            $conn = new mysqli('localhost', 'dylan', 'dylan', 'final');

            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // Fetch cart items from the database
            $ids = implode(',', array_map('intval', $_SESSION['cart']));
            $sql = "SELECT id, name, price FROM products WHERE id IN ($ids)";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo '<div class="cart-item">';
                    echo '<h3>' . $row["name"] . '</h3>';
                    echo '<p>$' . $row["price"] . '</p>';
                    echo '<a href="remove_from_cart.php?id=' . $row["id"] . '" class="button">Remove</a>';
                    echo '</div>';
                }
            } else {
                echo "Your cart is empty.";
            }
            $conn->close();
        } else {
            echo "Your cart is empty.";
        }
        ?>
    </div>
</section>


