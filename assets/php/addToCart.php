<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $productName = $_POST['name'];
    $productDescription = $_POST['description'];
    $productPrice = $_POST['price'];

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "portfolio";


    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }


    $insertQuery = "INSERT INTO cart (product_name, product_description, product_price) VALUES (?, ?, ?)";

    $stmt = $conn->prepare($insertQuery);
    $stmt->bind_param("ssd", $productName, $productDescription, $productPrice);

    if ($stmt->execute()) {
        echo "Product added to cart successfully!";
    } else {
        echo "Error: " . $conn->error;
    }

    $stmt->close();
    $conn->close();
}
?>
