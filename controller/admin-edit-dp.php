<?php
include '../config.php';
$admin = new Admin();

if (isset($_POST['edit_dp'])) {
    $dp_id = $_POST['dp_id'];
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $vehicle_number = $_POST['vehicle_number'];
    $delivery_area = $_POST['delivery_area'];
    
    if (!empty($_POST['password'])) {
        $hashed_password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $query = "UPDATE `delivery_persons` SET `name`='$name', `phone`='$phone', `email`='$email', `password`='$hashed_password', `vehicle_number`='$vehicle_number', `delivery_area`='$delivery_area' WHERE `dp_id`='$dp_id'";
    } else {
        $query = "UPDATE `delivery_persons` SET `name`='$name', `phone`='$phone', `email`='$email', `vehicle_number`='$vehicle_number', `delivery_area`='$delivery_area' WHERE `dp_id`='$dp_id'";
    }

    if ($admin->cud($query, "")) {
        echo "<script>alert('Delivery Person updated successfully'); window.location.href='../admin/manage-delivery-person.php';</script>";
    } else {
        echo "<script>alert('Failed to update Delivery Person'); window.location.href='../admin/manage-delivery-person.php';</script>";
    }
}
?>
