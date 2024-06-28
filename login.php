<?php
require_once './utils/init.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!isset($_POST['email']) || !isset($_POST['password'])) {
        echo 'Please fill out all fields.';
        return;
    }

    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $db->prepare("SELECT * FROM person WHERE email = ?");
    $stmt->bind_param('s', $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 0) {
        echo 'Invalid email or password.';
        return;
    }

    $user = $result->fetch_assoc();
    if (!password_verify($password, $user['password'])) {
        echo 'Invalid email or password.';
        return;
    }

    $_SESSION['logged'] = true;
    $_SESSION['user_id'] = $user['id'];
    header('Location: ./index.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>

<body>
    <form action="" method="POST">
        <label for="email">Email</label>
        <input type="email" name="email" id="email" required>

        <label for="password">Password</label>
        <input type="password" name="password" id="password" required>

        <button type="submit">Login</button>
    </form>

    <a href="register.php">Register</a>
</body>

</html>