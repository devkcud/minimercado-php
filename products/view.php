<?php require_once '../utils/init.php' ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ver Produto</title>
</head>

<body>

    <?php
    $product = $db->prepare("SELECT * FROM product WHERE id = ?");
    $product->bind_param('i', $_GET['id']);
    $product->execute();
    $product = $product->get_result()->fetch_assoc();

    if (!$product) {
        echo 'Product not found.';
        return;
    }

    echo $product['name'] . ' - R$' . $product['price'] . ' - ' . $product['description'];
    ?>

</body>

</html>