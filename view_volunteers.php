<?php

session_start();

if (
    !isset($_SESSION['admin_logged_in'])
)
{
    header(
        "Location: admin_login.php"
    );

    exit;
}

require 'db_connect.php';

$stmt = $pdo->query("
    SELECT *
    FROM volunteers
    ORDER BY id DESC
");

$volunteers =
    $stmt->fetchAll(PDO::FETCH_ASSOC);

?>
<!DOCTYPE html>
<html>
<head>

<title>Volunteer Dashboard</title>

<link rel="stylesheet"
      href="styles.css">

</head>

<body>

<div class="container">

    <h1>
        Volunteer Applications
    </h1>

    <p>

        <a href="admin_logout.php">
            Logout
        </a>

    </p>

    <table>

        <thead>

        <tr>

            <th>ID</th>
            <th>Name</th>
            <th>Date Applied</th>
            <th>Email</th>
            <th>Phone</th>

        </tr>

        </thead>

        <tbody>

        <?php foreach($volunteers as $v): ?>

        <tr>

            <td>
                <?= $v['id'] ?>
            </td>

            <td>
            <a href="volunteer_details.php?id=<?= $v['id'] ?>">
            <?= htmlspecialchars(
                $v['first_name']
                . ' '
                . $v['last_name']
            ) ?>
            </a>

            </td>

            <td>
                <?= $v['date_applied'] ?>
            </td>

            <td>
                <?= htmlspecialchars(
                    $v['email_address']
                ) ?>
            </td>

            <td>
                <?= htmlspecialchars(
                    $v['contact_phone']
                ) ?>
            </td>

        </tr>

        <?php endforeach; ?>

        </tbody>

    </table>

</div>

</body>
</html>
