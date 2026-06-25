<?php

session_start();
require 'db_connect.php';

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST')
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

    if (
        $admin &&
        password_verify($password, $admin['password_hash'])
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

<!DOCTYPE html>
<html lang="en">
<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Administrator Login</title>

<link rel="stylesheet" href="styles.css">

</head>

<body>

<div class="hero-container">

    <div class="hero-card">

        <div class="form-header">

            <h1>🌱 Administrator Login</h1>

            <p>
                Volunteer Management System
            </p>

        </div>

        <?php if ($error): ?>

            <div class="card-section">

                <p style="color:#c62828; font-weight:bold; text-align:center;">
                    <?= htmlspecialchars($error) ?>
                </p>

            </div>

        <?php endif; ?>

        <form method="post">

            <div class="card-section">

                <label for="username">
                    Username
                </label>

                <input
                    type="text"
                    id="username"
                    name="username"
                    required>

                <label for="password">
                    Password
                </label>

                <input
                    type="password"
                    id="password"
                    name="password"
                    required>

                <button type="submit">
                    Login
                </button>

            </div>

        </form>

    </div>

</div>

</body>
</html>
