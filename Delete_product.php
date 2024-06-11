<?php
session_start();
require 'connection.php';

if (isset($_POST['delete_product'])) {
    $Product_Id = mysqli_real_escape_string($con, $_POST['ProductID']);

    $query = "DELETE FROM products WHERE ProductID = '$Product_Id'";
    $query_run = mysqli_query($con, $query);

    if ($query_run) {
        $_SESSION['message'] = "Product deleted successfully!";
        $_SESSION['alert_type'] = "success";
    } else {
        $_SESSION['message'] = "Failed to delete product.";
        $_SESSION['alert_type'] = "danger";
    }

    header("Location: product_table.php");
    exit(0);
} else {
    header("Location: product_table.php");
    exit(0);
}
