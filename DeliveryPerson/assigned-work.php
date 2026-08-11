<?php 
include 'header.php'; 
$dp_id = $_SESSION['dp_id'];
?>

<div class="content-card">
    <div class="content-card-header">
        <h3 class="content-card-title">My Assigned Tasks</h3>
        <div><i class="fas fa-clipboard-list" style="color:var(--primary); font-size:20px;"></i></div>
    </div>
    <div class="content-card-body">
        <div class="table-responsive">
            <table>
                <thead>
                    <tr>
                        <th>Order ID</th>
                        <th>Customer / Address</th>
                        <th>Phone</th>
                        <th>Amount & Pay</th>
                        <th>Order Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Only show orders assigned to this agent, maybe exclude Delivered/Cancelled if we want an active queue, but let's show all for now.
                    $stmt = $adminDetails->ret("SELECT o.*, u.name as customer_name FROM orders o JOIN users u ON o.user_id = u.user_id WHERE o.dp_id='$dp_id' ORDER BY o.order_id DESC");
                    while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        
                        $o_status_class = 'badge-warning'; // yellow default
                        if($row['order_status'] == 'Delivered') $o_status_class = 'badge-success';
                        else if($row['order_status'] == 'Out for Delivery') $o_status_class = 'badge-primary';
                        else if($row['order_status'] == 'Failed Delivery' || $row['order_status'] == 'Cancelled') $o_status_class = 'badge-danger';
                        
                        $p_status_class = $row['payment_status'] == 'Completed' ? 'badge-success' : 'badge-warning';

                        $is_cod = ($row['payment_method'] == 'Cash on Delivery');
                    ?>
                    <tr>
                        <td style="font-weight:700;">#<?= $row['order_id'] ?></td>
                        <td>
                            <div style="font-weight:600; color:var(--text-main); margin-bottom:4px;"><?= $row['customer_name'] ?></div>
                            <div style="font-size:13px; color:var(--text-muted); line-height:1.4; max-width:200px;">
                                <?= $row['delivery_address'] ?><br><?= $row['city'] ?> - <?= $row['pincode'] ?>
                            </div>
                        </td>
                        <td>
                            <a href="tel:<?= $row['phone'] ?>" class="btn btn-primary" style="padding:4px 8px; font-size:12px; border-radius:4px;"><i class="fas fa-phone-alt"></i> Call</a>
                        </td>
                        <td>
                            <div style="font-weight:700;">₹<?= number_format($row['total_amount'],2) ?></div>
                            <div style="font-size:12px; margin-top:2px;">
                                <?= $row['payment_method'] ?> 
                                <?php if($is_cod) { ?>
                                    <span class="status-badge <?= $p_status_class ?>" style="font-size:10px; padding:2px 6px;"><?= $row['payment_status'] ?></span>
                                <?php } ?>
                            </div>
                        </td>
                        <td>
                            <span class="status-badge <?= $o_status_class ?>"><?= $row['order_status'] ?></span>
                        </td>
                        <td>
                            <?php if($row['order_status'] == 'Delivered' || $row['order_status'] == 'Cancelled') { ?>
                                <button class="btn btn-primary" style="padding:6px 12px; font-size:12px; opacity: 0.5; cursor: not-allowed;" title="Action disabled" disabled><i class="fas fa-edit"></i> Update</button>
                            <?php } else { ?>
                                <a href="assigned-work.php?manage_order=<?= $row['order_id'] ?>" class="btn btn-primary" style="padding:6px 12px; font-size:12px;"><i class="fas fa-edit"></i> Update</a>
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
// Manager Order Modal
if(isset($_GET['manage_order'])) { 
    $order_id = $_GET['manage_order'];
    $order = $adminDetails->ret("SELECT * FROM orders WHERE order_id='$order_id' AND dp_id='$dp_id'")->fetch(PDO::FETCH_ASSOC);
    if($order) {
        $is_cod = ($order['payment_method'] == 'Cash on Delivery');
?>
<div style="position: fixed; top:0; left:0; width: 100%; height: 100vh; background: rgba(0,0,0,0.6); z-index: 999; display: flex; align-items: center; justify-content: center;">
    <div class="card-grid" style="width: 800px; max-width: 95%; margin-bottom:0; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 20px;">
        
        <!-- Form 1: Delivery Status -->
        <div class="content-card" style="margin-bottom:0;">
            <div class="content-card-header">
                <h3 class="content-card-title">Delivery Status Update</h3>
                <a href="assigned-work.php" style="color: var(--text-muted);"><i class="fas fa-times"></i></a>
            </div>
            <div class="content-card-body">
                <form action="../controller/DeliveryPerson-update-status.php" method="POST">
                    <input type="hidden" name="order_id" value="<?= $order['order_id'] ?>">
                    <div class="form-group">
                        <label>Current Status</label>
                        <select name="order_status" class="form-control" required>
                            <?php
                            $d_statuses = ['Picked Up', 'Out for Delivery', 'Delivered', 'Failed Delivery'];
                            foreach($d_statuses as $s) {
                                $sel = $s == $order['order_status'] ? 'selected' : '';
                                echo "<option value='$s' $sel>$s</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <button type="submit" name="update_status" class="btn btn-primary" style="width: 100%;">Save Delivery Status</button>
                </form>
            </div>
        </div>

        <!-- Form 2: Payment Collection (Only if COD) -->
        <?php if($is_cod) { ?>
        <div class="content-card" style="margin-bottom:0;">
            <div class="content-card-header">
                <h3 class="content-card-title">COD Collection</h3>
            </div>
            <div class="content-card-body">
                <form action="../controller/DeliveryPerson-manage-payment.php" method="POST">
                    <input type="hidden" name="order_id" value="<?= $order['order_id'] ?>">
                    <div class="form-group">
                        <label>Amount to Collect</label>
                        <input type="text" class="form-control" value="$<?= number_format($order['total_amount'],2) ?>" readonly style="background:#f8f9fa;">
                        <input type="hidden" name="payment_collected" value="<?= $order['total_amount'] ?>">
                    </div>
                    <div class="form-group">
                        <label>Payment Status</label>
                        <select name="payment_status" class="form-control" required>
                            <option value="Pending" <?= $order['payment_status']=='Pending'?'selected':'' ?>>Pending / Not Collected</option>
                            <option value="Completed" <?= $order['payment_status']=='Completed'?'selected':'' ?>>Completed / Cash Received</option>
                        </select>
                    </div>
                    <button type="submit" name="manage_payment" class="btn btn-success" style="width: 100%;"><i class="fas fa-money-check-alt"></i> Update COD</button>
                </form>
            </div>
        </div>
        <?php } else { ?>
            <div class="content-card" style="margin-bottom:0; display:flex; align-items:center; justify-content:center; text-align:center; padding:40px;">
                <div>
                    <i class="fas fa-check-circle" style="font-size:40px; color:var(--success); margin-bottom:15px;"></i>
                    <h4 style="color:var(--text-main); margin-bottom:5px;">Prepaid Order</h4>
                    <p style="color:var(--text-muted); font-size:13px;">No cash collection needed.</p>
                </div>
            </div>
        <?php } ?>

    </div>
</div>
<?php } } ?>

<?php include 'footer.php'; ?>
