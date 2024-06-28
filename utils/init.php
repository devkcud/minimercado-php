<?php
// Enable errs
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

$db = new mysqli(username: "root", password: "", database: "__dd_mm");

if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
}
