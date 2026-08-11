<?php
include '../config.php';
$admin = new Admin();

if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $admin->ret("SELECT * FROM `admins` WHERE `email`='$email'");
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

       if ($row) {
        $_SESSION['admin_id'] = $row['admin_id'];

        echo "<script>alert('Login Successful'); window.location.href='../admin/index.php';</script>";
        exit;
    } else {
        echo "<script>alert('Invalid Email or Password'); window.location.href='../admin/login.php';</script>";
        exit;
    }
}
?>
