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