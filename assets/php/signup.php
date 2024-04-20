<?php
// Step 1: Set up a database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "portfolio";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = $_POST['ipassword'];


    // You should perform validation and security measures here before database insertion.

    // Insert the data into the database
    $sql = "INSERT INTO users (username, email, ipassword) VALUES ('$username', '$email', '$password')";

    if ($conn->query($sql) === TRUE) {
        $response = ["status" => "success", "message" => "Registration successful. You can now log in."];
        header("Location: ../../login.html");
        exit;
    } else {
        $response = ["status" => "error", "message" => "Error: " . $conn->error];
    }
}

$conn->close();
?>
