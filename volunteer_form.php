<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Volunteer Form</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
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

```
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

        <label for="first_name">First Name(s)</label>
        <input type="text" id="first_name" name="first_name" required>

        <label for="last_name">Last Name(s)</label>
        <input type="text" id="last_name" name="last_name" required>

        <label for="date_applied">Date Applied</label>
        <input type="date"
               id="date_applied"
               name="date_applied"
               value="<?php echo date('Y-m-d'); ?>"
               required>

        <label for="street_address">Street Address</label>
        <input type="text" id="street_address" name="street_address">

        <label for="city">City</label>
        <input type="text" id="city" name="city">

        <label for="province">Province</label>
        <select id="province" name="province">
            <option value="">Select Province</option>
            <option value="Ontario">Ontario</option>
            <option value="Just Visiting">Just Visiting</option>
        </select>

        <label for="postal_code">Postal Code</label>
        <input type="text" id="postal_code" name="postal_code">

        <label for="contact_phone">Contact Phone</label>
        <input type="tel" id="contact_phone" name="contact_phone">

        <label for="email_address">Email Address</label>
        <input type="email" id="email_address" name="email_address">
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
            <input type="radio"
                   name="physical_considerations"
                   value="Yes"
                   required>
            Yes
        </label>

        <label>
            <input type="radio"
                   name="physical_considerations"
                   value="No">
            No
        </label>

        <div id="physical_explanation" style="display:none;">
            <label for="physical_explanation_text">
                Please explain
            </label>

            <textarea id="physical_explanation_text"
                      name="physical_explanation_text"></textarea>
        </div>
    </div>

    <!-- Emergency Information -->
    <div class="card-section">
        <h2>Emergency Information</h2>

        <label for="emergency_contact_name">
            Emergency Contact Name
        </label>
        <input type="text"
               id="emergency_contact_name"
               name="emergency_contact_name">

        <label for="emergency_relationship">
            Relationship to You
        </label>
        <input type="text"
               id="emergency_relationship"
               name="emergency_relationship">

        <label for="emergency_phone">
            Emergency Contact Phone
        </label>
        <input type="tel"
               id="emergency_phone"
               name="emergency_phone">
    </div>

    <!-- Skills & Interests -->
    <div class="card-section">
        <h2>Skills & Interests</h2>

        <label for="hobbies_skills_interests">
            Hobbies, Skills & Interests
        </label>
        <textarea id="hobbies_skills_interests"
                  name="hobbies_skills_interests"></textarea>

        <label for="special_training_certification">
            Special Training / Certifications
        </label>
        <textarea id="special_training_certification"
                  name="special_training_certification"></textarea>

        <label for="prompted_by">
            Who Prompted You to Volunteer?
        </label>
        <textarea id="prompted_by"
                  name="prompted_by"></textarea>

        <label for="languages_spoken">
            Languages Spoken
        </label>
        <textarea id="languages_spoken"
                  name="languages_spoken"></textarea>
    </div>

    <button type="submit">
        Submit Volunteer Application
    </button>

</form>
```

</div>

<script>
document.querySelectorAll(
    'input[name="physical_considerations"]'
).forEach(function(radio) {

    radio.addEventListener('change', function() {

        const explanation =
            document.getElementById('physical_explanation');

        if (this.value === 'Yes') {
            explanation.style.display = 'block';
        } else {
            explanation.style.display = 'none';
        }

    });

});
</script>

</body>
</html>


    <script>
    document.querySelectorAll('input[name="physical_considerations"]').forEach(function(radio) {

    radio.addEventListener('change', function() {

        const explanation = document.getElementById('physical_explanation');

        if (this.value === 'Yes') {
            explanation.style.display = 'block';
        } else {
            explanation.style.display = 'none';
        }
    });

});
</script>
</body>
</html>
