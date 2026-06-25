<?php

require 'db_connect.php';

$username = 'admin';
$password = 'ChangeMe123!';

$passwordHash = password_hash(
    $password,
    PASSWORD_DEFAULT
);

$stmt = $pdo->prepare("
    INSERT INTO admins
    (
        username,
        password_hash
    )
    VALUES
    (
        ?,
        ?
    )
");

$stmt->execute([
    $username,
    $passwordHash
]);

echo "Administrator created.";
