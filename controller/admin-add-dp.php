<?php
include '../config.php';
$admin = new Admin();

if (isset($_POST['add_dp'])) {
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $vehicle_number = $_POST['vehicle_number'];
    $delivery_area = $_POST['delivery_area'];

    $stmt = $admin->ret("SELECT * FROM `delivery_persons` WHERE `email`='$email'");
    if ($stmt->rowCount() > 0) {
        echo "<script>alert('Email already exists'); window.location.href='../admin/manage-delivery-person.php';</script>";
        exit;
    }

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    
    $query = "INSERT INTO `delivery_persons` (`name`, `phone`, `email`, `password`, `vehicle_number`, `delivery_area`) 
              VALUES ('$name', '$phone', '$email', '$hashed_password', '$vehicle_number', '$delivery_area')";
              
    if ($admin->cud($query, "")) {
        echo "<script>alert('Delivery Person added successfully'); window.location.href='../admin/manage-delivery-person.php';</script>";
    } else {
        echo "<script>alert('Failed to add Delivery Person'); window.location.href='../admin/manage-delivery-person.php';</script>";
    }
}
?>
