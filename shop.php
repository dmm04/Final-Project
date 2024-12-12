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
        $conn = new mysqli('localhost', 'username', 'password', 'database'); 
        // Check the connection if ($conn->connect_error) { 
            die("Connection failed: " . $conn->connect_error);
        } 
        
        // Fetch products from the database 
        $sql = "SELECT id, name, price, image FROM products"; 
        $result = $conn->query($sql); 
        if ($result->num_rows > 0) { 
            while($row = $result->fetch_assoc()) { 
                echo '<div class="product-item">'; 
                echo '<img src="' . $row["image"] . '" alt="' . $row["name"] . '">'; 
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