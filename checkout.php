<?php
require_once './utils/init.php';

if (!isset($_SESSION['logged'])) {
    header('Location: login.php');
    return;
}

echo 'Comprou!';

$_SESSION['cart'] = [];
