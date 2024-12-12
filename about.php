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

                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>

                <label for="message">Message:</label>
                <textarea id="message" name="message" rows="5" required></textarea>

                <button type="submit">Send Message</button>
            </form>
        </section>
    </main>

    <footer>
        <p>&copy; 2024 Jamit! Baskets. All rights reserved.</p>
    </footer>
</body>
</html>

<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $message = htmlspecialchars($_POST['message']);

    // Example: Save to database (requires a `contacts` table)
    try {
        $pdo = new PDO("mysql:host=localhost;dbname=final", "root", "");
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $query = "INSERT INTO contacts (name, email, message) VALUES (:name, :email, :message)";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':message', $message);
        $stmt->execute();

        echo "Thank you for reaching out! We will get back to you soon.";
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
