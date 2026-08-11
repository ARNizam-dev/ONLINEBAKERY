<?php
include '../config.php';
$admin = new Admin();

if (isset($_POST['add_category'])) {
    $name = $_POST['name'];
    $status = $_POST['status'];
    
    $image = $_FILES['image']['name'];
    $target = "../uploads/".basename($image);

    if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
        $query = "INSERT INTO `categories` (`name`, `image`, `status`) VALUES ('$name', '$image', '$status')";
        if ($admin->cud($query, "")) {
            echo "<script>alert('Category added successfully'); window.location.href='../admin/manage-categories.php';</script>";
        } else {
            echo "<script>alert('Failed to add category'); window.location.href='../admin/manage-categories.php';</script>";
        }
    } else {
        echo "<script>alert('Failed to upload image'); window.location.href='../admin/manage-categories.php';</script>";
    }
}
?>
