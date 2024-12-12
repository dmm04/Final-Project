<?php
session_start();

// Remove an item from the cart
if (isset($_POST['remove_item'])) {
    $productId = $_POST['product_id'];
    foreach ($_SESSION['cart'] as $key => $cartItem) {
        if ($cartItem['id'] == $productId) {
            unset($_SESSION['cart'][$key]);
            break;
        }
    }
    $_SESSION['cart'] = array_values($_SESSION['cart']); // Reindex array
    header("Location: cart.php");
    exit;
}

// Clear the cart
if (isset($_POST['clear_cart'])) {
    unset($_SESSION['cart']);
    header("Location: cart.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart - Jamit! Baskets</title>
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
        <section class="cart">
            <h1>Your Cart</h1>
            <?php if (isset($_SESSION['cart']) && count($_SESSION['cart']) > 0): ?>
                <table>
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Total</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($_SESSION['cart'] as $cartItem): ?>
                            <tr>
                                <td><?= htmlspecialchars($cartItem['name']) ?></td>
                                <td>$<?= number_format($cartItem['price'], 2) ?></td>
                                <td><?= $cartItem['quantity'] ?></td>
                                <td>$<?= number_format($cartItem['price'] * $cartItem['quantity'], 2) ?></td>
                                <td>
                                    <form method="POST">
                                        <input type="hidden" name="product_id" value="<?= $cartItem['id'] ?>">
                                        <button type="submit" name="remove_item">Remove</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <form method="POST" class="clear-cart">
                    <button type="submit" name="clear_cart">Clear Cart</button>
                </form>
            <?php else: ?>
                <p>Your cart is empty.</p>
            <?php endif; ?>
        </section>
    </main>
</body>
</html>
