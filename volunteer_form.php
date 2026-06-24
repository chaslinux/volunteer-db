<?php
session_start();
if (isset($_SESSION['admin'])) {
    $isAdmin = true;
} else {
    $isAdmin = false;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Volunteer Form</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h1>Volunteer Information</h1>
        <form action="submit_volunteer.php" method="post">
            <!-- Contact Information -->
            <div class="section">
                <h2>Contact Information</h2>
                <label for="first_name">First Name(s):</label>
                <input type="text" id="first_name" name="first_name" required><br>

                <label for="last_name">Last Name(s):</label>
                <input type="text" id="last_name" name="last_name" required><br>

                <label for="date_applied">Date Applied:</label>
                <input type="date" id="date_applied" name="date_applied" value="<?php echo date('Y-m-d'); ?>" required><br>

                <!-- Optional Fields -->
                <label for="street_address">Street Address:</label>
                <input type="text" id="street_address" name="street_address"><br>

                <label for="city">City:</label>
                <input type="text" id="city" name="city"><br>

                <label for="province">Province:</label>
                <select id="province" name="province">
                    <option value="">Select</option>
                    <option value="Ontario">Ontario</option>
                    <option value="Just Visiting">Just Visiting</option>
                </select><br>

                <label for="postal_code">Postal Code:</label>
                <input type="text" id="postal_code" name="postal_code"><br>

                <label for="contact_phone">Contact Phone:</label>
                <input type="tel" id="contact_phone" name="contact_phone"><br>

                <label for="email_address">Email Address:</label>
                <input type="email" id="email_address" name="email_address">
            </div>

            <!-- Availability -->
            <div class="section">
                <h2>Availability</h2>
                <label><input type="checkbox" name="tuesday_9am_12pm"> Tuesday 9:30am – 12pm</label><br>
                <label><input type="checkbox" name="tuesday_1pm_4pm"> Tuesday 1pm – 4pm</label><br>
                <label><input type="checkbox" name="wednesday_9am_12pm"> Wednesday 9:30am – 12pm</label><br>
                <label><input type="checkbox" name="wednesday_1pm_4pm"> Wednesday 1pm – 4pm</label><br>
                <label><input type="checkbox" name="thursday_9am_12pm"> Thursday 9:30am – 12pm</label><br>
                <label><input type="checkbox" name="thursday_1pm_4pm"> Thursday 1pm – 4pm</label><br>

                <!-- Not currently available options -->
                <p>Monday, Friday, and Saturday will be available in the future.</p>
            </div>

            <!-- Physical Considerations -->
            <div class="section">
                <h2>Physical Considerations</h2>
                <label><input type="radio" name="physical_considerations" value="Yes"> Yes</label>
                <label><input type="radio" name="physical_considerations" value="No"> No</label><br>

                <div id="physical_explanation" style="display:none;">
                    <label for="physical_explanation_text">Please explain:</label>
                    <textarea id="physical_explanation_text" name="physical_explanation_text"></textarea>
                </div>
            </div>

            <!-- Emergency Information -->
            <div class="section">
                <h2>Emergency Information</h2>
                <label for="emergency_contact_name">Emergency Contact Name:</label>
                <input type="text" id="emergency_contact_name" name="emergency_contact_name"><br>

                <label for="emergency_relationship">Relationship to you:</label>
                <input type="text" id="emergency_relationship" name="emergency_relationship"><br>

                <label for="emergency_phone">Contact Phone #:</label>
                <input type="tel" id="emergency_phone" name="emergency_phone">
            </div>

            <!-- Skills and Interests -->
            <div class="section">
                <h2>Skills and Interests</h2>
                <label for="hobbies_skills_interests">Hobbies, skills, and interests:</label><br>
                <textarea id="hobbies_skills_interests" name="hobbies_skills_interests"></textarea><br>

                <label for="special_training_certification">Special training, certification:</label><br>
                <textarea id="special_training_certification" name="special_training_certification"></textarea><br>

                <label for="prompted_by">Who prompted you to volunteer?</label><br>
                <textarea id="prompted_by" name="prompted_by"></textarea><br>

                <label for="languages_spoken">Languages spoken:</label><br>
                <textarea id="languages_spoken" name="languages_spoken"></textarea>
            </div>

            <button type="submit">Submit</button>
        </form>
    </div>

    <script>
        document.querySelector('input[name="physical_considerations"]').addEventListener('change', function() {
            if (this.value === 'Yes') {
                document.getElementById('physical_explanation').style.display = 'block';
            } else {
                document.getElementById('physical_explanation').style.display = 'none';
            }
        });
    </script>
</body>
</html>
