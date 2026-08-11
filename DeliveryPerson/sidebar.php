<?php
$page = basename($_SERVER['PHP_SELF']);
?>
<div class="sidebar">
    <div class="sidebar-logo">
        <i class="fab fa-dyalog"></i>
        <span><?= $_SESSION['dp_name'] ?? 'Agent' ?></span>
    </div>
    
    <div class="sidebar-menu">
        <div class="menu-title">Dashboards</div>
        <div class="menu-subtitle">Delivery Agent Tools</div>
        
        <ul class="menu-list">
            <li>
                <a href="index.php" class="menu-item <?= ($page == 'index.php') ? 'active' : '' ?>">
                    <i class="fas fa-chart-line"></i> Summary Activity
                </a>
            </li>
            <li>
                <a href="assigned-work.php" class="menu-item <?= ($page == 'assigned-work.php') ? 'active' : '' ?>">
                    <i class="fas fa-tasks"></i> Assigned Work
                </a>
            </li>
        </ul>
        
        <div class="menu-title" style="margin-top:20px;">Settings</div>
        <ul class="menu-list">
            <li>
                <a href="../controller/DeliveryPerson-logout.php" class="menu-item" style="color:var(--danger)">
                    <i class="fas fa-power-off"></i> Sign Out
                </a>
            </li>
        </ul>
    </div>
</div>
