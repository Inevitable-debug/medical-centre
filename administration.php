<?php require_once 'tools.php';

if (isset($_POST['logout'])) {
    // Handle logout request
    session_destroy(); // Destroy the session data
    header('Location: administration.php'); // Redirect to the login page
    exit();
}

$bookings = readBookings();

if (isset($_SESSION['user'])) {
    // User is logged in, show the administration content
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST['editBooking'])) {
            // Check if 'bookingIndex' is set and is an array
            if (isset($_POST['bookingIndex']) && is_array($_POST['bookingIndex'])) {
                $bookingIndices = $_POST['bookingIndex'];
    
                foreach ($bookingIndices as $index) {
                    // Find the booking in the array based on the index
                    $booking = $bookings[$index];
    
                    // Update the booking details with the submitted data
                    $booking['date'] = $_POST['date'][$index];
                    $booking['times'] = $_POST['times'][$index];
                    $booking['reason'] = $_POST['reason'][$index];
                    $booking['advice'] = $_POST['advice'][$index];
    
                    // Update the booking in the $bookings array
                    $bookings[$index] = $booking;
                }
    
                // Save the updated bookings data to 'appointments.txt'
                saveBookings($bookings);
    
                // Redirect to the same page to prevent form resubmission
                header('Location: administration.php');
                exit();
            } else {
                // Handle the case where 'bookingIndex' is not an array
                // You can display an error message or take appropriate action here
            }
        }
    }
    
    // Show the administration content
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Administration</title>
        <!-- Include Bootstrap CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <link rel="stylesheet" href="custom.css">
    </head>
    <body>
        <div class="container mt-5">
            <nav>
                <ul>
                    <li><a href="index.php">Home</a></li>
                    <li><a href="booking.php">Booking</a></li>
                    <li><a href="administration.php">Administration</a></li>
                </ul>
            </nav>
            <div class="col-md-6">
                <h2>Welcome, <?php echo $_SESSION['user']; ?>!</h2>
                <h3>Booking Requests</h3>
                <!-- Display the booking requests in a table -->
                <form method="post">
                    <div id="success_message" class="alert alert-success" style="display: none;"></div>
                    <div id="error_message" class="alert alert-danger" style="display: none;"></div>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Patient Name</th>
                                <th>Date</th>
                                <th>Times</th>
                                <th>Reason</th>
                                <th>Advice</th>
                                <th>Booking Time</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($bookings as $index => $booking): ?>
                                <tr>
                                    <td><?php echo $booking['patientName']; ?></td>
                                    <td>
                                        <input type="date" class="form-control" name="date[<?php echo $index; ?>]" value="<?php echo $booking['date']; ?>">
                                    </td>
                                    <td>
                                        <select class="form-control times" name="times[<?php echo $index; ?>][]">
                                            <?php
                                            $timeSlots = ["9 am - 12 pm", "12 pm - 3 pm", "3 pm - 6 pm"];
                                            foreach ($timeSlots as $slot) {
                                                echo '<option value="' . $slot . '" ';
                                                if (in_array($slot, $booking['times'])) {
                                                    echo 'selected';
                                                }
                                                echo '>' . $slot . '</option>';
                                            }
                                            ?>
                                        </select>
                                    </td>
                                    <td>
                                        <select class="form-control reason" name="reason[<?php echo $index; ?>]">
                                            <option value="Childhood Vaccination Shots" <?php if ($booking['reason'] === "Childhood Vaccination Shots") echo "selected"; ?>>Childhood Vaccination Shots</option>
                                            <option value="Influenza Shot" <?php if ($booking['reason'] === "Influenza Shot") echo "selected"; ?>>Influenza Shot</option>
                                            <option value="Covid Booster Shot" <?php if ($booking['reason'] === "Covid Booster Shot") echo "selected"; ?>>Covid Booster Shot</option>
                                            <option value="Blood Test" <?php if ($booking['reason'] === "Blood Test") echo "selected"; ?>>Blood Test</option>
                                        </select>
                                    </td>
                                    <td>
                                        <textarea class="form-control advice" name="advice[<?php echo $index; ?>]" rows="3"><?php echo str_replace("|||", "\n", $booking['advice']); ?></textarea>
                                    </td>
                                    <td><?php echo $booking['bookingTime']; ?></td>
                                    <td>
                                        <input type="hidden" name="bookingIndex[]" value="<?php echo $index; ?>">
                                        <button type="submit" name="editBooking" class="btn btn-primary">Edit</button>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </form>
            </div>
            <div class="col-md-6">
                <!-- Create a new user form -->
                <form method="post">
                    <h3>Create a New User</h3>
                    <?php
                    if (isset($_POST['createUser'])) {
                        $newUsername = $_POST['newUsername'];
                        $newPassword = $_POST['newPassword'];

                        // Attempt to save the new user
                        $userAdded = saveUser($newUsername, $newPassword);

                        if (!$userAdded) {
                            echo '<div class="alert alert-danger">Error: User \'' . htmlspecialchars($newUsername) . '\' already exists.</div>';
                        }
                    }
                    ?>
                    <div class="form-group">
                        <label for="newUsername">Username:</label>
                        <input type="text" class="form-control" id="newUsername" name="newUsername" required>
                    </div>
                    <div class="form-group">
                        <label for="newPassword">Password:</label>
                        <input type="password" class="form-control" id="newPassword" name="newPassword" required>
                    </div>
                    <button type="submit" name="createUser" class="btn btn-success">Create User</button>
                </form>
            </div>
            <div class="row mt-5">
                <div class="col-md-12">
                    <form method="post">
                        <button type="submit" name="logout" class="btn btn-danger float-right">Logout</button>
                    </form>
                </div>
            </div>
        </div>
        <!-- Include Bootstrap JS -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <!-- Include Bootstrap JS -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    </body>
    </html>
    <?php
} else {
    // User is not logged in, show the login form
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Check the submitted username and password
        $username = $_POST['username'];
        $password = $_POST['password'];

        // Check if the username exists and the password is correct
        $validUser = false;
        $lines = file('users.txt', FILE_IGNORE_NEW_LINES);
        if ($lines) {
            foreach ($lines as $line) {
                $userData = explode(' : ', $line);

                // Check if keys exist before accessing them
                $storedUsername = isset($userData[0]) ? $userData[0] : '';
                $storedPassword = isset($userData[1]) ? $userData[1] : '';

                if ($username === $storedUsername && $password === $storedPassword) {
                    $validUser = true;
                    break;
                }
            }
        }

        if ($validUser) {
            $_SESSION['user'] = $username; // Store the username in the session
            header('Location: administration.php'); // Redirect to the administration page
            exit();
        } else {
            $error_message = "Invalid username or password";

            // Log unsuccessful login attempt
            $logMessage = "Unsuccessful login attempt for username: $username at " . date('Y-m-d H:i:s') . PHP_EOL;
            file_put_contents('accessattempts.txt', $logMessage, FILE_APPEND | LOCK_EX);
        }
    }
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <nav>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="booking.php">Booking</a></li>
                <li><a href="administration.php">Administration</a></li>
            </ul>
        </nav>
        <title>Login</title>
        <!-- Include Bootstrap CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    </head>
    <body>
        <div class="container mt-5">
            <div class="row">
                <div class="col-md-6">
                    <!-- Login form -->
                    <form method="post">
                        <h3>Login</h3>
                        <?php if (isset($error_message)): ?>
                            <div class="alert alert-danger"><?php echo $error_message; ?></div>
                        <?php endif; ?>
                        <div class="form-group">
                            <label for="username">Username:</label>
                            <input type="text" class="form-control" id="username" name="username" required>
                        </div>
                        <div class="form-group">
                            <label for="password">Password:</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Login</button>
                    </form>
                </div>
            </div>
        </div>
        <!-- Include Bootstrap JS -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <!-- Include Bootstrap JS -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    </body>
    </html>
    <?php
}
?>
