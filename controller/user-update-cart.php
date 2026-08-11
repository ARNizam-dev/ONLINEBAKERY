<?php
include '../config.php';
$admin = new Admin();

if (isset($_POST['update_cart'])) {
    foreach ($_POST['cart_id'] as $key => $cart_id) {
        $quantity = $_POST['quantity'][$key];
        $query = "UPDATE `cart` SET `quantity`='$quantity' WHERE `cart_id`='$cart_id'";
        $admin->cud($query, "");
    }
    echo "<script>alert('Cart updated'); window.location.href='../cart.php';</script>";
}
?>
