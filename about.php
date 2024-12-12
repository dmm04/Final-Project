<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - Jamit! Baskets</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <nav>
            <a href="index.php">Home</a>
            <a href="about.php">About</a>
            <a href="shop.php">Shop</a>
            <a href="cart.php">Cart</a>
        </nav>
    </header>

    <main>
        <!-- About Section -->
        <section class="about">
            <h1>About Jamit! Baskets</h1>
            <p>At Jamit! Baskets, we are passionate about creating handmade, high-quality baskets for every occasion. Whether you're looking for a gift, home decor, or a functional piece, our baskets are designed to combine beauty and utility.</p>
            <p>Founded in 2024, we have been crafting baskets with love and care, ensuring every piece is unique and durable. Our mission is to bring joy and charm into your homes with our carefully curated collection.</p>
        </section>

        <!-- Contact Section -->
        <section class="contact">
            <h2>Contact Us</h2>
            <p>If you have any questions, comments, or custom requests, we'd love to hear from you!</p>
            <form action="contact-handler.php" method="POST" class="contact-form">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" required>