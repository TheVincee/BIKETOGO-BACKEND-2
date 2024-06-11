<?php
session_start();
require "connection.php";

if (isset($_POST['ProductID'])) {
    $Product_Id = mysqli_real_escape_string($con, $_POST['ProductID']);
    $ProductName = mysqli_real_escape_string($con, $_POST['productName']);
    $ProductCategory = mysqli_real_escape_string($con, $_POST['productCategory']);
    $ProductPrice = mysqli_real_escape_string($con, $_POST['productPrice']);
    $ProductQuantity = mysqli_real_escape_string($con, $_POST['productQuantity']);
    $ProductDescription = mysqli_real_escape_string($con, $_POST['productDescription']);
    $ProductPhoto = $_FILES['productPhoto']['name'];
    $ProductPhoto_tmp = $_FILES['productPhoto']['tmp_name'];

    // File upload path
    if ($ProductPhoto) {
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($ProductPhoto);
        move_uploaded_file($ProductPhoto_tmp, $target_file);

        $query = "UPDATE products SET 
                  ProductName = '$ProductName', 
                  Category = '$ProductCategory', 
                  Price = '$ProductPrice', 
                  Quantity = '$ProductQuantity', 
                  Description = '$ProductDescription', 
                  Photo = '$target_file' 
                  WHERE ProductID = '$Product_Id'";
    } else {
        $query = "UPDATE products SET 
                  ProductName = '$ProductName', 
                  Category = '$ProductCategory', 
                  Price = '$ProductPrice', 
                  Quantity = '$ProductQuantity', 
                  Description = '$ProductDescription' 
                  WHERE ProductID = '$Product_Id'";
    }

    if (mysqli_query($con, $query)) {
        $_SESSION['message'] = "Product updated successfully";
        $_SESSION['msg_type'] = "success";
    } else {
        $_SESSION['message'] = "Failed to update product";
        $_SESSION['msg_type'] = "danger";
    }

    header("Location: product_table.php?ProductID=$Product_Id");
    exit();
} else {
    $_SESSION['message'] = "Invalid request";
    $_SESSION['msg_type'] = "danger";
    header("Location: product_table.php");
    exit();
}
?>
