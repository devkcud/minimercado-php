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

$product = $db->query("SELECT owner_id FROM product WHERE id = " . $_GET['id'])->fetch_assoc();

if ($product['owner_id'] != $_SESSION['user_id']) {
    header('Location: ../index.php');
    return;
}

$db->query("DELETE FROM product WHERE id = " . $_GET['id']);

header('Location: ../index.php');
