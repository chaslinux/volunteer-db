<?php

session_start();

if (!isset($_SESSION['admin_logged_in']))
{
    header("Location: admin_login.php");
    exit;
}

require 'db_connect.php';

$id = intval($_GET['id'] ?? 0);

$stmt = $pdo->prepare("
    SELECT *
    FROM volunteers
    WHERE id = ?
");

$stmt->execute([$id]);

$volunteer = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$volunteer)
{
    die("Volunteer not found");
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Volunteer Details</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

<h1>Volunteer Details</h1>

<p><strong>ID:</strong> <?= htmlspecialchars($volunteer['id']) ?></p>

<p>
    <strong>Name:</strong>
    <?= htmlspecialchars($volunteer['first_name']) ?>
    <?= htmlspecialchars($volunteer['last_name']) ?>
</p>

<p>
    <strong>Date Applied:</strong>
    <?= htmlspecialchars($volunteer['date_applied']) ?>
</p>

<p>
    <strong>Email:</strong>
    <?= htmlspecialchars($volunteer['email_address']) ?>
</p>

<p>
    <strong>Phone:</strong>
    <?= htmlspecialchars($volunteer['contact_phone']) ?>
</p>

<p>
    <strong>Address:</strong>
    <?= htmlspecialchars($volunteer['street_address']) ?>,
    <?= htmlspecialchars($volunteer['city']) ?>,
    <?= htmlspecialchars($volunteer['province']) ?>
</p>

<p>
    <strong>Emergency Contact:</strong>
    <?= htmlspecialchars($volunteer['emergency_contact_name']) ?>
</p>

<p>
    <strong>Relationship:</strong>
    <?= htmlspecialchars($volunteer['emergency_relationship']) ?>
</p>

<p>
    <strong>Emergency Phone:</strong>
    <?= htmlspecialchars($volunteer['emergency_phone']) ?>
</p>

<p>
    <strong>Physical Considerations:</strong>
    <?= htmlspecialchars($volunteer['physical_considerations']) ?>
</p>

<p>
    <strong>Physical Explanation:</strong>
    <?= nl2br(htmlspecialchars($volunteer['physical_explanation'])) ?>
</p>

<p>
    <strong>Languages Spoken:</strong>
    <?= nl2br(htmlspecialchars($volunteer['languages_spoken'])) ?>
</p>

<p>
    <strong>Skills & Interests:</strong>
    <?= nl2br(htmlspecialchars($volunteer['hobbies_skills_interests'])) ?>
</p>

<p>
    <a href="admin_dashboard.php">Back to Dashboard</a>
</p>

</body>
</html>
