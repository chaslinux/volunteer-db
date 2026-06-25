<?php

$host = 'localhost';
$dbname = 'volunteer_database';
$username = 'db_user';
$password = 'db_password';

$pdo = new PDO(
    "mysql:host=$host;dbname=$dbname;charset=utf8mb4",
    $username,
    $password
);

$pdo->setAttribute(
    PDO::ATTR_ERRMODE,
    PDO::ERRMODE_EXCEPTION
);
