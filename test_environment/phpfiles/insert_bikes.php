<?php
include 'db.php';

// Sample data for 12 bikes
$bikes = [
    ['name' => 'Mountain Bike Alpha', 'price' => 1200.00, 'image' => "images/alpha.jpg"],
    ['name' => 'Mountain Bike Beta', 'price' => 1300.00, 'image' => "images/beta.jpg"],
    ['name' => 'Mountain Bike Gamma', 'price' => 1400.00, 'image' => "images/gamma.jpg"],
    ['name' => 'Road Bike Alpha', 'price' => 1000.00, 'image' => "images/road-alpha.jpg"],
    ['name' => 'Road Bike Beta', 'price' => 1100.00, 'image' => "images/roadbeta.jpeg"],
    ['name' => 'Road Bike Gamma', 'price' => 1200.00, 'image' => "images/roadgamma.jpg"],
    ['name' => 'E-Bike Alpha', 'price' => 1500.00, 'image' => "images/ebike-alpha.jpg"],
    ['name' => 'E-Bike Beta', 'price' => 1600.00, 'image' => "images/e-bikebeta.jpg"],
    ['name' => 'E-Bike Gamma', 'price' => 1700.00, 'image' => "images/e-bikegamma.jpg"],
    ['name' => 'Gravel Bike Alpha', 'price' => 1300.00, 'image' => "images/gravelalpha.jpg"],
    ['name' => 'Gravel Bike Beta', 'price' => 1400.00, 'image' => "images/gravelbeta.jpg"],
    ['name' => 'Gravel Bike Gamma', 'price' => 1500.00, 'image' => "images/gravelgamma.jpg"],
];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bikes for Sale</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        h1 {
            text-align: center;
            margin-top: 20px;
        }

        .bikes {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
        }

        .bike {
            border: 1px solid #ddd;
            margin: 10px;
            padding: 10px;
            text-align: center;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            width: 200px;
        }

        .bike img {
            max-width: 100%;
            height: auto;
            border-radius: 4px;
        }

        .bike p {
            margin: 10px 0;
            font-size: 16px;
            color: #333;
        }
    </style>
</head>
<body>
    <h1>Bikes for Sale</h1>
    <div class="bikes">
        <?php foreach ($bikes as $bike): ?>
            <div class="bike">
                <h2><?php echo htmlspecialchars($bike['name']); ?></h2>
                <img src="<?php echo htmlspecialchars($bike['image']); ?>" alt="<?php echo htmlspecialchars($bike['name']); ?>">
                <p>Price: $<?php echo number_format($bike['price'], 2); ?></p>
            </div>
        <?php endforeach; ?>
    </div>
</body>
</html>
