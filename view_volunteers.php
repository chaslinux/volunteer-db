<?php
// Database Configuration
$host = "localhost";
$dbname = "your_database_name";
$username = "your_username";
$password = "your_password";

try {
    $pdo = new PDO(
        "mysql:host=$host;dbname=$dbname;charset=utf8mb4",
        $username,
        $password,
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ]
    );

    $stmt = $pdo->query("
        SELECT *
        FROM volunteers
        ORDER BY date_applied DESC, last_name ASC
    ");

    $volunteers = $stmt->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    die("Database Error: " . $e->getMessage());
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Volunteer Applications</title>

<style>

body{
    margin:0;
    font-family:Segoe UI,Tahoma,Geneva,Verdana,sans-serif;
    background:#f5f8f5;
    color:#333;
}

.header{
    background:#2e7d32;
    color:white;
    padding:25px;
    text-align:center;
    box-shadow:0 2px 10px rgba(0,0,0,.1);
}

.container{
    width:95%;
    max-width:1400px;
    margin:30px auto;
}

.card{
    background:white;
    border-radius:16px;
    padding:25px;
    box-shadow:0 4px 15px rgba(0,0,0,.08);
}

h1{
    margin:0;
}

table{
    width:100%;
    border-collapse:collapse;
}

th{
    background:#388e3c;
    color:white;
    padding:12px;
    text-align:left;
}

td{
    padding:12px;
    border-bottom:1px solid #eee;
}

tr:hover{
    background:#f1f8f1;
}

.details{
    display:none;
    background:#fafafa;
}

.details td{
    padding:20px;
}

.btn{
    background:#43a047;
    color:white;
    border:none;
    padding:8px 15px;
    border-radius:8px;
    cursor:pointer;
    font-weight:bold;
}

.btn:hover{
    background:#2e7d32;
}

.section{
    margin-bottom:20px;
    padding:15px;
    border-radius:12px;
    background:white;
    border:1px solid #e0e0e0;
}

.section h3{
    margin-top:0;
    color:#2e7d32;
}

.badge{
    display:inline-block;
    background:#4caf50;
    color:white;
    padding:4px 10px;
    border-radius:20px;
    margin:2px;
    font-size:.85rem;
}

.empty{
    color:#999;
    font-style:italic;
}

</style>

<script>
function toggleDetails(id)
{
    let row = document.getElementById('details-'+id);

    if(row.style.display === 'table-row')
    {
        row.style.display='none';
    }
    else
    {
        row.style.display='table-row';
    }
}
</script>

</head>
<body>

<div class="header">
    <h1>Volunteer Applications</h1>
</div>

<div class="container">

<div class="card">

<table>

<thead>
<tr>
    <th>Name</th>
    <th>Date Applied</th>
    <th>Phone</th>
    <th>Email</th>
    <th>City</th>
    <th>Details</th>
</tr>
</thead>

<tbody>

<?php foreach($volunteers as $volunteer): ?>

<tr>
    <td>
        <?= htmlspecialchars($volunteer['first_name']) ?>
        <?= htmlspecialchars($volunteer['last_name']) ?>
    </td>

    <td>
        <?= htmlspecialchars($volunteer['date_applied']) ?>
    </td>

    <td>
        <?= htmlspecialchars($volunteer['contact_phone']) ?>
    </td>

    <td>
        <?= htmlspecialchars($volunteer['email_address']) ?>
    </td>

    <td>
        <?= htmlspecialchars($volunteer['city']) ?>
    </td>

    <td>
        <button
            class="btn"
            onclick="toggleDetails(<?= $volunteer['id'] ?>)">
            View
        </button>
    </td>
</tr>

<tr
    id="details-<?= $volunteer['id'] ?>"
    class="details">

<td colspan="6">

<div class="section">
<h3>Contact Information</h3>

<p><strong>Address:</strong>
<?= htmlspecialchars($volunteer['street_address']) ?>
</p>

<p><strong>Province:</strong>
<?= htmlspecialchars($volunteer['province']) ?>
</p>

<p><strong>Postal Code:</strong>
<?= htmlspecialchars($volunteer['postal_code']) ?>
</p>

</div>

<div class="section">
<h3>Availability</h3>

<?php

$availability = [];

if($volunteer['tuesday_9am_12pm']) $availability[] = "Tuesday Morning";
if($volunteer['tuesday_1pm_4pm']) $availability[] = "Tuesday Afternoon";

if($volunteer['wednesday_9am_12pm']) $availability[] = "Wednesday Morning";
if($volunteer['wednesday_1pm_4pm']) $availability[] = "Wednesday Afternoon";

if($volunteer['thursday_9am_12pm']) $availability[] = "Thursday Morning";
if($volunteer['thursday_1pm_4pm']) $availability[] = "Thursday Afternoon";

if(count($availability))
{
    foreach($availability as $slot)
    {
        echo "<span class='badge'>{$slot}</span>";
    }
}
else
{
    echo "<span class='empty'>No availability selected</span>";
}

?>

</div>

<div class="section">
<h3>Physical Considerations</h3>

<p>
<strong>Response:</strong>
<?= htmlspecialchars($volunteer['physical_considerations']) ?>
</p>

<?php if(!empty($volunteer['physical_explanation'])): ?>

<p>
<strong>Details:</strong><br>
<?= nl2br(htmlspecialchars($volunteer['physical_explanation'])) ?>
</p>

<?php endif; ?>

</div>

<div class="section">
<h3>Emergency Contact</h3>

<p>
<strong>Name:</strong>
<?= htmlspecialchars($volunteer['emergency_contact_name']) ?>
</p>

<p>
<strong>Relationship:</strong>
<?= htmlspecialchars($volunteer['emergency_relationship']) ?>
</p>

<p>
<strong>Phone:</strong>
<?= htmlspecialchars($volunteer['emergency_phone']) ?>
</p>

</div>

<div class="section">
<h3>Skills & Interests</h3>

<p>
<strong>Hobbies / Skills:</strong><br>
<?= nl2br(htmlspecialchars($volunteer['hobbies_skills_interests'])) ?>
</p>

<p>
<strong>Training / Certifications:</strong><br>
<?= nl2br(htmlspecialchars($volunteer['special_training_certification'])) ?>
</p>

<p>
<strong>Prompted By:</strong><br>
<?= nl2br(htmlspecialchars($volunteer['prompted_by'])) ?>
</p>

<p>
<strong>Languages:</strong><br>
<?= nl2br(htmlspecialchars($volunteer['languages_spoken'])) ?>
</p>

</div>

</td>
</tr>

<?php endforeach; ?>

</tbody>

</table>

</div>

</div>

</body>
</html>
