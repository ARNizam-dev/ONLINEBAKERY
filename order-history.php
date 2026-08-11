<?php
include 'header.php';

if (!isset($_SESSION['user_id'])) {
    echo "<script>alert('Please login'); window.location.href='login.php';</script>";
    exit;
}

$user_id = $_SESSION['user_id'];
$orders = $adminDetails->ret("SELECT o.*, dp.name as dp_name, dp.phone as dp_phone FROM orders o LEFT JOIN delivery_persons dp ON o.dp_id = dp.dp_id WHERE o.user_id='$user_id' ORDER BY o.order_id DESC");
?>

<div style="margin-bottom: 40px;">
    <span class="tag-label">Account</span>
    <h2 style="font-size: 40px;">Order History</h2>
    <p style="color: var(--text-muted); margin-top: 8px;">Track your recent bakery deliveries.</p>
</div>

<?php if ($orders->rowCount() > 0): ?>
    <div style="display: grid; gap: 24px;">
        <?php while ($row = $orders->fetch(PDO::FETCH_ASSOC)):
            $oid = $row['order_id'];
            $items = $adminDetails->ret("SELECT oi.*, p.name FROM order_items oi JOIN products p ON oi.product_id = p.product_id WHERE oi.order_id='$oid'");

            $status_class = 'status-pending';
            if ($row['order_status'] == 'Delivered')
                $status_class = 'status-delivered';
            if ($row['order_status'] == 'Cancelled')
                $status_class = 'status-cancelled';
            if ($row['order_status'] == 'Out for Delivery')
                $status_class = 'status-active';
            ?>
            <div class="auth-wrapper"
                style="margin: 0; max-width: 100%; display: grid; grid-template-columns: 1fr 300px; gap: 32px; align-items: start;">
                <div>
                    <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom: 16px;">
                        <div>
                            <span style="font-size:18px; font-weight:700;">Order #<?= $oid ?></span>
                            <span
                                style="margin-left:12px; font-size:14px; color:var(--text-muted);"><?= date('M d, Y', strtotime($row['created_at'])) ?></span>
                        </div>
                    </div>

                    <div style="margin-bottom: 24px;">
                        <span class="status-badge <?= $status_class ?>"><?= $row['order_status'] ?></span>
                    </div>

                    <div style="border-top: 1px dashed var(--border-color); padding-top: 24px; margin-bottom: 24px;">
                        <h4
                            style="font-size:14px; color:var(--text-muted); text-transform:uppercase; letter-spacing:0.5px; margin-bottom:16px;">
                            Items Detail</h4>
                        <?php while ($item = $items->fetch(PDO::FETCH_ASSOC)): ?>
                            <div style="display:flex; justify-content:space-between; margin-bottom: 12px; font-size:15px;">
                                <div>
                                    <span
                                        style="font-weight:600; color:var(--text-main); margin-right:8px;"><?= $item['quantity'] ?>x</span>
                                    <?= $item['name'] ?>
                                </div>
                                <div style="font-weight:500;">₹<?= number_format($item['price'], 2) ?></div>
                            </div>
                        <?php endwhile; ?>
                    </div>

                    <div
                        style="display:flex; justify-content:space-between; background: var(--bg-secondary); padding: 16px; border-radius: var(--radius); align-items:center;">
                        <div>
                            <div
                                style="font-weight:600; font-size:14px; text-transform:uppercase; color:var(--text-muted); margin-bottom:4px;">
                                Total Bill</div>
                            <div style="font-weight:800; font-size:24px;">₹<?= number_format($row['total_amount'], 2) ?></div>
                        </div>
                        <div style="text-align:right;">
                            <div
                                style="font-size:13px; font-weight:600; padding:4px 8px; background:#fff; border-radius:4px; border:1px solid var(--border-color); margin-bottom:4px;">
                                <?= $row['payment_method'] ?>
                            </div>
                            <div style="font-size:12px; color:var(--text-muted);"><?= $row['payment_status'] ?></div>
                        </div>
                    </div>
                </div>

                <div style="border-left: 1px solid var(--border-color); padding-left: 32px; height: 100%;">
                    <h4
                        style="font-size:14px; color:var(--text-muted); text-transform:uppercase; letter-spacing:0.5px; margin-bottom:16px;">
                        Delivery Details</h4>
                    <div style="margin-bottom: 24px;">
                        <div style="font-weight:600; margin-bottom:4px;"><?= $row['delivery_address'] ?></div>
                        <div style="color:var(--text-muted); font-size:14px; margin-bottom:4px;"><?= $row['city'] ?> -
                            <?= $row['pincode'] ?>
                        </div>
                        <div style="color:var(--text-muted); font-size:14px;"><i class="fas fa-phone-alt"></i>
                            <?= $row['phone'] ?></div>
                    </div>

                    <?php if ($row['order_status'] != 'Cancelled' && $row['order_status'] != 'Delivered'): ?>
                        <h4
                            style="font-size:14px; color:var(--text-muted); text-transform:uppercase; letter-spacing:0.5px; margin-bottom:16px; margin-top:32px;">
                            Driver Assignment</h4>
                        <?php if ($row['dp_id']): ?>
                            <div
                                style="display:flex; align-items:center; gap:12px; background: #faf5ff; padding:16px; border-radius:var(--radius); border: 1px solid #f3e8ff;">
                                <img src="https://ui-avatars.com/api/?name=<?= urlencode($row['dp_name']) ?>&background=7c3aed&color=fff"
                                    style="width:40px; height:40px; border-radius:50%;">
                                <div>
                                    <div style="font-weight:700; color:var(--primary-dark);"><?= $row['dp_name'] ?></div>
                                    <div style="font-size:13px; color:var(--text-main); font-weight:500;"><i
                                            class="fas fa-motorcycle"></i> <?= $row['dp_phone'] ?></div>
                                </div>
                            </div>
                            <?php if ($row['order_status'] == 'Out for Delivery'): ?>
                                <div
                                    style="margin-top:16px; font-size:13px; color:var(--success); font-weight:600; display:flex; align-items:center; gap:8px;">
                                    <i class="fas fa-circle" style="font-size:8px;"></i> Arriving Soon
                                </div>
                            <?php endif; ?>
                        <?php else: ?>
                            <div
                                style="font-size:14px; color:var(--warning); font-weight:500; display:flex; align-items:center; gap:8px;">
                                <i class="fas fa-hourglass-half"></i> Assigning Driver...
                            </div>
                        <?php endif; ?>
                    <?php endif; ?>
                </div>
            </div>
        <?php endwhile; ?>
    </div>
<?php else: ?>
    <div style="text-align: center; padding: 80px 0;">
        <i class="fas fa-receipt" style="font-size: 64px; color: #e2e8f0; margin-bottom: 24px;"></i>
        <h3 style="font-size: 24px; margin-bottom: 16px;">No orders found</h3>
        <p style="color: var(--text-muted); margin-bottom: 32px;">You haven't placed any orders with us yet.</p>
        <a href="products.php" class="btn btn-black" style="padding: 12px 32px;">Browse Menu</a>
    </div>
<?php endif; ?>

<?php include 'footer.php'; ?>