<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

if ($_SERVER['REQUEST_METHOD'] !== 'POST')
{
    die('Invalid request.');
}

/*
|--------------------------------------------------------------------------
| Validation Functions
|--------------------------------------------------------------------------
*/

function clean(?string $value): string
{
    return trim($value ?? '');
}

function sanitizeText(?string $value): string
{
    $value = clean($value);

    // Remove control characters
    return preg_replace('/[\x00-\x1F\x7F]/u', '', $value);
}

function validateName(string $value): bool
{
    return preg_match("/^[A-Za-zÀ-ÿ' -]{1,50}$/u", $value) === 1;
}

function validatePhone(string $value): bool
{
    if ($value === '')
    {
        return true;
    }

    return preg_match('/^[0-9()+ -]{10,20}$/', $value) === 1;
}

function validatePostalCode(string $value): bool
{
    if ($value === '')
    {
        return true;
    }

    return preg_match('/^[A-Za-z]\d[A-Za-z][ ]?\d[A-Za-z]\d$/', $value) === 1;
}

function validateEmail(string $value): bool
{
    if ($value === '')
    {
        return true;
    }

    return filter_var($value, FILTER_VALIDATE_EMAIL) !== false;
}

function validateDate(string $value): bool
{
    $date = DateTime::createFromFormat('Y-m-d', $value);

    return $date &&
           $date->format('Y-m-d') === $value;
}

function validateLength(string $value, int $max): bool
{
    return mb_strlen($value) <= $max;
}

/*
|--------------------------------------------------------------------------
| Required Fields
|--------------------------------------------------------------------------
*/

$first_name   = sanitizeText($_POST['first_name'] ?? '');
$last_name    = sanitizeText($_POST['last_name'] ?? '');
$date_applied = clean($_POST['date_applied'] ?? '');

if (
    $first_name === '' ||
    $last_name === '' ||
    $date_applied === ''
)
{
    die('Please complete all required fields.');
}

/*
|--------------------------------------------------------------------------
| Validate Required Fields
|--------------------------------------------------------------------------
*/

if (!validateName($first_name))
{
    die('Invalid first name.');
}

if (!validateName($last_name))
{
    die('Invalid last name.');
}

if (!validateDate($date_applied))
{
    die('Invalid application date.');
}

/*
|--------------------------------------------------------------------------
| Optional Fields
|--------------------------------------------------------------------------
*/

$street_address = sanitizeText($_POST['street_address'] ?? '');
$city           = sanitizeText($_POST['city'] ?? '');
$province       = sanitizeText($_POST['province'] ?? '');
$postal_code    = strtoupper(sanitizeText($_POST['postal_code'] ?? ''));
$contact_phone  = sanitizeText($_POST['contact_phone'] ?? '');
$email_address  = sanitizeText($_POST['email_address'] ?? '');

$physical_considerations =
    sanitizeText($_POST['physical_considerations'] ?? '');

$physical_explanation =
    sanitizeText($_POST['physical_explanation_text'] ?? '');

$emergency_contact_name =
    sanitizeText($_POST['emergency_contact_name'] ?? '');

$emergency_relationship =
    sanitizeText($_POST['emergency_relationship'] ?? '');

$emergency_phone =
    sanitizeText($_POST['emergency_phone'] ?? '');

$hobbies_skills_interests =
    sanitizeText($_POST['hobbies_skills_interests'] ?? '');

$special_training_certification =
    sanitizeText($_POST['special_training_certification'] ?? '');

$prompted_by =
    sanitizeText($_POST['prompted_by'] ?? '');

$languages_spoken =
    sanitizeText($_POST['languages_spoken'] ?? '');

/*
|--------------------------------------------------------------------------
| Availability Checkboxes
|--------------------------------------------------------------------------
*/

$tuesday_9am_12pm   = isset($_POST['tuesday_9am_12pm']) ? 1 : 0;
$tuesday_1pm_4pm    = isset($_POST['tuesday_1pm_4pm']) ? 1 : 0;

$wednesday_9am_12pm = isset($_POST['wednesday_9am_12pm']) ? 1 : 0;
$wednesday_1pm_4pm  = isset($_POST['wednesday_1pm_4pm']) ? 1 : 0;

$thursday_9am_12pm  = isset($_POST['thursday_9am_12pm']) ? 1 : 0;
$thursday_1pm_4pm   = isset($_POST['thursday_1pm_4pm']) ? 1 : 0;

$monday_9am_12pm    = isset($_POST['monday_9am_12pm']) ? 1 : 0;
$monday_1pm_4pm     = isset($_POST['monday_1pm_4pm']) ? 1 : 0;

$saturday_9am_12pm  = isset($_POST['saturday_9am_12pm']) ? 1 : 0;
$saturday_1pm_4pm   = isset($_POST['saturday_1pm_4pm']) ? 1 : 0;

/*
|--------------------------------------------------------------------------
| Validate Optional Fields
|--------------------------------------------------------------------------
*/

if (!validatePhone($contact_phone))
{
    die('Invalid contact phone number.');
}

if (!validatePhone($emergency_phone))
{
    die('Invalid emergency contact phone number.');
}

if (!validatePostalCode($postal_code))
{
    die('Invalid postal code.');
}

if (!validateEmail($email_address))
{
    die('Invalid email address.');
}

if (!validateLength($street_address, 100))
{
    die('Street address is too long.');
}

if (!validateLength($city, 60))
{
    die('City is too long.');
}

if (!validateLength($province, 30))
{
    die('Province is too long.');
}

if (!validateLength($hobbies_skills_interests, 5000))
{
    die('Skills and interests are too long.');
}

require 'db_connect.php';

try
{
    $sql = "
        INSERT INTO volunteers
        (
            first_name,
            last_name,
            date_applied,
            street_address,
            city,
            province,
            postal_code,
            contact_phone,
            email_address,
            tuesday_9am_12pm,
            tuesday_1pm_4pm,
            wednesday_9am_12pm,
            wednesday_1pm_4pm,
            thursday_9am_12pm,
            thursday_1pm_4pm,
            monday_9am_12pm,
            monday_1pm_4pm,
            saturday_9am_12pm,
            saturday_1pm_4pm,
            physical_considerations,
            physical_explanation,
            emergency_contact_name,
            emergency_relationship,
            emergency_phone,
            hobbies_skills_interests,
            special_training_certification,
            prompted_by,
            languages_spoken
        )
        VALUES
        (
            :first_name,
            :last_name,
            :date_applied,
            :street_address,
            :city,
            :province,
            :postal_code,
            :contact_phone,
            :email_address,
            :tuesday_9am_12pm,
            :tuesday_1pm_4pm,
            :wednesday_9am_12pm,
            :wednesday_1pm_4pm,
            :thursday_9am_12pm,
            :thursday_1pm_4pm,
            :monday_9am_12pm,
            :monday_1pm_4pm,
            :saturday_9am_12pm,
            :saturday_1pm_4pm,
            :physical_considerations,
            :physical_explanation,
            :emergency_contact_name,
            :emergency_relationship,
            :emergency_phone,
            :hobbies_skills_interests,
            :special_training_certification,
            :prompted_by,
            :languages_spoken
        )
    ";

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

    $_SESSION['first_name'] = $first_name;
    $_SESSION['last_name'] = $last_name;

    header('Location: confirmation.php');
    exit();
}
catch (PDOException $e)
{
    echo '<h2>Database Error</h2>';
    echo '<pre>';
    echo $e->getMessage();
    echo '</pre>';
}
