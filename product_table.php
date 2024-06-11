<?php 
require 'connection.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bootstrap Table Example</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <?php
        if(isset($_SESSION['message'])) {
            echo '<div class="alert alert-success">' . $_SESSION['message'] . '</div>';
            unset($_SESSION['message']);
        }
        ?>
        <div class="d-flex justify-content-between mb-4">
            <h2>Product Table</h2>
            <a href="add_product.php" class="btn btn-primary">Create Product</a>
        </div>
        <table class="table table-bordered table-hover">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">Product ID</th>
                    <th scope="col">Picture</th>
                    <th scope="col">Product Name</th>
                    <th scope="col">Category</th>
                    <th scope="col">Price (₱)</th>
                    <th scope="col">Quantity</th>
                    <th scope="col">Description</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $query = "SELECT * FROM products";
                $query_run = mysqli_query($con, $query);

                if(mysqli_num_rows($query_run) > 0)
                {
                    foreach($query_run as $product)
                    {
                        ?>
                        <tr>
                            <td><?php echo $product['ProductID']; ?></td>
                            <td><img src="<?php echo $product['Picture']; ?>" alt="Product Image" style="width: 50px; height: auto;"></td>
                            <td><?php echo $product['ProductName']; ?></td>
                            <td><?php echo $product['Category']; ?></td>
                            <td><?php echo $product['Price']; ?></td>
                            <td><?php echo $product['Quantity']; ?></td>
                            <td><?php echo $product['Description']; ?></td>
                            <td>
                                <div class="btn-group" role="group" aria-label="Actions">
                                    <a href="ViewProduct.php?ProductID=<?php echo $product['ProductID']; ?>" class="btn btn-primary btn-sm">View</a>
                                    <form action="delete_product.php" method="POST" class="d-inline">
                                        <input type="hidden" name="ProductID" value="<?php echo $product['ProductID']; ?>">
                                        <button type="submit" name="delete_product" class="btn btn-danger btn-sm">Delete</button>
                                    </form>
                                    <a href="update.php?ProductID=<?php echo $product['ProductID']; ?>" class="btn btn-info btn-sm">Update</a>
                                </div>
                            </td>
                        </tr>
                        <?php
                    } 
                }
                else
                {
                    echo "<tr><td colspan='8'><h5>No Records Found</h5></td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

</script>
    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
