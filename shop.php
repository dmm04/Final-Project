

<?php
// Database connection
$host = 'localhost';
$username = 'root';
$password = 'mysql'; 
$database = 'final';

// Connect to the database
$conn = new mysqli($host, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch products from the database
$sql = "SELECT id, name, price, image FROM products";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jamit! Baskets - Shop</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<div style="border: 2px solid transparent; background-color: #0056b3; text-align: center; padding: 50px; color: white;"> 
     <a href="index.php" style="display: inline-block; padding: 15px 30px; font-size: 1.2em; background-color: #ffcc00; color: #0056b3; text-decoration: none; border-radius: 5px;">Home</a>
     <a href="shop.php" style="display: inline-block; padding: 15px 30px; font-size: 1.2em; background-color: #ffcc00; color: #0056b3; text-decoration: none; border-radius: 5px;">Shop Now</a>
     <a href="about.php" style="display: inline-block; padding: 15px 30px; font-size: 1.2em; background-color: #ffcc00; color: #0056b3; text-decoration: none; border-radius: 5px;">About Us</a>
</div> 

    <main>
        <section class="store">
            <h1>Our Products</h1>
            <div class="product-grid">
                <?php
                if ($result->num_rows > 0) {
                    // Output each product
                    while ($row = $result->fetch_assoc()) {
                        echo "<div class='product-item'>";
                        echo "<img src='" . htmlspecialchars($row['image']) . "' alt='" . htmlspecialchars($row['name']) . "'>";
                        echo "<h3>" . htmlspecialchars($row['name']) . "</h3>";
                        echo "<p>$" . htmlspecialchars($row['price']) . "</p>";
                        echo "<a href='#' class='button'>Add to Cart</a>";
                        echo "</div>";
                    }
                } else {
                    echo "<p>No products available at the moment. Please check back later.</p>";
                }
                ?>
            </div>
        </section>
    </main>

    <footer>
        <p>&copy; 2024 Jamit! Baskets. All rights reserved.</p>
    </footer>
</body>
</html>

<?php
// Close the database connection
$conn->close();
?>
