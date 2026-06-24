<?php
session_start();
if (isset($_POST['first_name'])) {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $date_applied = $_POST['date_applied'];
    $street_address = isset($_POST['street_address']) ? $_POST['street_address'] : null;
    $city = isset($_POST['city']) ? $_POST['city'] : null;
    $province = isset($_POST['province']) ? $_POST['province'] : null;
    $postal_code = isset($_POST['postal_code']) ? $_POST['postal_code'] : null;
    $contact_phone = isset($_POST['contact_phone']) ? $_POST['contact_phone'] : null;
    $email_address = isset($_POST['email_address']) ? $_POST['email_address'] : null;
    $tuesday_9am_12pm = isset($_POST['tuesday_9am_12pm']) ? 1 : 0;
    $tuesday_1pm_4pm = isset($_POST['tuesday_1pm_4pm']) ? 1 : 0;
    $wednesday_9am_12pm = isset($_POST['wednesday_9am_12pm']) ? 1 : 0;
    $wednesday_1pm_4pm = isset($_POST['wednesday_1pm_4pm']) ? 1 : 0;
    $thursday_9am_12pm = isset($_POST['thursday_9am_12pm']) ? 1 : 0;
    $thursday_1pm_4pm = isset($_POST['thursday_1pm_4pm']) ? 1 : 0;
    $monday_9am_12pm = isset($_POST['monday_9am_12pm']) ? 1 : 0;
    $monday_1pm_4pm = isset($_POST['monday_1pm_4pm']) ? 1 : 0;
    $saturday_9am_12pm = isset($_POST['saturday_9am_12pm']) ? 1 : 0;
    $saturday_1pm_4pm = isset($_POST['saturday_1pm_4pm']) ? 1 : 0;
    $physical_considerations = $_POST['physical_considerations'];
    $physical_explanation = isset($_POST['physical_explanation_text']) ? $_POST['physical_explanation_text'] : null;
    $emergency_contact_name = isset($_POST['emergency_contact_name']) ? $_POST['emergency_contact_name'] : null;
    $emergency_relationship = isset($_POST['emergency_relationship']) ? $_POST['emergency_relationship'] : null;
    $emergency_phone = isset($_POST['emergency_phone']) ? $_POST['emergency_phone'] : null;
    $hobbies_skills_interests = isset($_POST['hobbies_skills_interests']) ? $_POST['hobbies_skills_interests'] : null;
    $special_training_certification = isset($_POST['special_training_certification']) ? $_POST['special_training_certification'] : null;
    $prompted_by = isset($_POST['prompted_by']) ? $_POST['prompted_by'] : null;
    $languages_spoken = isset($_POST['languages_spoken']) ? $_POST['languages_spoken'] : null;

    // Database connection
    $host = 'localhost';
    $dbname = 'your_database_name';
    $username = 'your_username';
    $password = 'your_password';

    try {
        $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4",$username,$password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Insert data into the volunteers table
        $sql = "INSERT INTO volunteers (first_name, last_name, date_applied, street_address, city, province, postal_code, contact_phone, email_address, tuesday_9am_12pm, tuesday_1pm_4pm, wednesday_9am_12pm, wednesday_1pm_4pm, thursday_9am_12pm, thursday_1pm_4pm, monday_9am_12pm, monday_1pm_4pm, saturday_9am_12pm, saturday_1pm_4pm, physical_considerations, physical_explanation, emergency_contact_name, emergency_relationship, emergency_phone, hobbies_skills_interests, special_training_certification, prompted_by, languages_spoken) 
                VALUES (:first_name, :last_name, :date_applied, :street_address, :city, :province, :postal_code, :contact_phone, :email_address, :tuesday_9am_12pm, :tuesday_1pm_4pm, :wednesday_9am_12pm, :wednesday_1pm_4pm, :thursday_9am_12pm, :thursday_1pm_4pm, :monday_9am_12pm, :monday_1pm_4pm, :saturday_9am_12pm, :saturday_1pm_4pm, :physical_considerations, :physical_explanation, :emergency_contact_name, :emergency_relationship, :emergency_phone, :hobbies_skills_interests, :special_training_certification, :prompted_by, :languages_spoken)";

        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':first_name' => $first_name,
            ':last_name' => $last_name,
            ':date_applied' => $date_applied,
            ':street_address' => $street_address,
            ':city' => $city,
            ':province' => $province,
            ':postal_code' => $postal_code,
            ':contact_phone' => $contact_phone,
            ':email_address' => $email_address,
            ':tuesday_9am_12pm' => $tuesday_9am_12pm,
            ':tuesday_1pm_4pm' => $tuesday_1pm_4pm,
            ':wednesday_9am_12pm' => $wednesday_9am_12pm,
            ':wednesday_1pm_4pm' => $wednesday_1pm_4pm,
            ':thursday_9am_12pm' => $thursday_9am_12pm,
            ':thursday_1pm_4pm' => $thursday_1pm_4pm,
            ':monday_9am_12pm' => $monday_9am_12pm,
            ':monday_1pm_4pm' => $monday_1pm_4pm,
            ':saturday_9am_12pm' => $saturday_9am_12pm,
            ':saturday_1pm_4pm' => $saturday_1pm_4pm,
            ':physical_considerations' => $physical_considerations,
            ':physical_explanation' => $physical_explanation,
            ':emergency_contact_name' => $emergency_contact_name,
            ':emergency_relationship' => $emergency_relationship,
            ':emergency_phone' => $emergency_phone,
            ':hobbies_skills_interests' => $hobbies_skills_interests,
            ':special_training_certification' => $special_training_certification,
            ':prompted_by' => $prompted_by,
            ':languages_spoken' => $languages_spoken
        ]);

        // Redirect to confirmation page or dashboard
        $_SESSION['first_name'] = $first_name;
        $_SESSION['last_name'] = $last_name;
        header('Location: confirmation.php');
        exit();
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
