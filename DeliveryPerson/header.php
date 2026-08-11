<?php
include '../config.php';
if(basename($_SERVER['PHP_SELF']) !== 'login.php' && !isset($_SESSION['dp_id'])) {
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
    <title>Delivery Agent - SKODASH</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body>
<?php if(basename($_SERVER['PHP_SELF']) !== 'login.php') { ?>
<div class="app-wrapper">
    <?php include 'sidebar.php'; ?>
    <div class="main-content">
        <div class="top-header">
            <div class="header-left">
                <div class="top-nav">
                    <a href="index.php">DASHBOARD</a>
                    <a href="assigned-work.php">WORK</a>
                </div>
                <div class="">
                    <!-- <i class="fas fa-search" style="color:var(--text-muted)"></i> -->
                    <!-- <input type="text" placeholder="Type here to search"> -->
                </div>
            </div>
            <div class="header-actions">
                <div class="user-profile">
                    <img src="https://ui-avatars.com/api/?name=<?= urlencode($_SESSION['dp_name'] ?? 'Agent') ?>&background=4561ec&color=fff" alt="User">
                    <span><?= $_SESSION['dp_name'] ?? 'Agent' ?></span>
                </div>
            </div>
        </div>
        <div class="page-content">
<?php } ?>
