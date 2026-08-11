<?php
include '../config.php';
$admin = new Admin();

if (isset($_GET['id'])) {
    $category_id = $_GET['id'];
    
    $query = "DELETE FROM `categories` WHERE `category_id`='$category_id'";
    if ($admin->cud($query, "")) {
        echo "<script>alert('Category deleted successfully'); window.location.href='../admin/manage-categories.php';</script>";
    } else {
        echo "<script>alert('Failed to delete category'); window.location.href='../admin/manage-categories.php';</script>";
    }
}
?>
