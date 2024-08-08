<?php
include 'db.php';

// Fetch bikes from the database
$stmt = $pdo->query("SELECT * FROM bikes");
$bikes = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PedalPulse - Bike Products</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f0f0f0;
            color: #333;
        }

        header {
            background-color: #004d40;
            color: #fff;
            padding: 1em;
            text-align: center;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        main {
            padding: 2em;
            max-width: 1200px;
            margin: 0 auto;
        }

        .bike-columns {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 20px;
        }

        .bike-link {
            background-color: #fff;
            border-radius: 10px;
            text-align: center;
            padding: 15px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.2s;
        }

        .bike-link:hover {
            transform: translateY(-10px);
        }

        .bike-link img {
            width: 100%;
            height: auto;
            border-radius: 10px;
            object-fit: cover;
        }

        .bike-link h2 {
            margin: 10px 0;
            font-size: 1.2em;
        }

        .bike-link p {
            color: #666;
            margin: 5px 0 15px;
        }

        .buy-buttons {
            display: flex;
            justify-content: center;
            gap: 10px;
        }

        .buy-buttons a {
            color: #fff;
            background-color: #00796b;
            padding: 10px 15px;
            border-radius: 5px;
            text-decoration: none;
            font-weight: bold;
            transition: background-color 0.3s;
        }

        .buy-buttons a:hover {
            background-color: #004d40;
        }

        footer {
            background-color: #004d40;
            color: #fff;
            padding: 1em;
            text-align: center;
            box-shadow: 0 -2px 4px rgba(0, 0, 0, 0.1);
            margin-top: 20px;
        }

        a {
            color: #00796b;
            text-decoration: none;
            font-weight: bold;
        }

        a:hover {
            color: #004d40;
        }

        .add-new-bike {
            display: inline-block;
            margin-bottom: 20px;
            padding: 10px 15px;
            background-color: #00796b;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        .add-new-bike:hover {
            background-color: #004d40;
        }
    </style>
</head>
<body>
<header>
    <h1>Bike Products</h1>
</header>

<main>
    <section>
        <a class="add-new-bike" href="create.php">Add New Bike</a>
        <div class="bike-columns">
            <?php foreach ($bikes as $bike): ?>
                <div class="bike-link">
                    <img src="<?php echo htmlspecialchars($bike['image']); ?>" alt="<?php echo htmlspecialchars($bike['name']); ?>">
                    <h2><?php echo htmlspecialchars($bike['name']); ?></h2>
                    <p>Price: $<?php echo htmlspecialchars(number_format($bike['price'], 2)); ?></p>
                    <div class="buy-buttons">
                        <a href="edit.php?id=<?php echo $bike['id']; ?>">Edit</a>
                        <a href="delete.php?id=<?php echo $bike['id']; ?>" onclick="return confirm('Are you sure?')">Delete</a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </section>
</main>

<footer>
    <p>&copy; 2024 PedalPulse</p>
</footer>
</body>
</html>
