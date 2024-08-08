<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $price = $_POST['price'];
    $image = $_POST['image'];

    $stmt = $pdo->prepare("INSERT INTO bikes (name, price, image) VALUES (?, ?, ?)");
    $stmt->execute([$name, $price, $image]);

    header('Location: index.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Bike</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
            overflow: hidden; /* Hide overflow to ensure content is properly displayed */
            position: relative; /* Relative positioning for body */
            height: 100vh; /* Full viewport height */
            background-color: #f0f0f0; /* Optional: set a background color */
            background-image: url('create.jpg'); /* Background image */
            background-size: cover; /* Cover the entire viewport */
            background-position: center; /* Center the image */
            background-repeat: no-repeat; /* Do not repeat the image */
        }

        header {
            background-color: rgba(0, 77, 64, 0.7); /* Slightly transparent background */
            color: #fff;
            padding: 1em;
            text-align: center;
            position: relative;
            z-index: 2; /* Ensure header is above content */
        }

        main {
            padding: 2em;
            max-width: 600px;
            margin: 30px auto;
            background: rgba(255, 255, 255, 0.9); /* Slightly transparent background */
            border-radius: 10px;
            z-index: 2; /* Ensure form is above content */
            position: relative;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
            color: #333;
        }

        input {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
        }

        button {
            width: 100%;
            padding: 12px;
            border: none;
            border-radius: 4px;
            background-color: #00796b;
            color: #fff;
            font-size: 1em;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #004d40;
        }
    </style>
</head>
<body>
    <header>
        <h1>Add New Bike</h1>
    </header>

    <main>
        <form action="create.php" method="POST">
            <label for="name">Bike Name:</label>
            <input type="text" name="name" id="name" required>

            <label for="price">Price:</label>
            <input type="number" name="price" id="price" step="0.01" required>

            <label for="image">Image URL:</label>
            <input type="text" name="image" id="image" required>

            <button type="submit">Add Bike</button>
        </form>
    </main>
</body>
</html>
