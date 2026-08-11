<?php 
include 'header.php'; 

// Fetch totals
$customers_count = $adminDetails->ret("SELECT COUNT(*) as c FROM users")->fetch(PDO::FETCH_ASSOC)['c'];
$orders_count = $adminDetails->ret("SELECT COUNT(*) as c FROM orders")->fetch(PDO::FETCH_ASSOC)['c'];
$revenue = $adminDetails->ret("SELECT SUM(total_amount) as s FROM orders WHERE payment_status='Completed'")->fetch(PDO::FETCH_ASSOC)['s'] ?? 0;
$products_count = $adminDetails->ret("SELECT COUNT(*) as c FROM products")->fetch(PDO::FETCH_ASSOC)['c'];

?>
<h2 class="page-title">Dashboard</h2>

<div class="card-grid">
    <div class="dashboard-card" style="display: flex; justify-content: space-between; align-items: flex-end;">
        <div>
            <div class="card-icon"><i class="far fa-eye"></i></div>
            <div class="card-value"><?= number_format($customers_count) ?></div>
            <div class="card-label" style="margin-top: 5px;">Total Customers</div>
        </div>
        <div class="trend up"><i class="fas fa-arrow-up"></i> 10.00%</div>
    </div>
    
    <div class="dashboard-card" style="display: flex; justify-content: space-between; align-items: flex-end;">
        <div>
            <div class="card-icon"><i class="fas fa-shopping-cart"></i></div>
            <div class="card-value"><?= number_format($orders_count) ?></div>
            <div class="card-label" style="margin-top: 5px;">Total Orders</div>
        </div>
        <div class="trend up"><i class="fas fa-arrow-up"></i> 5.00%</div>
    </div>
    
    <div class="dashboard-card" style="display: flex; justify-content: space-between; align-items: flex-end;">
        <div>
            <div class="card-icon"><i class="fas fa-box-open"></i></div>
            <div class="card-value"><?= number_format($products_count) ?></div>
            <div class="card-label" style="margin-top: 5px;">Total Products</div>
        </div>
        <div class="trend up"><i class="fas fa-arrow-up"></i> 2.00%</div>
    </div>
    
    <div class="dashboard-card" style="display: flex; justify-content: space-between; align-items: flex-end;">
        <div>
            <div class="card-icon"><i class="fas fa-rupee-sign"></i></div>
            <div class="card-value">₹<?= number_format($revenue, 2) ?></div>
            <div class="card-label" style="margin-top: 5px;">Total Revenue</div>
        </div>
        <div class="trend up"><i class="fas fa-arrow-up"></i> 12.5%</div>
    </div>
</div>

<div class="content-card">
    <div class="content-card-header">
        <h3 class="content-card-title">Recent Orders</h3>
        <a href="manage-orders.php" class="btn btn-primary" style="font-size: 13px; padding: 6px 12px;">View All</a>
    </div>
    <div class="content-card-body">
        <div class="table-responsive">
            <table>
                <thead>
                    <tr>
                        <th>Order ID</th>
                        <th>Date</th>
                        <th>Amount</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $recent_orders = $adminDetails->ret("SELECT * FROM orders ORDER BY order_id DESC LIMIT 5");
                    while($row = $recent_orders->fetch(PDO::FETCH_ASSOC)) {
                        $status_class = 'status-pending';
                        if($row['order_status'] == 'Delivered') $status_class = 'status-delivered';
                        else if($row['order_status'] == 'Cancelled') $status_class = 'status-cancelled';
                        else if($row['order_status'] == 'Preparing') $status_class = 'status-preparing';
                        else if($row['order_status'] == 'Out for Delivery') $status_class = 'status-active';
                        
                        echo "<tr>";
                        echo "<td>#{$row['order_id']}</td>";
                        echo "<td>".date('M d, Y', strtotime($row['created_at']))."</td>";
                        echo "<td>₹".number_format($row['total_amount'],2)."</td>";
                        echo "<td><span class='status-badge $status_class'>{$row['order_status']}</span></td>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>
