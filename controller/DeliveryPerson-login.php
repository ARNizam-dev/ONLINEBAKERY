<?php
include '../config.php';
$admin = new Admin();

if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $admin->ret("SELECT * FROM `delivery_persons` WHERE `email`='$email'");
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($row && password_verify($password, $row['password'])) {
        $_SESSION['dp_id'] = $row['dp_id'];
        $_SESSION['dp_name'] = $row['name'];

        echo "<script>alert('Login Successful'); window.location.href='../DeliveryPerson/index.php';</script>";
        exit;
    } else {
        echo "<script>alert('Invalid Email or Password'); window.location.href='../DeliveryPerson/login.php';</script>";
        exit;
    }
}
?>
