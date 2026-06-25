<?php

session_start();

if(
    !isset($_SESSION['admin_logged_in'])
)
{
    header(
        "Location: admin_login.php"
    );
    exit;
}

require 'db_connect.php';

$id = intval($_GET['id']);

$stmt = $pdo->prepare("
    SELECT *
    FROM volunteers
    WHERE id = ?
");

$stmt->execute([$id]);

$volunteer =
    $stmt->fetch(PDO::FETCH_ASSOC);

if(!$volunteer)
{
    die("Volunteer not found");
}
?>
