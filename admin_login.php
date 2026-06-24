<?php

session_start();
require 'db_connect.php';

$error = '';

if($_SERVER['REQUEST_METHOD'] === 'POST')
{
    $username = trim($_POST['username']);
    $password = $_POST['password'];

    $stmt = $pdo->prepare("
        SELECT *
        FROM admins
        WHERE username = ?
    ");

    $stmt->execute([$username]);

    $admin = $stmt->fetch();

    if(
        $admin &&
        password_verify(
            $password,
            $admin['password_hash']
        )
    )
    {
        $_SESSION['admin_logged_in'] = true;
        $_SESSION['admin_id'] = $admin['id'];
        $_SESSION['admin_username'] = $admin['username'];

        header("Location: view_volunteers.php");
        exit;
    }

    $error = "Invalid username or password.";
}
?>
<form method="post">

    <h2>Administrator Login</h2>

    <?php if($error): ?>
        <div class="error">
            <?= htmlspecialchars($error) ?>
        </div>
    <?php endif; ?>

    <label>Username</label>
    <input type="text" name="username" required>

    <label>Password</label>
    <input type="password" name="password" required>

    <button type="submit">
        Login
    </button>

</form>
