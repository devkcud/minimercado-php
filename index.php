<?php
require_once './utils/init.php';

if (!isset($_SESSION['logged'])) {
    header('Location: ./login.php');
}

if (!isset($_SESSION['user_id'])) {
    header('Location: ./login.php');
}
?>

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
    $name = $db->prepare("SELECT name FROM person WHERE id = ?");
    $name->bind_param('i', $_SESSION['user_id']);
    $name->execute();
    $name = $name->get_result()->fetch_assoc()['name'];

    echo 'Bem-vindo, ' . $name . '! ';

    echo '<a href="logout.php">Logout</a>';

    echo '<br>';
    ?>

    <a href="products/add.php">Adicionar Produtos</a>
    <br>

    <?php
    $products = $db->prepare("SELECT * FROM product WHERE owner_id = ?");
    $products->bind_param('i', $_SESSION['user_id']);
    $products->execute();
    $products = $products->get_result();

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