<?php
// Enable error reporting for debugging (remove on production)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    require 'db_connect.php'; // Include DB connection

    // Sanitize and trim inputs
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $location = trim($_POST['location'] ?? '');
    $produce = trim($_POST['preferred_produce'] ?? '');
    $frequency = trim($_POST['frequency'] ?? '');

    // Basic validation
    if (empty($name) || empty($email) || empty($location) || empty($produce) || empty($frequency)) {
        echo "All fields are required. Please go back and fill the form completely.";
        exit;
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Invalid email format. Please go back and correct.";
        exit;
    }

    // Prepare SQL statement to avoid SQL injection
    $stmt = $conn->prepare("INSERT INTO subscriptions (name, email, location, preferred_produce, frequency) VALUES (?, ?, ?, ?, ?)");

    if (!$stmt) {
        die("Prepare failed: (" . $conn->errno . ") " . $conn->error);
    }

    $stmt->bind_param("sssss", $name, $email, $location, $produce, $frequency);

    // Execute query
    if ($stmt->execute()) {
        echo "<h2>Thank you for subscribing, " . htmlspecialchars($name) . "!</h2>";
        echo "<p>We will send fresh produce updates to " . htmlspecialchars($email) . ".</p>";
        echo '<p><a href="index.html">Back to Home</a></p>';
    } else {
        if ($conn->errno === 1062) {  // Duplicate entry error code
            echo "This email is already subscribed.";
        } else {
            echo "Error saving subscription data: " . $conn->error;
        }
    }

    $stmt->close();
    $conn->close();
} else {
    echo "Invalid access method.";
}
?>
