<?php
include '../config.php';
$admin = new Admin();

if (isset($_POST['update_status'])) {
    $order_id = $_POST['order_id'];
    $order_status = $_POST['order_status']; // Picked Up, Out for Delivery, Delivered, Failed Delivery
    
    $query = "UPDATE `orders` SET `order_status`='$order_status' WHERE `order_id`='$order_id'";

    if ($admin->cud($query, "")) {
        echo "<script>alert('Order Status updated successfully'); window.location.href='../DeliveryPerson/assigned-work.php';</script>";
    } else {
        echo "<script>alert('Failed to update Order Status'); window.location.href='../DeliveryPerson/assigned-work.php';</script>";
    }
}
?>
