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
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Bike</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-image: url('edit.jpg'); /* Background image */
            background-size: cover; /* Cover the entire viewport */
            background-position: center; /* Center the image */
            background-repeat: no-repeat; /* Do not repeat the image */
            margin: 0;
            padding: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            max-width: 600px;
            width: 100%;
            padding: 20px;
            background-color: rgba(255, 255, 255, 0.9); /* Slightly transparent background */
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }
        h1 {
            color: #333;
            text-align: center;
            margin-bottom: 20px;
        }
        .message {
            padding: 10px;
            margin-bottom: 20px;
            border-radius: 5px;
            text-align: center;
        }
        .success {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }
        .error {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }
        form p {
            margin-bottom: 15px;
        }
        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
            color: #555;
        }
        input[type="text"] {
            width: 100%;
            padding: 10px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 16px;
        }
        input[type="submit"] {
            background-color: #28a745;
            color: #fff;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            border-radius: 4px;
            font-size: 16px;
        }
        input[type="submit"]:hover {
            background-color: #218838;
        }
    </style>
</head>
<body>
    <div class="container">
        <?php if ($messageType && $message): ?>
            <p class="message <?php echo $messageType; ?>"><?php echo $message; ?></p>
        <?php endif; ?>

        <h1>Edit Bike</h1>
        <form action="edit.php?id=<?php echo $bike['id']; ?>" method="post">
            <input type="hidden" name="id" value="<?php echo $bike['id']; ?>">
            <p>
                <label for="name">Name:</label>
                <input type="text" name="name" id="name" value="<?php echo htmlspecialchars($bike['name']); ?>">
            </p>
            <p>
                <label for="price">Price:</label>
                <input type="text" name="price" id="price" value="<?php echo htmlspecialchars($bike['price']); ?>">
            </p>
            <p>
                <label for="image">Image URL:</label>
                <input type="text" name="image" id="image" value="<?php echo htmlspecialchars($bike['image']); ?>">
            </p>
            <p>
                <input type="submit" value="Update Bike">
            </p>
        </form>
    </div>
</body>
</html>
