<?php
session_start();

if (!isset($_SESSION['first_name'])) {
    header('Location: index.php');
    exit();
}

$first_name = htmlspecialchars($_SESSION['first_name']);
$last_name = htmlspecialchars($_SESSION['last_name'] ?? '');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Volunteer Registration Complete</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

<div class="confirmation-container">

    <div class="confirmation-card">

        <div class="success-icon">
            ✓
        </div>

        <h1>Application Submitted</h1>

        <p>
            Thank you <strong><?php echo $first_name . ' ' . $last_name; ?></strong>.
        </p>

        <p>
            Your volunteer application has been successfully submitted and saved.
        </p>

        <a href="index.php" class="btn">
            Return Home
        </a>

    </div>

</div>

</body>
</html>
