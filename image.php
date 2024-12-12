<?php
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

// Fetch and serve image
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Query to fetch image data
    $query = "SELECT image FROM products WHERE id = :id";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($result) {
        // Set the appropriate header
        header("Content-Type: image/jpeg"); // Adjust content type for your image format
        echo $result['image'];
        exit;
    }
}

// Return a 404 image or placeholder if the image is not found
header("Content-Type: image/jpeg");
readfile('images/placeholder.jpg'); // Ensure you have a placeholder image in the images folder
?>
