<?php
require_once './utils/init.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!isset($_POST['name']) || !isset($_POST['email']) || !isset($_POST['password'])) {
        echo 'Please fill out all fields.';
        return;
    }

    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $db->prepare("SELECT * FROM person WHERE email = ?");
    $stmt->bind_param('s', $email);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        echo 'Email already exists.';
        return;
    }

    $password = password_hash($password, PASSWORD_DEFAULT);

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo 'Invalid email.';
        return;
    }

    $stmt = $db->prepare("INSERT INTO person (name, email, password) VALUES (?, ?, ?)");
    $stmt->bind_param('sss', $name, $email, $password);
    $stmt->execute();
    $stmt->close();

    header('Location: login.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
</head>

<body>
    <form action="" method="POST">
        <label for="name">Name</label>
        <input type="text" name="name" id="name" required>

        <label for="email">Email</label>
        <input type="text" name="email" id="email" required>

        <label for="password">Password</label>
        <input type="password" name="password" id="password" required>

        <button type="submit">Register</button>
    </form>

    <a href="login.php">Login</a>
</body>

</html>