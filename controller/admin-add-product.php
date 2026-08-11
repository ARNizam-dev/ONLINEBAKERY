<?php
include '../config.php';
$admin = new Admin();

if (isset($_POST['add_product'])) {
    $category_id = $_POST['category_id'];
    $name = $_POST['name'];
    $description = addslashes($_POST['description']);
    $price = $_POST['price'];
    $kg = $_POST['kg'];
    $stock_quantity = $_POST['stock_quantity'];
    $status = $_POST['status'];
    
    $image = $_FILES['image']['name'];
    $target = "../uploads/".basename($image);

    if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
        $query = "INSERT INTO `products` (`category_id`, `name`, `description`, `price`, `kg`, `stock_quantity`, `image`, `status`) 
                  VALUES ('$category_id', '$name', '$description', '$price', '$kg', '$stock_quantity', '$image', '$status')";
        if ($admin->cud($query, "")) {
            echo "<script>alert('Product added successfully'); window.location.href='../admin/manage-products.php';</script>";
        } else {
            echo "<script>alert('Failed to add product'); window.location.href='../admin/manage-products.php';</script>";
        }
    } else {
        echo "<script>alert('Failed to upload image'); window.location.href='../admin/manage-products.php';</script>";
    }
}
?>
