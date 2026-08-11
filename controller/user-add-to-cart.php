<?php
include '../config.php';
$admin = new Admin();

if (isset($_POST['add_to_cart'])) {
    if (!isset($_SESSION['user_id'])) {
        echo "<script>alert('Please login first'); window.location.href='../login.php';</script>";
        exit;
    }

    $user_id = $_SESSION['user_id'];
    $product_id = $_POST['product_id'];
    $quantity = $_POST['quantity'];
    $price = $_POST['price'];

    $stmt = $admin->ret("SELECT * FROM `cart` WHERE `user_id`='$user_id' AND `product_id`='$product_id'");
    
    if ($stmt->rowCount() > 0) {
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $new_quantity = $row['quantity'] + $quantity;
        $query = "UPDATE `cart` SET `quantity`='$new_quantity' WHERE `user_id`='$user_id' AND `product_id`='$product_id'";
    } else {
        $query = "INSERT INTO `cart` (`user_id`, `product_id`, `quantity`, `price`) VALUES ('$user_id', '$product_id', '$quantity', '$price')";
    }

    if ($admin->cud($query, "")) {
        echo "<script>alert('Added to cart successfully'); window.location.href=document.referrer;</script>";
    } else {
        echo "<script>alert('Failed to add to cart'); window.location.href=document.referrer;</script>";
    }
}
?>
