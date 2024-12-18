<?php
include 'auth.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Protected Page</title>
</head>
<body>
    
    <a href="logout.php">Logout</a>
</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <title> Jamit! Baskets</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<div style="border: 2px solid transparent; background-color: #0056b3; text-align: center; padding: 50px; color: white;"> 
    <h1 style="font-size: 3em; margin-bottom: 20px;">Welcome to Jamit! Baskets</h1> 
    <p style="font-size: 1.5em; margin-bottom: 30px;">Explore our beautifully handcrafted baskets designed with care and creativity. Find the perfect basket for any occasion.</p> 
    <a href="shop.php" style="display: inline-block; padding: 15px 30px; font-size: 1.2em; background-color: #ffcc00; color: #0056b3; text-decoration: none; border-radius: 5px;">Shop Now</a>
    <a href="about.php" style="display: inline-block; padding: 15px 30px; font-size: 1.2em; background-color: #ffcc00; color: #0056b3; text-decoration: none; border-radius: 5px;">About Us</a>    
</div>
     
    <img src = "images/logo.jpg" alt="Our Logo" style="justify-content: center; display: block; margin: auto; ">

    <!--Featured Products-->
    <section class="featured-products">
        <h2>Featured Baskets</h2>
        <div class="product-grid">
            <div class="product-item">
                <img src="images/basket1.jpg" alt ="Featured Basket 1"> 
                <h3>Antler Rib Greys</h3>
                <p>$25.00</p>
                <a href="shop.php" class="button"> View Details </a>
            </div>
            <div class="product-item">
                <img src="images/basket2.jpg" alt ="Featured Basket 1">
                <h3>Oval Woodbase</h3>
                <p>$30.00</p>
                <a href="shop.php" class="button"> View Details </a>
            </div>
            <div class="product-item">
                <img src="images/basket3.jpg" alt ="Featured Basket 1">
                <h3>Blacksmith</h3>
                <p>$35.00</p>
                <a href="shop.php" class="button"> View Details </a>
            </div>
        </div>
    </section>

    <!-- Testimonials -->
    <section class="testimonials">
        <h2>What Our Customers Say</h2>
        <div class="testimonials-grid">
            <div class="testimonial-item">
                <p>"The baskets are beautifully crafted and perfect for gifting!"</p>
                <p> - Sarah J.</p>
            </div>
            <div class="testimonial-item">
                <p>"Excellent quality and speedy delivery. Highly recommend!"</p>
                <p> - Michael T.</p>
            </div>
        </div>
    </section>

    <!--Footer-->
    <footer>
        <p>&copy; 2024 Jamit Baskets. All rights reserved. </p>
    </footer>
</body>
</html>
    

            