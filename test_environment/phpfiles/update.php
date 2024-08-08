<?php
include 'db.php';

// Initialize message variables
$message = '';
$messageType = '';

// Fetch bike details if the ID is set
if (isset($_GET['id'])) {
    $id = intval($_GET['id']); // Convert ID to integer to avoid SQL injection
    $stmt = $pdo->prepare("SELECT * FROM bikes WHERE id = ?");
    $stmt->execute([$id]);
    $bike = $stmt->fetch(PDO::FETCH_ASSOC);

    // Check if the bike was found
    if (!$bike) {
        // Redirect to the index page if the bike is not found
        header('Location: index.php');
        exit;
    }
} else {
    // Redirect to the index page if no ID is provided
    header('Location: index.php');
    exit;
}

// Process the form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = intval($_POST['id']); // Convert ID to integer
    $name = trim($_POST['name']);
    $price = floatval($_POST['price']);
    $image = trim($_POST['image']);

    // Validate inputs
    if (empty($name) || $price <= 0 || empty($image)) {
        $message = 'Please fill in all fields correctly.';
        $messageType = 'error';
    } else {
        try {
            // Prepare the UPDATE statement
            $stmt = $pdo->prepare("UPDATE bikes SET name = ?, price = ?, image = ? WHERE id = ?");
            $stmt->execute([$name, $price, $image, $id]);

            // Set success message
            $message = 'Bike updated successfully.';
            $messageType = 'success';
        } catch (PDOException $e) {
            $message = 'Error: ' . $e->getMessage();
            $messageType = 'error';
        }
    }

    // Redirect with message
    header("Location: index.php?message=$messageType&msg=" . urlencode($message));
    exit;
}
?>
