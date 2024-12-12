<?php
// Start session for cart functionality
session_start();

// Database connection
$host = 'localhost';
$dbname = 'final';
$username = 'root'; 
$password = 'mysql'; 

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}

// Fetch products from the database
$query = "SELECT * FROM products";
$stmt = $pdo->query($query);
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Add to cart functionality
if (isset($_POST['add_to_cart'])) {
    $productId = $_POST['product_id'];
    $productName = $_POST['product_name'];
    $productPrice = $_POST['product_price'];

    // Add product to session cart
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    // Check if the product is already in the cart
    $isInCart = false;
    foreach ($_SESSION['cart'] as &$cartItem) {
        if ($cartItem['id'] == $productId) {
            $cartItem['quantity'] += 1;
            $isInCart = true;
            break;
        }
    }

    // If not in cart, add it as a new item
    if (!$isInCart) {
        $_SESSION['cart'][] = [
            'id' => $productId,
            'name' => $productName,
            'price' => $productPrice,
            'quantity' => 1
        ];
    }

    // Redirect to prevent form resubmission
    header("Location: shop.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shop - Jamit! Baskets</title>
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
        <section class="shop">
            <h1>Shop Our Baskets</h1>
            <div class="products">
                <?php foreach ($products as $product): ?>
                    <div class="product">
                        <img src="<?= htmlspecialchars($product['image']) ?>" alt="<?= htmlspecialchars($product['name']) ?>">
                        <h3><?= htmlspecialchars($product['name']) ?></h3>
                        <p>$<?= number_format($product['price'], 2) ?></p>
                        <form method="POST">
                            <input type="hidden" name="product_id" value="<?= $product['id'] ?>">
                            <input type="hidden" name="product_name" value="<?= htmlspecialchars($product['name']) ?>">
                            <input type="hidden" name="product_price" value="<?= $product['price'] ?>">
                            <button type="submit" name="add_to_cart">Add to Cart</button>
                        </form>
                    </div>
                <?php endforeach; ?>
            </div>
        </section>
    </main>
</body>
</html>
