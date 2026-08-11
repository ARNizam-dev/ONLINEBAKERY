<?php
include '../config.php';
$admin = new Admin();

if (isset($_POST['assign_dp'])) {
    $order_id = $_POST['order_id'];
    $dp_id = $_POST['dp_id'];
    
    $query = "UPDATE `orders` SET `dp_id`='$dp_id' WHERE `order_id`='$order_id'";

    if ($admin->cud($query, "")) {
        echo "<script>alert('Delivery Person assigned successfully'); window.location.href='../admin/manage-orders.php';</script>";
    } else {
        echo "<script>alert('Failed to assign Delivery Person'); window.location.href='../admin/manage-orders.php';</script>";
    }
}
?>
