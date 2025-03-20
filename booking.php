<?php require_once 'tools.php'; ?>
<?php
$pageTitle = "Russel Street Medical - Booking"; // Set the page title for this specific page
require_once 'head.php'; // Include the common head section

// Define variables for form fields
$patientName = "";
$date = "";
$time = ""; // Single time slot
$reason = "";
$advice = "";
$errors = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve data from the form
    $patientName = $_POST["pid"];
    $date = $_POST["date"];
    $time = $_POST["time"]; // Updated to use a single time slot
    $reason = $_POST["reason"];
    $advice = $_POST["advice"];
    $bookingTime = $_POST["bookingTime"]; // Added to capture booking time

    // Validate form data
    if (empty($patientName) || empty($date) || empty($time) || empty($reason)) {
        $errors[] = "All fields are required.";
    }

    // Check for and handle other validation rules if needed

    if (empty($errors)) {
        // No errors, proceed to save data and show confirmation
        // Prepare the data for writing to appointments.txt
        $data = "$patientName, $date, $time, $reason, $advice, $bookingTime\n";

        // Append data to appointments.txt file
        file_put_contents("appointments.txt", $data, FILE_APPEND);

        // Display a confirmation message to the user
        echo "<div class='confirmation'>Thank you for your booking. We will be in touch soon.</div>";
    }
}
?>
<!-- Rest of your HTML code remains the same -->
<body>
<?php require_once 'header.php'; // Include the common header section ?>
<nav>
    <ul>
        <li><a href="index.php#home">Home</a></li>
        <li><a href="index.php#about">About Us</a></li>
        <li><a href="booking.php#booking">Booking</a></li>
        <li><a href="booking.php#contact">Contact</a></li>
        <li><a href="administration.php">Administration</a></li>
    </ul>
</nav>
<main>
    <!-- Booking Page -->
    <section id="booking">
        <h1> Booking </h1>
        <form name="patient-form" method="POST" action="booking.php">
            <div id="invalid-login" class="error-message">
                <?php   
                // Display errors if any
                if (!empty($errors)) {
                    echo implode("<br>", $errors);
                }
                ?>
            </div>
            <input type="text" name="pid" placeholder="Your Name" required value="<?php echo $patientName; ?>">
            <input type="date" name="date" required value="<?php echo $date; ?>">
            <div class="checkbox-group">
                <input type="checkbox" name="time" id="time-1" value="9 am - 12 pm" class="time-slot" <?php if ($time === "9 am - 12 pm") echo "checked"; ?>>
                <label for="time-1" class="checkbox-button">9 am - 12 pm</label>
            </div>
            <div class="checkbox-group">
                <input type="checkbox" name="time" id="time-2" value="12 pm - 3 pm" class="time-slot" <?php if ($time === "12 pm - 3 pm") echo "checked"; ?>>
                <label for="time-2" class="checkbox-button">12 pm - 3 pm</label>
            </div>
            <div class="checkbox-group">
                <input type="checkbox" name="time" id="time-3" value="3 pm - 6 pm" class="time-slot" <?php if ($time === "3 pm - 6 pm") echo "checked"; ?>>
                <label for="time-3" class="checkbox-button">3 pm - 6 pm</label>
            </div>
            <select name="reason" required>
                <option value="">Please Select</option>
                <option value="Childhood Vaccination Shots" <?php if ($reason === "Childhood Vaccination Shots") echo "selected"; ?>>Childhood Vaccination Shots</option>
                <option value="Influenza Shot" <?php if ($reason === "Influenza Shot") echo "selected"; ?>>Influenza Shot</option>
                <option value="Covid Booster Shot" <?php if ($reason === "Covid Booster Shot") echo "selected"; ?>>Covid Booster Shot</option>
                <option value="Blood Test" <?php if ($reason === "Blood Test") echo "selected"; ?>>Blood Test</option>
            </select>
            <textarea id="advice-textarea" name="advice" rows="5" placeholder="Extra Details"
                      style="resize: none"><?php echo $advice; ?></textarea>
            <!-- Hidden input field for booking time -->
            <input type="hidden" name="bookingTime" value="<?php echo date("Y-m-d H:i:s"); ?>">
            <button type="submit" class="submit-btn">Submit</button>
            <button type="submit" class="submit-btn" formnovalidate>Submit without validation</button>
        </form>
    </section>
</main>

<!-- Footer -->
<?php require_once 'footer.php'; // Include the common footer section ?>
<script src="index.js"></script>
</body>
</html>