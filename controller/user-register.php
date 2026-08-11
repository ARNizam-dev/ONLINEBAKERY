<?php
include '../config.php';
$admin = new Admin();

if (isset($_POST['register'])) {
    header('Content-Type: application/json');
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $password = $_POST['password'];
    $cpassword = $_POST['cpassword'];
    $address = $_POST['address'];
    $city = $_POST['city'];
    $pincode = $_POST['pincode'];

    if (strlen($pincode) !== 6 || !ctype_digit($pincode)) {
        echo json_encode(['status' => 'error', 'message' => 'Pincode must be exactly 6 digits']);
        exit;
    }
    
    // Server-side password validation
    if (strlen($password) < 8) {
        echo json_encode(['status' => 'error', 'message' => 'Password must be at least 8 characters long']);
        exit;
    }
    // Phone validation
    if (!preg_match('/^[6-9][0-9]{9}$/', $phone)) {
        echo json_encode([
            'status' => 'error',
            'message' => 'Phone number must start with 6, 7, 8, or 9 and be exactly 10 digits'
        ]);
        exit;
    }
    if (!preg_match('/[.!:;@#$%^&*()]/', $password)) {
        echo json_encode(['status' => 'error', 'message' => 'Password must include at least one special character (e.g. . : @ #)']);
        exit;
    }

    if ($password !== $cpassword) {
        echo json_encode(['status' => 'error', 'message' => 'Passwords do not match']);
        exit;
    }

    $stmt = $admin->ret("SELECT * FROM `users` WHERE `email`='$email'");
    if ($stmt->rowCount() > 0) {
        echo json_encode(['status' => 'error', 'message' => 'Email already exists']);
        exit;
    }

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    $query = "INSERT INTO `users` (`name`, `email`, `phone`, `password`, `address`, `city`, `pincode`) VALUES ('$name', '$email', '$phone', '$hashed_password', '$address', '$city', '$pincode')";
    
    if ($admin->cud($query, "")) {
        echo json_encode(['status' => 'success', 'message' => 'Registration Successful']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Registration Failed']);
    }
}
?>
