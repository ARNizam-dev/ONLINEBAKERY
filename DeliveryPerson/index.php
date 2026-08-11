<?php 
include 'header.php'; 
$dp_id = $_SESSION['dp_id'];

// Get counts
$st1 = $adminDetails->ret("SELECT COUNT(*) as c FROM orders WHERE dp_id='$dp_id' AND order_status='Delivered'");
$delivered = $st1->fetch(PDO::FETCH_ASSOC)['c'];

$st2 = $adminDetails->ret("SELECT COUNT(*) as c FROM orders WHERE dp_id='$dp_id' AND order_status='Out for Delivery'");
$out_for_delivery = $st2->fetch(PDO::FETCH_ASSOC)['c'];

$st3 = $adminDetails->ret("SELECT SUM(total_amount) as s FROM orders WHERE dp_id='$dp_id' AND payment_method='Cash on Delivery' AND payment_status='Completed'");
$cod_collected = $st3->fetch(PDO::FETCH_ASSOC)['s'] ?? 0;

$st4 = $adminDetails->ret("SELECT COUNT(*) as c FROM orders WHERE dp_id='$dp_id' AND order_status='Failed Delivery'");
$failed = $st4->fetch(PDO::FETCH_ASSOC)['c'];

$st_total = $adminDetails->ret("SELECT COUNT(*) as c FROM orders WHERE dp_id='$dp_id'");
$total_orders = $st_total->fetch(PDO::FETCH_ASSOC)['c'];
$failed_rate = $total_orders > 0 ? round(($failed / $total_orders) * 100, 1) . '%' : '0%';
?>

<div class="card-grid">
    <div class="stat-card">
        <div class="stat-title">Delivered Orders</div>
        <div class="stat-val-row">
            <div class="stat-value"><?= $delivered ?></div>
            <div class="stat-icon" style="color:var(--success); border:2px solid var(--success);"><i class="fas fa-check"></i></div>
        </div>
        <div>
            <!-- Decorative wave/chart imitation -->
            <!-- <svg viewBox="0 0 100 20" style="width:100%; height:30px; margin-top:10px;"><path d="M0,10 Q25,0 50,10 T100,10" fill="none" stroke="var(--success)" stroke-width="2"/></svg> -->
        </div>
    </div>
    
    <div class="stat-card">
        <div class="stat-title">Currently Active</div>
        <div class="stat-val-row">
            <div class="stat-value"><?= $out_for_delivery ?></div>
            <div class="stat-icon" style="color:var(--primary); border:2px solid var(--primary);"><i class="fas fa-motorcycle"></i></div>
        </div>
        <div style="margin-top:20px; display:flex; gap:5px; height:10px;">
            <!-- <div style="width:20%; background:var(--primary); border-radius:3px;"></div> -->
            <!-- <div style="width:30%; background:#d1e7dd; border-radius:3px;"></div> -->
            <!-- <div style="width:15%; background:var(--primary); border-radius:3px;"></div> -->
        </div>
    </div>
    
    <div class="stat-card">
        <div class="stat-title">COD Collected</div>
        <div class="stat-val-row">
            <div class="stat-value">₹<?= number_format($cod_collected, 2) ?></div>
            <div class="stat-icon" style="color:#8a2be2; border:2px solid #8a2be2;"><i class="fas fa-money-bill-wave"></i></div>
        </div>
        <div>
           <!-- <svg viewBox="0 0 100 20" style="width:100%; height:30px; margin-top:10px;"><path d="M0,10 Q30,20 60,5 T100,10" fill="none" stroke="#8a2be2" stroke-width="2"/></svg> -->
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-title">Failed Rate</div>
        <div class="stat-val-row">
            <div class="stat-value" style="color:var(--danger)"><?= $failed_rate ?></div>
            <div class="stat-icon" style="color:var(--danger); border:2px solid var(--danger);"><i class="fas fa-times"></i></div>
        </div>
        <div style="margin-top:15px; display:flex; height:20px; align-items:flex-end; gap:5px;">
           <!-- <div style="width:10%; height:100%; background:var(--danger); border-radius:2px;"></div> -->
           <!-- <div style="width:10%; height:40%; background:var(--danger); border-radius:2px;"></div> -->
           <!-- <div style="width:10%; height:80%; background:var(--danger); border-radius:2px;"></div> -->
        </div>
    </div>
</div>

<div class="content-card">
    <div class="content-card-header">
        <h3 class="content-card-title">Recent Agent Signatures</h3>
        <div><span class="badge-success status-badge" style="font-size:11px;">Active Tracking</span></div>
    </div>
    <div class="content-card-body">
        <p style="color:var(--text-muted); font-size:14px;">Welcome to your Skodash panel. Go to the <a href="assigned-work.php" style="color:var(--primary);">Assigned Work</a> tab to view your active delivery queues and manage cash collections.</p>
    </div>
</div>

<?php include 'footer.php'; ?>
