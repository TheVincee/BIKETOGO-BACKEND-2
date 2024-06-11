<?php
session_start();
require "connection.php";

if(isset($_POST['productName'])) {
    $productName = mysqli_real_escape_string($con, $_POST['productName']);
    $category = mysqli_real_escape_string($con, $_POST['productCategory']);
    $price = mysqli_real_escape_string($con, $_POST['productPrice']);
    $quantity = mysqli_real_escape_string($con, $_POST['productQuantity']);
    $description = mysqli_real_escape_string($con, $_POST['productDescription']);
    // Assuming you're handling file upload separately and storing the file path in $productphoto
    $picture = mysqli_real_escape_string($con, $_POST['productPhoto']);

    $query = "INSERT INTO products (Picture, ProductName, Category, Price, Quantity, Description) 
              VALUES ('$picture', '$productName', '$category', '$price', '$quantity', '$description')";

    $query_run = mysqli_query($con, $query);
    if($query_run) {
        $_SESSION['message'] = "Product Successfully Added";
        header("Location: add_product.php");
        exit(0);
    } else {
        $_SESSION['message'] = "Product Not Added";
        header("Location: add_product.php");
        exit(0);
    }
}
?>
