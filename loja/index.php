<?php require_once '../utils/init.php'; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Loja</title>
</head>

<body>
    <h1>Loja (<a href="../index.php">Meus Produtos</a>)</h1>

    <a href="logout.php">Logout</a>
    <br>
    <a href="../cart.php">Carrinho (<?= count($_SESSION['cart']) ?>)</a>

    <?php
    $products = $db->query("SELECT * FROM product");

    echo '<table style="width:100%" border="1">';
    echo '<tr>';
    echo '<th>Nome</th>';
    echo '<th>Preço</th>';
    echo '<th>Descrição</th>';
    echo '<th>Ações</th>';
    echo '</tr>';
    while ($product = $products->fetch_assoc()) {
        echo '<tr>';
        echo '<td>' . $product['name'] . '</td>';
        echo '<td>' . $product['price'] . '</td>';
        echo '<td>' . $product['description'] . '</td>';
        echo '<td>';
        if ($product['owner_id'] == $_SESSION['user_id']) {
            echo '<a href="../products/edit.php?id=' . $product['id'] . '">Editar</a>';
            echo ' | ';
            echo '<a href="../products/delete.php?id=' . $product['id'] . '">Excluir</a>';
            echo ' (Este produto é seu)';
        } else {
            echo '<a href="../products/view.php?id=' . $product['id'] . '">Ver</a>';
            echo ' | ';
            echo '<a href="../products/buy.php?id=' . $product['id'] . '">Adicionar ao carrinho</a>';
        }
        echo '</td>';

        echo '</tr>';
    }
    echo '</table>';
    ?>
</body>

</html>