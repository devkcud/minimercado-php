<?php
require_once '../utils/init.php';

if (!isset($_SESSION['logged'])) {
    header('Location: login.php');
    return;
}

if (!isset($_SESSION['user_id'])) {
    return;
}

if (!isset($_GET['id'])) {
    header('Location: ../index.php');
    return;
}

$product = $db->query("SELECT * FROM product WHERE id = " . $_GET['id'])->fetch_assoc();

if ($product['owner_id'] != $_SESSION['user_id']) {
    header('Location: ../index.php');
    return;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $stmt = $db->prepare("UPDATE product SET name = ?, description = ?, price = ? WHERE id = ?");
    $stmt->bind_param('sssi', $_POST['name'], $_POST['description'], $_POST['price'], $_POST['id']);
    $stmt->execute();

    header('Location: ../index.php');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form action="" method="POST">
        <input type="hidden" name="id" value="<?= $_GET['id'] ?>">

        <label for="name">Name</label>
        <input type="text" name="name" value="<?= $product['name'] ?>">

        <label for="description">Description</label>
        <input type="text" name="description" value="<?= $product['description'] ?>">

        <label for="price">Price</label>
        <input type="number" name="price" value="<?= $product['price'] ?>">

        <input type="submit" value="Submit">
    </form>
</body>

</html>