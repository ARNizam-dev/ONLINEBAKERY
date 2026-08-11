<?php include 'header.php'; ?>

<h2 class="page-title">Manage Orders</h2>

<div class="content-card">
    <div class="content-card-header">
        <h3 class="content-card-title">All Customer Orders</h3>
    </div>
    <div class="content-card-body">
        <div class="table-responsive">
            <table>
                <thead>
                    <tr>
                        <th>Order ID</th>
                        <th>Customer</th>
                        <th>Amount & Method</th>
                        <th>Delivery Addr.</th>
                        <th>Agent</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $stmt = $adminDetails->ret("SELECT o.*, u.name as customer_name, dp.name as agent_name FROM orders o 
                                                JOIN users u ON o.user_id = u.user_id 
                                                LEFT JOIN delivery_persons dp ON o.dp_id = dp.dp_id 
                                                ORDER BY o.order_id DESC");
                    while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        $status_class = 'status-pending';
                        if($row['order_status'] == 'Delivered') $status_class = 'status-delivered';
                        else if($row['order_status'] == 'Cancelled') $status_class = 'status-cancelled';
                        else if($row['order_status'] == 'Preparing') $status_class = 'status-preparing';
                        else if($row['order_status'] == 'Out for Delivery') $status_class = 'status-active';
                    ?>
                    <tr>
                        <td>
                            <div style="font-weight: 600;">#<?= $row['order_id'] ?></div>
                            <div style="font-size: 13px; color: var(--text-muted);"><?= date('M d, Y', strtotime($row['created_at'])) ?></div>
                        </td>
                        <td>
                            <div><?= $row['customer_name'] ?></div>
                            <div style="font-size: 13px; color: var(--text-muted);"><?= $row['phone'] ?></div>
                        </td>
                        <td>
                            <div style="font-weight: 600;">₹<?= number_format($row['total_amount'], 2) ?></div>
                            <span style="font-size: 11px; padding: 2px 6px; background:#e2e8f0; border-radius:4px;"><?= $row['payment_method'] ?></span>
                        </td>
                        <td style="max-width: 200px;">
                            <div style="font-size: 13px; white-space: normal; line-height: 1.4;">
                                <?= $row['delivery_address'] ?>, <?= $row['city'] ?> - <?= $row['pincode'] ?>
                            </div>
                        </td>
                        <td>
                            <?php if($row['agent_name']) { ?>
                                <span style="color: var(--primary); font-weight: 600; font-size: 14px;"><i class="fas fa-motorcycle"></i> <?= $row['agent_name'] ?></span>
                            <?php } else { ?>
                                <span style="color: var(--warning); font-size: 13px;">Not Assigned</span>
                            <?php } ?>
                        </td>
                        <td><span class="status-badge <?= $status_class ?>"><?= $row['order_status'] ?></span></td>
                        <td style="white-space: nowrap;">
                            <a href="manage-orders.php?view=<?= $row['order_id'] ?>" class="btn btn-info" style="padding: 6px 10px; font-size: 12px; margin-bottom: 5px; background: var(--success); color:white;"><i class="fas fa-eye"></i> Details</a><br>
                            <?php 
                            $is_final = ($row['order_status'] == 'Delivered' || $row['order_status'] == 'Cancelled');
                            $is_assigned = !empty($row['dp_id']);
                            
                            if($is_final || $is_assigned) { ?>
                                <button class="btn btn-primary" style="padding: 6px 10px; font-size: 12px; margin-bottom: 5px; opacity: 0.5; cursor: not-allowed;" title="<?= $is_assigned ? 'Agent already assigned' : 'Action disabled' ?>" disabled><i class="fas fa-truck"></i> Assign</button><br>
                            <?php } else { ?>
                                <a href="manage-orders.php?assign=<?= $row['order_id'] ?>" class="btn btn-primary" style="padding: 6px 10px; font-size: 12px; margin-bottom: 5px;"><i class="fas fa-truck"></i> Assign</a><br>
                            <?php } 
                            
                            if($is_final) { ?>
                                <!-- <button class="btn btn-warning" style="padding: 6px 10px; font-size: 12px; background: var(--text-muted); border-color: var(--text-muted); color:white; opacity: 0.5; cursor: not-allowed;" title="Action disabled" disabled><i class="fas fa-sync"></i> Status</button> -->
                            <?php } else { ?>
                                <!-- <a href="manage-orders.php?status=<?= $row['order_id'] ?>" class="btn btn-warning" style="padding: 6px 10px; font-size: 12px; background: var(--warning); color:white;"><i class="fas fa-sync"></i> Status</a> -->
                            <?php } ?>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php 
// Modals for Actions
if(isset($_GET['assign'])) { 
    $order_id = $_GET['assign'];
    $order = $adminDetails->ret("SELECT * FROM orders WHERE order_id='$order_id'")->fetch(PDO::FETCH_ASSOC);
?>
<div style="position: fixed; top:0; left:0; width: 100%; height: 100vh; background: rgba(0,0,0,0.5); z-index: 999; display: flex; align-items: center; justify-content: center;">
    <div class="content-card" style="width: 400px; max-width: 90%;">
        <div class="content-card-header">
            <h3 class="content-card-title">Assign Delivery Person</h3>
            <a href="manage-orders.php" style="color: var(--text-muted); text-decoration: none;"><i class="fas fa-times"></i></a>
        </div>
        <div class="content-card-body">
            <form action="../controller/admin-assign-dp.php" method="POST">
                <input type="hidden" name="order_id" value="<?= $order['order_id'] ?>">
                <div class="form-group">
                    <label>Select Agent</label>
                    <select name="dp_id" class="form-control" required>
                        <option value="">Select Delivery Agent...</option>
                        <?php
                        $agents = $adminDetails->ret("SELECT * FROM delivery_persons");
                        while($a = $agents->fetch(PDO::FETCH_ASSOC)) {
                            $sel = $a['dp_id'] == $order['dp_id'] ? 'selected' : '';
                            echo "<option value='{$a['dp_id']}' $sel>{$a['name']} ({$a['delivery_area']})</option>";
                        }
                        ?>
                    </select>
                </div>
                <button type="submit" name="assign_dp" class="btn btn-primary" style="width: 100%; justify-content: center;">Assign Agent</button>
            </form>
        </div>
    </div>
</div>
<?php } ?>

<?php 
if(isset($_GET['status'])) { 
    $order_id = $_GET['status'];
    $order = $adminDetails->ret("SELECT * FROM orders WHERE order_id='$order_id'")->fetch(PDO::FETCH_ASSOC);
?>
<div style="position: fixed; top:0; left:0; width: 100%; height: 100vh; background: rgba(0,0,0,0.5); z-index: 999; display: flex; align-items: center; justify-content: center;">
    <div class="content-card" style="width: 400px; max-width: 90%;">
        <div class="content-card-header">
            <h3 class="content-card-title">Update Order Status</h3>
            <a href="manage-orders.php" style="color: var(--text-muted); text-decoration: none;"><i class="fas fa-times"></i></a>
        </div>
        <div class="content-card-body">
            <form action="../controller/admin-update-order-status.php" method="POST">
                <input type="hidden" name="order_id" value="<?= $order['order_id'] ?>">
                <div class="form-group">
                    <label>Status</label>
                    <select name="order_status" class="form-control" required>
                        <?php
                        $statuses = ['Pending', 'Preparing', 'Out for Delivery', 'Delivered', 'Cancelled'];
                        foreach($statuses as $s) {
                            $sel = $s == $order['order_status'] ? 'selected' : '';
                            echo "<option value='$s' $sel>$s</option>";
                        }
                        ?>
                    </select>
                </div>
                <button type="submit" name="update_order_status" class="btn btn-primary" style="width: 100%; justify-content: center;">Update Status</button>
            </form>
        </div>
    </div>
</div>
<?php } ?>

<?php 
if(isset($_GET['view'])) { 
    $order_id = $_GET['view'];
    $order = $adminDetails->ret("SELECT o.*, u.name as customer_name, dp.name as agent_name FROM orders o JOIN users u ON o.user_id = u.user_id LEFT JOIN delivery_persons dp ON o.dp_id = dp.dp_id WHERE o.order_id='$order_id'")->fetch(PDO::FETCH_ASSOC);
?>
<div style="position: fixed; top:0; left:0; width: 100%; height: 100vh; background: rgba(0,0,0,0.5); z-index: 999; display: flex; align-items: center; justify-content: center;">
    <div class="content-card" style="width: 600px; max-width: 90%; max-height: 90vh; overflow-y: auto;">
        <div class="content-card-header">
            <h3 class="content-card-title">Order Details #<?= $order['order_id'] ?></h3>
            <a href="manage-orders.php" style="color: var(--text-muted); text-decoration: none;"><i class="fas fa-times"></i></a>
        </div>
        <div class="content-card-body">
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 24px; font-size: 14px;">
                <div>
                    <div style="color: var(--text-muted); font-size: 12px; margin-bottom: 4px;">Customer Info</div>
                    <div style="font-weight: 600;"><?= $order['customer_name'] ?></div>
                    <div><?= $order['phone'] ?></div>
                </div>
                <div>
                    <div style="color: var(--text-muted); font-size: 12px; margin-bottom: 4px;">Delivery Address</div>
                    <div><?= nl2br($order['delivery_address']) ?></div>
                    <div><?= $order['city'] ?> - <?= $order['pincode'] ?></div>
                </div>
            </div>
            
            <?php if(!empty($order['order_notes'])): ?>
            <div style="background: var(--bg-secondary); padding: 12px; border-radius: 8px; margin-bottom: 24px; font-size: 14px;">
                <span style="font-weight: 600;">Order Notes:</span><br>
                <?= nl2br(htmlspecialchars($order['order_notes'])) ?>
            </div>
            <?php endif; ?>

            <div style="font-weight: 600; margin-bottom: 12px;">Order Items</div>
            <table style="width: 100%; text-align: left; border-collapse: collapse; margin-bottom: 24px; font-size: 14px;">
                <tr style="border-bottom: 1px solid var(--border-color);">
                    <th style="padding-bottom: 8px;">Product</th>
                    <th style="padding-bottom: 8px; text-align: center;">Qty</th>
                    <th style="padding-bottom: 8px; text-align: right;">Price</th>
                    <th style="padding-bottom: 8px; text-align: right;">Total</th>
                </tr>
                <?php
                $items = $adminDetails->ret("SELECT oi.*, p.name FROM order_items oi JOIN products p ON oi.product_id = p.product_id WHERE oi.order_id='$order_id'");
                while($item = $items->fetch(PDO::FETCH_ASSOC)):
                ?>
                <tr style="border-bottom: 1px solid var(--border-color);">
                    <td style="padding: 12px 0;"><?= $item['name'] ?></td>
                    <td style="padding: 12px 0; text-align: center;"><?= $item['quantity'] ?></td>
                    <td style="padding: 12px 0; text-align: right;">$<?= number_format($item['price'], 2) ?></td>
                    <td style="padding: 12px 0; text-align: right; font-weight: 600;">$<?= number_format($item['price']*$item['quantity'], 2) ?></td>
                </tr>
                <?php endwhile; ?>
            </table>
            
            <div style="display: flex; justify-content: space-between; font-size: 18px; font-weight: 700;">
                <span>Total Amount</span>
                <span style="color: var(--primary-dark);">₹<?= number_format($order['total_amount'], 2) ?></span>
            </div>
        </div>
    </div>
</div>
<?php } ?>

<?php include 'footer.php'; ?>
