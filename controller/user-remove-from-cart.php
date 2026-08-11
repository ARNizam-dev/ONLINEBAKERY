<?php
include '../config.php';

// Check if cart needs removal or updates handled elsewhere
if (isset($_GET['id'])) {
    $cart_id = $_GET['id'];
    $admin = new Admin();
    
    $query = "DELETE FROM `cart` WHERE `cart_id`='$cart_id'";
    if ($admin->cud($query, "")) {
        echo "<script>alert('Item removed from cart'); window.location.href='../cart.php';</script>";
    } else {
        echo "<script>alert('Failed to remove item'); window.location.href='../cart.php';</script>";
    }
}
?>
