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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $subject = mysqli_real_escape_string($conn, $_POST['subject']);
    $message = mysqli_real_escape_string($conn, $_POST['message']);

    if (empty($name) || empty($email) || empty($subject) || empty($message)) {
        $response = ["status" => "error", "message" => "Please fill in all required fields."];
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $response = ["status" => "error", "message" => "Please enter a valid email address."];
    } else {
        $stmt = $conn->prepare("INSERT INTO form_submision(name, email, subject, message) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $name, $email, $subject, $message);

        if ($stmt->execute()) {
            $response = ["status" => "success", "message" => "Thank you! Your message has been sent successfully."];
            echo "<script>
                    Swal.fire({
                        title: 'Good job!',
                        text: 'Your message has been sent successfully!',
                        icon: 'success',
                        showConfirmButton: true
                    });
                  </script>";
        } else {
            $response = ["status" => "error", "message" => "Error: " . $stmt->error];
            echo "<script>
                    Swal.fire({
                        title: 'Oops!',
                        text: 'There was an error processing your request.',
                        icon: 'error',
                        showConfirmButton: true
                    });
                  </script>";
        }
    }
}

$conn->close();
?>
