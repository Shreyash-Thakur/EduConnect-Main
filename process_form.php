<?php
// Database Connection
$host = "localhost";
$username = "root";
$password = "";     
$database = "educonnect"; 

// Create Connection
$conn = new mysqli($host, $username, $password, $database);

// Check Connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Form Data Handling
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $message = htmlspecialchars($_POST['message']);

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "<script>alert('Invalid email format. Please try again.'); window.history.back();</script>";
        exit();
    }

    // Corrected Table Name with Backticks
    $stmt = $conn->prepare("INSERT INTO `contact info` (`Name`, `E-Mail`, `Description`) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $name, $email, $message);

    if ($stmt->execute()) {
        echo "<script>alert('Your message has been successfully sent!'); window.location.href='contact.html';</script>";
    } else {
        echo "<script>alert('Error submitting your message. Please try again.'); window.history.back();</script>";
    }

    $stmt->close();
}

$conn->close();
?>
