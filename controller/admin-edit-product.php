<?php
include '../config.php';
$admin = new Admin();

if (isset($_POST['edit_product'])) {
    $product_id = $_POST['product_id'];
    $category_id = $_POST['category_id'];
    $name = $_POST['name'];
    $description = addslashes($_POST['description']);
    $price = $_POST['price'];
    $kg = $_POST['kg'];
    $stock_quantity = $_POST['stock_quantity'];
    $status = $_POST['status'];
    
    if (!empty($_FILES['image']['name'])) {
        $image = $_FILES['image']['name'];
        $target = "../uploads/".basename($image);
        move_uploaded_file($_FILES['image']['tmp_name'], $target);
        $query = "UPDATE `products` SET `category_id`='$category_id', `name`='$name', `description`='$description', `price`='$price', `kg`='$kg', `stock_quantity`='$stock_quantity', `image`='$image', `status`='$status' WHERE `product_id`='$product_id'";
    } else {
        $query = "UPDATE `products` SET `category_id`='$category_id', `name`='$name', `description`='$description', `price`='$price', `kg`='$kg', `stock_quantity`='$stock_quantity', `status`='$status' WHERE `product_id`='$product_id'";
    }

    if ($admin->cud($query, "")) {
        echo "<script>alert('Product updated successfully'); window.location.href='../admin/manage-products.php';</script>";
    } else {
        echo "<script>alert('Failed to update product'); window.location.href='../admin/manage-products.php';</script>";
    }
}
?>
