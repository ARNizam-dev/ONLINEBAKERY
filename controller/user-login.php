<?php
include '../config.php';
$admin = new Admin();

if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $admin->ret("SELECT * FROM `users` WHERE `email`='$email'");
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($row && password_verify($password, $row['password'])) {
        $_SESSION['user_id'] = $row['user_id'];
        $_SESSION['name']    = $row['name'];

        echo "<script>alert('Login Successful'); window.location.href='../index.php';</script>";
        exit;
    } else {
        echo "<script>alert('Invalid Email or Password'); window.location.href='../login.php';</script>";
        exit;
    }
}
?>
