<?php
include '../config.php';
$admin = new Admin();

if (isset($_GET['id'])) {
    $dp_id = $_GET['id'];
    
    $query = "DELETE FROM `delivery_persons` WHERE `dp_id`='$dp_id'";
    if ($admin->cud($query, "")) {
        echo "<script>alert('Delivery Person deleted successfully'); window.location.href='../admin/manage-delivery-person.php';</script>";
    } else {
        echo "<script>alert('Failed to delete Delivery Person'); window.location.href='../admin/manage-delivery-person.php';</script>";
    }
}
?>
