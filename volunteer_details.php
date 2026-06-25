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
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">
    <title>Volunteer Details</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

<div class="container">

    <div class="form-header">
        <h1>🌱 Volunteer Details</h1>
        <p>
            Volunteer record #<?= $volunteer['id']; ?>
        </p>
    </div>

    <div class="print-actions">
        <button onclick="window.print()" class="btn">
            Print Record
        </button>

        <a href="view_volunteers.php"
           class="btn">
            Back to Volunteers
        </a>
    </div>

    <div class="details-card">

        <h2>
            <?= htmlspecialchars($volunteer['first_name']) ?>
            <?= htmlspecialchars($volunteer['last_name']) ?>
        </h2>

        <div class="details-grid">

            <div class="details-label">Date Applied</div>
            <div class="details-value">
                <?= htmlspecialchars($volunteer['date_applied']) ?>
            </div>

            <div class="details-label">Email</div>
            <div class="details-value">
                <?= htmlspecialchars($volunteer['email_address']) ?>
            </div>

            <div class="details-label">Phone</div>
            <div class="details-value">
                <?= htmlspecialchars($volunteer['contact_phone']) ?>
            </div>

            <div class="details-label">Address</div>
            <div class="details-value">
                <?= htmlspecialchars($volunteer['street_address']) ?><br>
                <?= htmlspecialchars($volunteer['city']) ?>,
                <?= htmlspecialchars($volunteer['province']) ?>
                <?= htmlspecialchars($volunteer['postal_code']) ?>
            </div>

        </div>

        <div class="section-divider">

            <h2>Availability</h2>

            <?php
            $availability = [];

            if($volunteer['tuesday_9am_12pm']) $availability[] = "Tuesday 9:30am-12pm";
            if($volunteer['tuesday_1pm_4pm']) $availability[] = "Tuesday 1pm-4pm";

            if($volunteer['wednesday_9am_12pm']) $availability[] = "Wednesday 9:30am-12pm";
            if($volunteer['wednesday_1pm_4pm']) $availability[] = "Wednesday 1pm-4pm";

            if($volunteer['thursday_9am_12pm']) $availability[] = "Thursday 9:30am-12pm";
            if($volunteer['thursday_1pm_4pm']) $availability[] = "Thursday 1pm-4pm";
            ?>

            <?php if(count($availability)): ?>

                <?php foreach($availability as $slot): ?>
                    <span class="badge">
                        <?= htmlspecialchars($slot) ?>
                    </span>
                <?php endforeach; ?>

            <?php else: ?>

                <p>No availability selected.</p>

            <?php endif; ?>

        </div>

        <div class="section-divider">

            <h2>Physical Considerations</h2>

            <p>
                <strong>Response:</strong>
                <?= htmlspecialchars($volunteer['physical_considerations']) ?>
            </p>

            <?php if(!empty($volunteer['physical_explanation'])): ?>

                <p>
                    <?= nl2br(htmlspecialchars($volunteer['physical_explanation'])) ?>
                </p>

            <?php endif; ?>

        </div>

        <div class="section-divider">

            <h2>Emergency Contact</h2>

            <div class="details-grid">

                <div class="details-label">Name</div>
                <div class="details-value">
                    <?= htmlspecialchars($volunteer['emergency_contact_name']) ?>
                </div>

                <div class="details-label">Relationship</div>
                <div class="details-value">
                    <?= htmlspecialchars($volunteer['emergency_relationship']) ?>
                </div>

                <div class="details-label">Phone</div>
                <div class="details-value">
                    <?= htmlspecialchars($volunteer['emergency_phone']) ?>
                </div>

            </div>

        </div>

        <div class="section-divider">

            <h2>Skills & Interests</h2>

            <p><?= nl2br(htmlspecialchars($volunteer['hobbies_skills_interests'])) ?></p>

            <h3>Training & Certifications</h3>

            <p><?= nl2br(htmlspecialchars($volunteer['special_training_certification'])) ?></p>

            <h3>Languages Spoken</h3>

            <p><?= nl2br(htmlspecialchars($volunteer['languages_spoken'])) ?></p>

            <h3>Prompted By</h3>

            <p><?= nl2br(htmlspecialchars($volunteer['prompted_by'])) ?></p>

        </div>

    </div>

</div>

</body>
</html>
