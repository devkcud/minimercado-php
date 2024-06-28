<?php
require_once '../utils/init.php';

if ($_SESSION['logged'] !== true) {
    header('Location: ../login.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!isset($_POST['name']) || !isset($_POST['price']) || !isset($_POST['description'])) {
        echo 'Please fill out all fields.';
        return;
    }

    $name = $_POST['name'];
    $price = $_POST['price'];
    $description = $_POST['description'];

    $stmt = $db->prepare("INSERT INTO product (name, price, description, owner_id) VALUES (?, ?, ?, ?)");
    $stmt->bind_param('sdss', $name, $price, $description, $_SESSION['user_id']);
    $stmt->execute();

    header('Location: ../index.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Novo Produto</title>
</head>

<body>
    <form action="" method="POST">
        <label for="name">Name</label>
        <input type="text" name="name" id="name" required>

        <label for="price">Price</label>
        <input type="number" name="price" id="price" step="0.01" required>

        <label for="description">Description</label>
        <textarea name="description" id="description" cols="30" rows="10"></textarea>

        <button type="submit">Add</button>
    </form>
</body>

</html>