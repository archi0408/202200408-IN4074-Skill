<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $price = $_POST['price'];
    $image = $_POST['image'];

    $stmt = $pdo->prepare("INSERT INTO bikes (name, price, image) VALUES (?, ?, ?)");
    $stmt->execute([$name, $price, $image]);

    header('Location: index.php');
}
?>
 