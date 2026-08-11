<?php
// Identify current page for active menu highlighting
$page = basename($_SERVER['PHP_SELF']);
?>
<div class="sidebar">
    <div class="sidebar-logo">
        <div style="background: var(--primary); padding: 5px; border-radius: 6px; display: inline-flex;">
            <i class="fas fa-chart-bar" style="color: white;"></i>
        </div>
        <span>Admin</span>
    </div>
    <div class="sidebar-menu">
        <div class="menu-title">Menu</div>
        <a href="index.php" class="menu-item <?= ($page == 'index.php') ? 'active' : '' ?>">
            <i class="fas fa-border-all"></i> Dashboard
        </a>
        <a href="manage-categories.php" class="menu-item <?= ($page == 'manage-categories.php') ? 'active' : '' ?>">
            <i class="fas fa-tags"></i> Categories
        </a>
        <a href="manage-products.php" class="menu-item <?= ($page == 'manage-products.php') ? 'active' : '' ?>">
            <i class="fas fa-box-open"></i> Products
        </a>
        
        <div class="menu-title" style="margin-top: 24px;">Orders & Sales</div>
        <a href="manage-orders.php" class="menu-item <?= ($page == 'manage-orders.php') ? 'active' : '' ?>">
            <i class="fas fa-shopping-cart"></i> Orders
        </a>
        <a href="view-payment.php" class="menu-item <?= ($page == 'view-payment.php') ? 'active' : '' ?>">
            <i class="fas fa-money-bill-wave"></i> Payment Report
        </a>
        
        <div class="menu-title" style="margin-top: 24px;">Staff Management</div>
        <a href="manage-delivery-person.php" class="menu-item <?= ($page == 'manage-delivery-person.php') ? 'active' : '' ?>">
            <i class="fas fa-truck"></i> Delivery Agents
        </a>
        
        <div class="menu-title" style="margin-top: 24px;">Settings</div>
        <a href="../controller/admin-logout.php" class="menu-item" style="color: var(--danger);">
            <i class="fas fa-sign-out-alt"></i> Logout
        </a>
    </div>
</div>
