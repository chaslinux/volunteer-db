<?php
session_start();
if (!isset($_SESSION['first_name'])) {
    header('Location: index.php');
    exit();
}

$first_name = $_SESSION['first_name'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmation</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h1>Thank you for registering!</h1>
        <p>Your registration is complete.</p>
        <a href="index.php">Back to Home</a>
    </div>
</body>
</html>
