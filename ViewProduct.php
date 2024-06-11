<?php
session_start();
require "connection.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Product Description</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <?php
        if(isset($_GET['ProductID']))
        {
            $Product_Id = mysqli_real_escape_string($con, $_GET['ProductID']);
            $query = "SELECT * FROM products WHERE ProductID = '$Product_Id'";
            $query_run = mysqli_query($con, $query);

            if(mysqli_num_rows($query_run) > 0) {
                $product = mysqli_fetch_array($query_run);
            } else {
                echo "<p>Product not found.</p>";
                exit();
            }
        }
        ?>
        <h2 class="mb-4">View Product Details</h2>
        <div class="row">
            <div class="col-md-4">
                <img src="path_to_image.jpg" alt="Product Image" class="img-fluid">
            </div>
            <div class="col-md-8">
                <div class="form-group">
                    <label for="productName">Product Name</label>
                    <p id="productName" class="form-control"><?php echo htmlspecialchars($product['ProductName']); ?></p>
                </div>
                <div class="form-group">
                    <label for="category">Category</label>
                    <p id="category" class="form-control"><?php echo htmlspecialchars($product['Category']); ?></p>
                </div>
                <div class="form-group">
                    <label for="price">Price (₱)</label>
                    <p id="price" class="form-control"><?php echo htmlspecialchars($product['Price']); ?></p>
                </div>
                <div class="form-group">
                    <label for="quantity">Quantity</label>
                    <p id="quantity" class="form-control"><?php echo htmlspecialchars($product['Quantity']); ?></p>
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    <p id="description" class="form-control"><?php echo htmlspecialchars($product['Description']); ?></p>
                </div>
                <a href="product_table.php?ProductID=<?php echo $product['ProductID']; ?>" class="btn btn-info btn-sm">Back To table</a>
                </div>
        </div>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
