<?php
require_once '../utils/init.php';

if (!isset($_SESSION['logged'])) {
    header('Location: login.php');
}

if (!isset($_SESSION['user_id'])) {
    header('Location: index.php');
}

if (!isset($_GET['id'])) {
    header('Location: index.php');
}

$id = $_GET['id'];

$_SESSION['cart'][] = $id;
header('Location: ../loja/index.php');
