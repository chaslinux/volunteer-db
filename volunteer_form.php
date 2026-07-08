<?php
session_start();

$isAdmin = isset($_SESSION['admin']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Volunteer Application</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
<div class="container">
    <div class="form-header">
        <h1>🌱 Volunteer Application</h1>
        <p>
            Thank you for your interest in volunteering.
            Please complete the form below.
        </p>
    </div>

    <form action="submit_volunteer.php" method="post">
        <!-- Contact Information -->
        <div class="card-section">

            <h2>Contact Information</h2>
            <label for="first_name" class="required">
                First Name(s)
            </label>

            <input
                type="text"
                id="first_name"
                name="first_name"
                required
                maxlength="50"
                autocomplete="given-name"
                autocapitalize="words"
                pattern="[A-Za-zÀ-ÿ' -]+"
                placeholder="Joe"
                title="Letters, spaces, apostrophes and hyphens only">

            <label for="last_name" class="required">
                Last Name(s)
            </label>

            <input
                type="text"
                id="last_name"
                name="last_name"
                required
                maxlength="50"
                autocomplete="family-name"
                autocapitalize="words"
                pattern="[A-Za-zÀ-ÿ' -]+"
                placeholder="Smith"
                title="Letters, spaces, apostrophes and hyphens only">

            <label for="date_applied" class="required">
                Date Applied
            </label>

            <input
                type="date"
                id="date_applied"
                name="date_applied"
                value="<?= date('Y-m-d'); ?>"
                required>

            <label for="street_address">
                Street Address
            </label>

            <input
                type="text"
                id="street_address"
                name="street_address"
                maxlength="100"
                autocomplete="street-address"
                autocapitalize="words">

            <label for="city">
                City
            </label>

            <input
                type="text"
                id="city"
                name="city"
                maxlength="60"
                autocomplete="address-level2"
                autocapitalize="words"
                pattern="[A-Za-zÀ-ÿ' -]+"
                title="Letters, spaces, apostrophes and hyphens only">

            <label for="province">
                Province
            </label>

            <select
                id="province"
                name="province"
                required
                autocomplete="address-level1">
                <option value="">Select Province</option>
                <option value="Ontario">Ontario</option>
                <option value="Just Visiting">Just Visiting</option>
            </select>

            <label for="postal_code">
                Postal Code
            </label>

            <input
                type="text"
                id="postal_code"
                name="postal_code"
                maxlength="7"
                autocomplete="postal-code"
                placeholder="N2L 3G1"
                pattern="[A-Za-z]\d[A-Za-z][ ]?\d[A-Za-z]\d"
                title="Example: N2L 3G1">

            <label for="contact_phone">
                Contact Phone
            </label>

            <input
                type="tel"
                id="contact_phone"
                name="contact_phone"
                maxlength="20"
                autocomplete="tel"
                pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}"
                placeholder="123-456-7890"
                title="Please match the requested format: 123-456-7890">

            <label for="email_address">
                Email Address
            </label>

            <input
                type="email"
                id="email_address"
                name="email_address"
                maxlength="100"
                autocomplete="email"
                placeholder="username@domain.com"
                title="Please match the requested format: your@emailaddress.com">
        </div>

        <!-- Availability -->
        <div class="card-section">
            <h2>Availability</h2>
            <div class="availability-grid">
                <div class="day-card">
                    <h3>Tuesday</h3>
                    <label>
                        <input type="checkbox" name="tuesday_9am_12pm">
                        9:30am – 12:00pm
                    </label>

                    <label>
                        <input type="checkbox" name="tuesday_1pm_4pm">
                        1:00pm – 4:00pm
                    </label>
                </div>

                <div class="day-card">
                    <h3>Wednesday</h3>
                    <label>
                        <input type="checkbox" name="wednesday_9am_12pm">
                        9:30am – 12:00pm
                    </label>

                    <label>
                        <input type="checkbox" name="wednesday_1pm_4pm">
                        1:00pm – 4:00pm
                    </label>
                </div>

                <div class="day-card">
                    <h3>Thursday</h3>
                    <label>
                        <input type="checkbox" name="thursday_9am_12pm">
                        9:30am – 12:00pm
                    </label>

                    <label>
                        <input type="checkbox" name="thursday_1pm_4pm">
                        1:00pm – 4:00pm
                    </label>
                </div>
            </div>

            <p style="margin-top:20px;color:#666;">
                Monday, Friday, and Saturday volunteer shifts will be available in the future.
            </p>

        </div>

        <!-- Physical Considerations -->
        <div class="card-section">

            <h2>Physical Considerations</h2>
            <label>
                <input
                    type="radio"
                    name="physical_considerations"
                    value="Yes"
                    required>
                Yes
            </label>

            <label>
                <input
                    type="radio"
                    name="physical_considerations"
                    value="No">
                No
            </label>


            <div id="physical_explanation" style="display:none;">

                <label for="physical_explanation_text">
                    Please explain
                </label>

                <textarea
                    id="physical_explanation_text"
                    name="physical_explanation_text"
                    maxlength="2000"></textarea>
            </div>
        </div>

        <!-- Emergency Information -->
        <div class="card-section">
            <h2>Emergency Information</h2>
            <label
                for="emergency_contact_name"
                class="required">
                Emergency Contact Name

            </label>

            <input
                type="text"
                id="emergency_contact_name"
                name="emergency_contact_name"
                required
                maxlength="50"
                autocapitalize="words"
                pattern="[A-Za-zÀ-ÿ' -]+"
                placeholder="Firstname Lastname"
                title="Letters, spaces, apostrophes and hyphens only">

            <label
                for="emergency_relationship"
                class="required">
                Relationship to You
            </label>

            <input
                type="text"
                id="emergency_relationship"
                name="emergency_relationship"
                required
                maxlength="40"
                placeholder="Family member">

            <label
                for="emergency_phone"
                class="required">
                Emergency Contact Phone
            </label>

            <input
                type="tel"
                id="emergency_phone"
                name="emergency_phone"
                required
                maxlength="20"
                autocomplete="tel"
                pattern="[0-9()+ -]{10,20}"
                placeholder="###-###-####"
                title="Enter a valid phone number ###-###-####">
        </div>



        <!-- Skills & Interests -->
        <div class="card-section">
            <h2>Skills & Interests</h2>
            <label for="hobbies_skills_interests">
                Hobbies, Skills & Interests
            </label>

            <textarea
                id="hobbies_skills_interests"
                name="hobbies_skills_interests"
                maxlength="2000"></textarea>

            <label for="special_training_certification">
                Special Training / Certifications
            </label>

            <textarea
                id="special_training_certification"
                name="special_training_certification"
                maxlength="2000"></textarea>

            <label for="prompted_by">
                Who Prompted You to Volunteer?
            </label>

            <textarea
                id="prompted_by"
                name="prompted_by"
                maxlength="1000"></textarea>

            <label for="languages_spoken">
                Languages Spoken
            </label>

            <textarea
                id="languages_spoken"
                name="languages_spoken"
                maxlength="500"></textarea>
        </div>


        <button type="submit">
            Submit Volunteer Application
        </button>
    </form>
</div>


<script>

document.querySelectorAll(
    'input[name="physical_considerations"]'
)
.forEach(function(radio)
{

    radio.addEventListener(
        'change',
        function()
        {

            const explanation =
                document.getElementById(
                    'physical_explanation'
                );


            const textarea =
                document.getElementById(
                    'physical_explanation_text'
                );


            if (this.value === 'Yes')
            {

                explanation.style.display = 'block';

                textarea.required = true;

            }
            else
            {

                explanation.style.display = 'none';

                textarea.required = false;

                textarea.value = '';

            }

        }
    );

});

</script>


</body>
</html>
