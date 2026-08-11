<?php
include '../config.php';
$admin = new Admin();

if (isset($_POST['edit_category'])) {
    $category_id = $_POST['category_id'];
    $name = $_POST['name'];
    $status = $_POST['status'];
    
    if (!empty($_FILES['image']['name'])) {
        $image = $_FILES['image']['name'];
        $target = "../uploads/".basename($image);
        move_uploaded_file($_FILES['image']['tmp_name'], $target);
        $query = "UPDATE `categories` SET `name`='$name', `image`='$image', `status`='$status' WHERE `category_id`='$category_id'";
    } else {
        $query = "UPDATE `categories` SET `name`='$name', `status`='$status' WHERE `category_id`='$category_id'";
    }

    if ($admin->cud($query, "")) {
        echo "<script>alert('Category updated successfully'); window.location.href='../admin/manage-categories.php';</script>";
    } else {
        echo "<script>alert('Failed to update category'); window.location.href='../admin/manage-categories.php';</script>";
    }
}
?>
