
<?php
include 'db.php';

// Initialize message variables
$message = '';
$messageType = '';

if (isset($_GET['id'])) {
    $id = intval($_GET['id']); // Convert ID to integer to avoid SQL injection

    try {
        // Prepare the DELETE statement
        $stmt = $pdo->prepare("DELETE FROM bikes WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        // Execute the statement
        if ($stmt->execute()) {
            // Set success message
            $message = 'Bike deleted successfully.';
            $messageType = 'success';
        } else {
            // Set error message
            $message = 'Error deleting bike.';
            $messageType = 'error';
        }
    } catch (PDOException $e) {
        $message = 'Error: ' . $e->getMessage();
        $messageType = 'error';
    }
} else {
    $message = 'No bike ID provided.';
    $messageType = 'error';
}

// Redirect with message if set
if ($message) {
    header("Location: index.php?message=$messageType&msg=" . urlencode($message));
    exit();
}
?>