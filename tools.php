<?php
// tools.php
session_start();

if (isset($_GET['action']) && $_GET['action'] === 'checkPattern') {
    $inputValue = $_GET['input'];
    $isValid = checkPattern($inputValue);
    
    // Return the result as JSON
    echo json_encode(['isValid' => $isValid]);
    exit;
}

function checkPattern($inputValue) {
    $regexPattern = '/^[A-Z]{2}\d+[A-Z\d]$/';
    $isMatch = preg_match($regexPattern, $inputValue);

    return $isMatch;
}

function calculateChecksum($value) {
    $digits = preg_match_all('/\d/', $value, $matches);
    $sum = $digits ? array_sum($matches[0]) : 0;
    return $sum % 26;
}

function convertAndCheck($inputValue) {
    $checksum = calculateChecksum($inputValue);
    $finalChar = chr(65 + $checksum);
    return $inputValue . $finalChar;
}

// Function to read booking data from 'appointments.txt'
function readBookings() {
    $bookings = [];

    // Read the data line by line
    $lines = file('appointments.txt', FILE_IGNORE_NEW_LINES);
    if ($lines) {
        foreach ($lines as $line) {
            // Trim whitespace from the beginning and end of the line
            $line = trim($line);
            $data = explode(',', $line);

            // Check if keys exist before accessing them
            $patientName = isset($data[0]) ? trim($data[0]) : '';
            $date = isset($data[1]) ? trim($data[1]) : '';
            $times = isset($data[2]) ? explode(', ', trim($data[2])) : [];
            $reason = isset($data[3]) ? trim($data[3]) : '';
            $advice = isset($data[4]) ? trim($data[4]) : '';
            $bookingTime = isset($data[5]) ? trim($data[5]) : '';

            // Replace '|||' with line breaks in advice
            $advice = str_replace("|||", "\n", $advice);

            $bookings[] = [
                'patientName' => $patientName,
                'date' => $date,
                'times' => $times,
                'reason' => $reason,
                'advice' => $advice,
                'bookingTime' => $bookingTime
            ];
        }
    }

    return $bookings;
}

// Function to save booking data to 'appointments.txt'
function saveBookings($bookings) {
    $lines = [];
    foreach ($bookings as $booking) {
        // Check if keys exist before accessing them
        $patientName = isset($booking['patientName']) ? trim($booking['patientName']) : '';
        $date = isset($booking['date']) ? trim($booking['date']) : '';
        $times = isset($booking['times']) ? implode(', ', array_map('trim', $booking['times'])) : '';
        $reason = isset($booking['reason']) ? trim($booking['reason']) : '';
        $advice = isset($booking['advice']) ? trim($booking['advice']) : '';
        $bookingTime = isset($booking['bookingTime']) ? trim($booking['bookingTime']) : '';

        // Replace line breaks with '|||' before saving
        $advice = str_replace("\n", "|||", $advice);

        // Construct the line for this booking
        $line = "$patientName, $date, $times, $reason, $advice, $bookingTime";

        // Add the line to the array of lines
        $lines[] = $line;
    }

    // Join the lines with newline characters and save the data back to 'appointments.txt'
    $data = implode(PHP_EOL, $lines);
    if (file_put_contents('appointments.txt', $data) === false) {
        error_log("Error saving data to appointments.txt");
    } else {
        error_log("Data saved successfully"); // Add this line for debugging
    }
}

// Function to read user data from 'users.txt'
function readUsers() {
    $users = [];

    // Read the data line by line
    $lines = file('users.txt', FILE_IGNORE_NEW_LINES);
    if ($lines) {
        foreach ($lines as $line) {
            $userData = explode(' : ', $line);

            // Check if keys exist before accessing them
            $username = isset($userData[0]) ? $userData[0] : '';

            $users[] = $username;
        }
    }

    return $users;
}

// Function to save user data to 'users.txt'
function saveUser($username, $password) {
    // Read existing usernames
    $existingUsers = readUsers();

    // Check if the username already exists
    if (!in_array($username, $existingUsers)) {
        // Append the new user to 'users.txt' with the format "username : password"
        $userLine = $username . ' : ' . $password . PHP_EOL;

        // Save the user data to 'users.txt'
        if (file_put_contents('users.txt', $userLine, FILE_APPEND | LOCK_EX) !== false) {
            return true; // User added successfully
        } else {
            error_log("Error saving user data to users.txt");
        }
    } else {
        return false; // User with the same username already exists
    }
}

function displayValidationResult($inputValue) {
    $errorMessage = "";
    $isValid = checkPattern($inputValue);

    if ($isValid) {
        $errorMessage = "none";
    } else {
        $errorMessage = "block";
    }

    return $errorMessage;
}

function convertToUppercase($inputValue) {
    return strtoupper($inputValue);
}

function generateFinalValue($inputValue) {
    $checksum = calculateChecksum($inputValue);
    $finalChar = chr(65 + $checksum);
    return $inputValue . $finalChar;
}

function generateAdviceText($selectedOption) {
    $adviceText = [
        "Childhood Vaccination Shots" => "A disclaimer that multiple vaccines are normally administered in combination and may cause the child to be sluggish or feverous for 24 – 48 hours afterwards.",
        "Influenza Shot" => "The best time to get vaccinated is in April and May each year for optimal protection over the winter months.",
        "Covid Booster Shot" => "Advice that everyone should arrange to have their third shot as soon as possible and adults over the age of 30 should have their fourth shot to protect against new variant strains.",
        "Blood Test" => "That some tests require some fasting ahead of time and that a staff member will advise them on this prior to the appointment."
    ];

    return isset($adviceText[$selectedOption]) ? $adviceText[$selectedOption] : "";
}
?>