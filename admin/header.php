<?php
include '../config.php';
if(basename($_SERVER['PHP_SELF']) !== 'login.php' && !isset($_SESSION['admin_id'])) {
    echo "<script>window.location.href='login.php';</script>";
    exit;
}
$adminDetails = new Admin();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>
<?php if(basename($_SERVER['PHP_SELF']) !== 'login.php') { ?>
<div class="app-wrapper">
    <?php include 'sidebar.php'; ?>
    <div class="main-content">
        <div class="top-header">
            <div class="">
            </div>
            <div class="header-actions">
                <div class="user-profile">
                    <img src="https://ui-avatars.com/api/?name=Admin&background=4338ca&color=fff" alt="Admin Face">
                    <span style="font-weight: 500; font-size: 14px; display: flex; align-items: center; gap: 8px;">
                        Admin 
                    </span>
                </div>
            </div>
        </div>
        <div class="page-content">
<?php } ?>
