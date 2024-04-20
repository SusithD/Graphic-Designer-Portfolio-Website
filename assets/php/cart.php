<?php
// Establish a database connection (replace with your database details)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "portfolio";

$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Query to retrieve product details from the database
$sql = "SELECT product_name, product_description, product_price FROM cart";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Output product details in a list format
    echo '<ul>';
    while ($row = $result->fetch_assoc()) {
        echo '<li>';
        echo '<strong>Product Name:</strong> ' . $row['product_name'] . '<br>';
        echo '<strong>Product Description:</strong> ' . $row['product_description'] . '<br>';
        echo '<strong>Product Price:</strong> &euro;' . $row['product_price'] . '<br>';
        echo '</li>';
    }
    echo '</ul>';
} else {
    echo "No products found in the database.";
}

// Close the database connection
$conn->close();
?>
