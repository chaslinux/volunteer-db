<?php

session_start();

if (!isset($_SESSION['admin_logged_in']))
{
    header("Location: admin_login.php");
    exit;
}

require 'db_connect.php';

$stmt = $pdo->query("
    SELECT *
    FROM volunteers
    ORDER BY id DESC
");

$volunteers = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">
<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Volunteer Dashboard</title>

<link rel="stylesheet" href="styles.css">

</head>

<body>

<div class="container">

    <div class="form-header">
        <h1>🌱 Volunteer Dashboard</h1>
        <p>Manage volunteer applications</p>
    </div>

    <div style="display:flex; gap:10px; margin-bottom:20px; flex-wrap:wrap;">

        <a class="btn" href="admin_logout.php">
            Logout
        </a>

        <button class="btn" onclick="window.print()">
            Print List
        </button>

    </div>

    <div class="card-section">

        <h2>
            Applications (<?= count($volunteers) ?>)
        </h2>

        <table>

            <thead>

                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Date</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Action</th>
                </tr>

            </thead>

            <tbody>

                <?php foreach ($volunteers as $v): ?>

                    <tr>

                        <td><?= $v['id'] ?></td>

                        <td>
                            <?= htmlspecialchars($v['first_name'] . ' ' . $v['last_name']) ?>
                        </td>

                        <td>
                            <?= htmlspecialchars($v['date_applied']) ?>
                        </td>

                        <td>
                            <?= htmlspecialchars($v['email_address']) ?>
                        </td>

                        <td>
                            <?= htmlspecialchars($v['contact_phone']) ?>
                        </td>

                        <td>
                            <a class="btn"
                               href="volunteer_details.php?id=<?= $v['id'] ?>">
                                View
                            </a>
                        </td>

                    </tr>

                <?php endforeach; ?>

            </tbody>

        </table>

    </div>

</div>

</body>
</html>
