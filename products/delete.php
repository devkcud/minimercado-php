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

// Check if product is from the current user

$product = $db->prepare("SELECT owner_id FROM product WHERE id = ?");
$product->bind_param('i', $_GET['id']);
$product->execute();
$product = $product->get_result()->fetch_assoc();

if ($product['owner_id'] != $_SESSION['user_id']) {
    header('Location: ../index.php');
    return;
}

$stmt = $db->prepare("DELETE FROM product WHERE id = ?");
$stmt->bind_param('i', $_GET['id']);
$stmt->execute();

header('Location: ../index.php');
