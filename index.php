<?php require_once './utils/init.php'; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meus Produtos</title>
</head>

<body>
    <h1>Meus Produtos (<a href="loja/index.php">Ver loja</a>)</h1>

    <?php
    if (!isset($_SESSION['logged'])) {
        echo '<a href="login.php">Login</a>';
        echo '<br>';
        echo '<a href="register.php">Register</a>';
        return;
    }

    if (!isset($_SESSION['user_id'])) {
        return;
    }

    $name = $db->query("SELECT name FROM person WHERE id = " . $_SESSION['user_id']);
    $name = $name->fetch_assoc()['name'];

    echo 'Bem-vindo, ' . $name . '! ';

    echo '<a href="logout.php">Logout</a>';

    echo '<br>';
    ?>

    <a href="products/add.php">Adicionar Produtos</a>
    <br>

    <?php
    $products = $db->query("SELECT * FROM product WHERE owner_id = " . $_SESSION['user_id']);

    if ($products->num_rows == 0) {
        echo 'Nenhum produto encontrado.';
        return;
    }

    echo '<table style="width:100%" border="1">';
    echo '<tr>';
    echo '<th>Nome</th>';
    echo '<th>Descrição</th>';
    echo '<th>Preço</th>';
    echo '<th>Ações</th>';
    echo '</tr>';
    while ($product = $products->fetch_assoc()) {
        echo '<tr>';
        echo '<td>' . $product['name'] . '</td>';
        echo '<td>' . $product['description'] . '</td>';
        echo '<td>R$' . $product['price'] . '</td>';
        echo '<td><a href="products/edit.php?id=' . $product['id'] . '">Editar</a> | <a href="products/delete.php?id=' . $product['id'] . '">Excluir</a></td>';
        echo '</tr>';
    }
    echo '</table>';
    ?>
</body>

</html>