<?php
session_start();
require "connection.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Update Product Form</title>
<!-- Bootstrap CSS -->
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2 class="mb-4">Update Product</h2>
    <?php
    if (isset($_GET['ProductID'])) {
        $Product_Id = mysqli_real_escape_string($con, $_GET['ProductID']);
        $query = "SELECT * FROM products WHERE ProductID = '$Product_Id'";
        $query_run = mysqli_query($con, $query);

        if (mysqli_num_rows($query_run) > 0) {
            $product = mysqli_fetch_array($query_run);
        } else {
            echo "<div class='alert alert-danger'>Product not found</div>";
        }
    } else {
        echo "<div class='alert alert-danger'>Invalid Product ID</div>";
    }
    ?>
    <!-- Alert placeholder -->
    <div id="liveAlertPlaceholder"></div>
    
    <form id="productForm" method="POST" action="Updateprocess.php" enctype="multipart/form-data">
        <input type="hidden" name="ProductID" value="<?php echo $product['ProductID']; ?>">
        <div class="form-group">
            <label for="productName">Product Name</label>
            <input type="text" class="form-control" name="productName" id="productName" value="<?php echo $product['ProductName']; ?>" placeholder="Enter product name" required>
        </div>
        <div class="form-group">
            <label for="productCategory">Category</label>
            <select class="form-control" name="productCategory" id="productCategory" required>
                <option value="">Select category</option>
                <option value="electronics" <?php echo ($product['Category'] == 'electronics') ? 'selected' : ''; ?>>Electronics</option>
                <option value="clothing" <?php echo ($product['Category'] == 'clothing') ? 'selected' : ''; ?>>Clothing</option>
                <option value="home" <?php echo ($product['Category'] == 'home') ? 'selected' : ''; ?>>Home & Kitchen</option>
                <!-- Add more categories as needed -->
            </select>
        </div>
        <div class="form-group">
            <label for="productPrice">Price</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">₱</span>
                </div>
                <input type="number" class="form-control" name="productPrice" id="productPrice" value="<?php echo $product['Price']; ?>" placeholder="Enter product price" required>
            </div>
        </div>
        <div class="form-group">
            <label for="productQuantity">Quantity</label>
            <input type="number" class="form-control" name="productQuantity" id="productQuantity" value="<?php echo $product['Quantity']; ?>" placeholder="Enter product quantity" required>
        </div>
        <div class="form-group">
            <label for="productDescription">Description</label>
            <textarea class="form-control" name="productDescription" id="productDescription" rows="3" placeholder="Enter product description"><?php echo $product['Description']; ?></textarea>
        </div>
        <div class="form-group">
            <label for="productPhoto">Upload Photo</label>
            <input type="file" class="form-control-file" name="productPhoto" id="productPhoto">
        </div>
        <button type="submit" class="btn btn-primary">Update Product</button>
    </form>
</div>

<!-- Bootstrap JS and dependencies -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="script.js"></script>
</body>
</html>
