<?php
session_start();
include 'connect.php';

if (!empty($_SESSION['admin_logged_in'])) {
    header("Location: admin.php");
    exit();
}

$error = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    $stmt = $conn->prepare("SELECT password_hash FROM admins WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    $admin = $result->fetch_assoc();

    if ($admin && password_verify($password, $admin['password_hash'])) {
        session_regenerate_id(true);
        $_SESSION['admin_logged_in'] = true;
        $_SESSION['admin_username'] = $username;
        header("Location: admin.php");
        exit();
    } else {
        $error = "Invalid username or password.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link rel="stylesheet" href="css/Template.css">
    <link rel="stylesheet" href="css/admin.css">
</head>
<body>
<header>
    <h1>Restaurant</h1>
    <nav>
        <a href="index.html">Home</a>
        <a href="menu.html">Menu</a>
        <a href="cart.html">Cart</a>
        <a href="me.html">About Me</a>
        <a href="admin.php">Admin</a>
    </nav>
</header>

<div class="container form-container">
    <h2>Admin Login</h2>
    <?php if ($error): ?><p class="msg"><?php echo htmlspecialchars($error); ?></p><?php endif; ?>
    <form method="POST">
        <label>Username:</label>
        <input type="text" name="username" required autofocus>

        <label>Password:</label>
        <input type="password" name="password" required>

        <button type="submit" class="btn-submit">Log In</button>
    </form>
</div>
</body>
</html>
