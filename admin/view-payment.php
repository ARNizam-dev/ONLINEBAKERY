<?php include 'header.php'; ?>

<h2 class="page-title">Payment Reports</h2>

<div class="card-grid">
    <?php
    $total_revenue = $adminDetails->ret("SELECT SUM(total_amount) as s FROM orders WHERE payment_status='Completed'")->fetch(PDO::FETCH_ASSOC)['s'] ?? 0;
    $pending_revenue = $adminDetails->ret("SELECT SUM(total_amount) as s FROM orders WHERE payment_status='Pending'")->fetch(PDO::FETCH_ASSOC)['s'] ?? 0;
    $completed_payments = $adminDetails->ret("SELECT COUNT(*) as c FROM orders WHERE payment_status='Completed'")->fetch(PDO::FETCH_ASSOC)['c'];
    ?>
    <div class="dashboard-card" style="display: flex; justify-content: space-between; align-items: flex-end;">
        <div>
            <div class="card-icon" style="background:#d1fae5; color:var(--success);"><i class="fas fa-check-circle"></i></div>
            <div class="card-value">₹<?= number_format($total_revenue, 2) ?></div>
            <div class="card-label" style="margin-top: 5px;">Collected Revenue</div>
        </div>
    </div>
    <div class="dashboard-card" style="display: flex; justify-content: space-between; align-items: flex-end;">
        <div>
            <div class="card-icon" style="background:#fef3c7; color:var(--warning);"><i class="fas fa-clock"></i></div>
            <div class="card-value">₹<?= number_format($pending_revenue, 2) ?></div>
            <div class="card-label" style="margin-top: 5px;">Pending COD Revenue</div>
        </div>
    </div>
    <div class="dashboard-card" style="display: flex; justify-content: space-between; align-items: flex-end;">
        <div>
            <div class="card-icon"><i class="fas fa-receipt"></i></div>
            <div class="card-value"><?= number_format($completed_payments) ?></div>
            <div class="card-label" style="margin-top: 5px;">Successful Transactions</div>
        </div>
    </div>
</div>

<div class="content-card">
    <div class="content-card-header">
        <h3 class="content-card-title">All Payments</h3>
    </div>
    <div class="content-card-body">
        <div class="table-responsive">
            <table>
                <thead>
                    <tr>
                        <th>Order ID</th>
                        <th>User</th>
                        <th>Date</th>
                        <th>Payment Method</th>
                        <th>Amount</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $stmt = $adminDetails->ret("SELECT o.*, u.name as customer_name FROM orders o JOIN users u ON o.user_id = u.user_id ORDER BY o.order_id DESC");
                    while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        $p_status_class = $row['payment_status'] == 'Completed' ? 'status-active' : 'status-pending';
                        if($row['payment_status'] == 'Failed') $p_status_class = 'status-inactive';
                    ?>
                    <tr>
                        <td style="font-weight: 600;">#<?= $row['order_id'] ?></td>
                        <td><?= $row['customer_name'] ?></td>
                        <td><?= date('M d, Y h:i A', strtotime($row['created_at'])) ?></td>
                        <td><span style="font-size: 13px; font-weight: 600; color:var(--text-main);"><i class="far fa-credit-card"></i> <?= $row['payment_method'] ?></span></td>
                        <td style="font-weight: 600; color: var(--text-main);">₹<?= number_format($row['total_amount'], 2) ?></td>
                        <td><span class="status-badge <?= $p_status_class ?>"><?= $row['payment_status'] ?></span></td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>
