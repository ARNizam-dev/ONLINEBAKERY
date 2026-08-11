<?php
include '../config.php';
$admin = new Admin();

if (isset($_POST['manage_payment'])) {
    $order_id = $_POST['order_id'];
    $payment_status = $_POST['payment_status']; // Pending, Completed
    $payment_collected = $_POST['payment_collected']; // Usually same as amount for COD validation if you want
    
    $query = "UPDATE `orders` SET `payment_status`='$payment_status' WHERE `order_id`='$order_id'";

    if ($admin->cud($query, "")) {
        echo "<script>alert('Payment Status updated successfully'); window.location.href='../DeliveryPerson/assigned-work.php';</script>";
    } else {
        echo "<script>alert('Failed to update Payment Status'); window.location.href='../DeliveryPerson/assigned-work.php';</script>";
    }
}
?>
