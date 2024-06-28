<?php
require_once './utils/init.php';

if (!isset($_SESSION['logged'])) {
    header('Location: login.php');
    return;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrinho</title>
</head>

<body>
    <h1>Carrinho</h1>

    <?php
    $priceTotal = 0;

    if (count($_SESSION['cart']) > 0) {
        foreach ($_SESSION['cart'] as $product) {
            $productfromdb = $db->query("SELECT * FROM product WHERE id = " . $product);

            $productfromdb = $productfromdb->fetch_assoc();
            $priceTotal += $productfromdb['price'];

            echo $productfromdb['name'] . ' - R$' . $productfromdb['price'] . '<br>';
        }
    } else {
        echo 'Carrinho vazio';
    }
    ?>

    <p>Preço Total: R$<?php echo $priceTotal; ?></p>

    <a href="./checkout.php">Finalizar Compra</a>

    <a href="./loja/index.php">Voltar</a>
</body>

</html>