<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "portfolio";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if email and password fields have been submitted
    if (isset($_POST['email']) && isset($_POST['password'])) {
        $email = $_POST['email'];
        $password = $_POST['password'];

        // Query the database to get the stored password
        $stmt = $conn->prepare("SELECT ipassword FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->bind_result($storedPassword);

        if ($stmt->fetch() && $password === $storedPassword) {
            // Password is correct; log the user in
            $_SESSION['user'] = $email;
            header("Location: ../../Shop.html");
            exit;
        } else {
            // Password is incorrect; show an error message
            echo "Invalid email or password. Please try again.";
        }

        $stmt->close();
    } else {
        // Handle case where email and/or password are not set
        echo "Email and password are required.";
    }
}

$conn->close();
?>
