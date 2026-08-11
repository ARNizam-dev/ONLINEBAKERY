<?php
include '../config.php';
$admin = new Admin();

if (isset($_POST['update_order_status'])) {
    $order_id = $_POST['order_id'];
    $order_status = $_POST['order_status']; // Pending, Preparing, Out for Delivery, Delivered, Cancelled
    
    $query = "UPDATE `orders` SET `order_status`='$order_status' WHERE `order_id`='$order_id'";

    if ($admin->cud($query, "")) {
        echo "<script>alert('Order Status updated successfully'); window.location.href='../admin/manage-orders.php';</script>";
    } else {
        echo "<script>alert('Failed to update Order Status'); window.location.href='../admin/manage-orders.php';</script>";
    }
}
?>
