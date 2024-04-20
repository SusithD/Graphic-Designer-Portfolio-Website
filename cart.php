<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Metadata -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description"
        content="Susith Deshan's freelance design portfolio showcases his talent and creativity. Explore his best projects and get inspired for your next design endeavor.">
    <title>Susith Deshan Alwis | Freelance Designer | Shop</title>

    <!-- Google Fonts -->
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link rel="stylesheet" href="assets/vendor/aos/aos.css">
    <link rel="stylesheet" href="assets/vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/vendor/bootstrap-icons/bootstrap-icons.css">
    <link rel="stylesheet" href="assets/vendor/boxicons/css/boxicons.min.css">
    <link rel="stylesheet" href="assets/vendor/glightbox/css/glightbox.min.css">
    <link rel="stylesheet" href="assets/vendor/swiper/swiper-bundle.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- Template Main CSS File -->
    <link rel="stylesheet" href="assets/css/cart.css">
</head>

<body>
    <div class="card">
        <div class="row">
            <div class="col-md-8 cart">
                <div class="title">
                    <div class="row">
                        <div class="col">
                            <h4><b>Shopping Cart</b></h4>
                        </div>
                    </div>
                </div>
                <!-- Cart items -->
                <?php
                $servername = "localhost";
                $username = "root";
                $password = "";
                $dbname = "portfolio";

                $conn = new mysqli($servername, $username, $password, $dbname);

                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                // SQL query to retrieve items from the cart
                $selectQuery = "SELECT * FROM cart";

                $result = $conn->query($selectQuery);

                if ($result->num_rows > 0) {
                    ?>
                    <table class="cart-table">
                        <thead>
                            <tr>
                                <th>Product Name</th>
                                <th>Product Description</th>
                                <th>Quantity</th>
                                <th>Price</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $counter = 1; // Initialize a counter for product numbering
                            while ($row = $result->fetch_assoc()) {
                                $productName = $row['product_name'];
                                $productDescription = $row['product_description'];
                                $productPrice = $row['product_price'];
                            ?>
                            <tr>
                                <td class="product-name"><?php echo $productName; ?></td>
                                <td class="product-description"><?php echo $productDescription; ?></td>
                                <td>
                                    <a href="#" class="quantity-control">-</a>
                                    <span class="quantity-count"><?php echo $counter; ?></span> <!-- Display the counter -->
                                    <a href="#" class="quantity-control">+</a>
                                </td>
                                <td>&euro; <?php echo $productPrice; ?></td>
                                <td><span class="close-button" onclick="deleteProductRow(this)">&#10005;</span></td>
                            </tr>
                            <?php
                                $counter++; // Increment the counter for the next product
                            }
                            ?>
                        </tbody>
                    </table>
                    <?php
                } else {
                    echo '<p class="empty-cart">Your cart is empty.</p>';
                }
                
                

                // Close the database connection
                $conn->close();
                ?>
                <!-- End of cart items -->
                
            </div>

            <div class="col-md-4 summary">
                <div>
                    <h5><b>Summary</b></h5>
                </div>
                <hr>
                <div class="row">
                    <div class="col text-right">&euro; 132.00</div>
                </div>
                <form>
                    <p>Customer Support</p>
                    <select>
                        <option class="text-muted">Standard-Delivery- &euro;5.00</option>
                    </select>
                    <p>Provide Code</p>
                    <input id="code" placeholder="Enter your code">
                </form>
                <div class="row" style="border-top: 1px solid rgba(0,0,0,.1); padding: 2vh 0;">
                    <div class="col">TOTAL PRICE</div>
                    <div class="col text-right">&euro; 137.00</div>
                </div>
                <button class="btn">CHECKOUT</button>
            </div>
        </div>

    </div>

    <script>
    function deleteProductRow(closeButton) {
        let row = closeButton.closest('tr');
        let productId = row.getAttribute('data-product-id');
        row.remove(); 
    }
</script>
</body>

</html>