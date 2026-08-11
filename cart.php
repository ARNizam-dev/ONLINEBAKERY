<?php 
include 'header.php'; 

if(!isset($_SESSION['user_id'])) {
    echo "<script>alert('Please login to view your cart'); window.location.href='login.php';</script>";
    exit;
}

$user_id = $_SESSION['user_id'];
$cart_items = $adminDetails->ret("SELECT c.*, p.name, p.image, p.stock_quantity FROM cart c JOIN products p ON c.product_id = p.product_id WHERE c.user_id='$user_id'");

$total = 0;
?>

<div style="margin-bottom: 40px;">
    <span class="tag-label">Review</span>
    <h2 style="font-size: 40px;">Your Cart</h2>
</div>

<?php if($cart_items->rowCount() > 0): ?>
    <div style="display: grid; grid-template-columns: 1fr 350px; gap: 40px; align-items: start;">
        <div class="table-wrap">
            <form action="controller/user-update-cart.php" method="POST">
                <table>
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th style="text-align:center;">Quantity</th>
                            <th>Total</th>
                            <th>Remove</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while($row = $cart_items->fetch(PDO::FETCH_ASSOC)): 
                            $line_total = $row['price'] * $row['quantity'];
                            $total += $line_total;
                        ?>
                        <tr>
                            <td style="display:flex; align-items:center; gap: 16px;">
                                <img src="uploads/<?= $row['image'] ?>" width="64" height="64" style="object-fit:cover; border-radius:8px;" onerror="this.src='https://images.unsplash.com/photo-1550617931-e17a7b70dce2?q=80&w=64&auto=format&fit=crop'">
                                <div>
                                    <div style="font-weight:600; font-size:16px;"><?= $row['name'] ?></div>
                                    <div style="color:var(--text-muted); font-size:13px;">₹<?= number_format($row['price'], 2) ?></div>
                                </div>
                            </td>
                            <td style="text-align:center;">
                                <input type="hidden" name="cart_id[]" value="<?= $row['cart_id'] ?>">
                                <input type="number" name="quantity[]" value="<?= $row['quantity'] ?>" min="1" max="<?= $row['stock_quantity'] ?>" class="form-control" style="width: 80px; text-align:center; display:inline-block; padding:8px;">
                            </td>
                            <td style="font-weight:700;">₹<?= number_format($line_total, 2) ?></td>
                            <td>
                                <a href="controller/user-remove-from-cart.php?id=<?= $row['cart_id'] ?>" style="color: var(--danger); font-size: 18px;"><i class="fas fa-trash-alt"></i></a>
                            </td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
                <div style="padding: 20px; text-align: right; border-top: 1px solid var(--border-color);">
                    <button type="submit" name="update_cart" class="btn btn-outline"><i class="fas fa-sync"></i> Update Cart</button>
                </div>
            </form>
        </div>

        <div class="auth-wrapper" style="margin: 0; position: sticky; top: 100px;">
            <h3 style="font-size: 20px; font-weight: 700; border-bottom: 1px solid var(--border-color); padding-bottom: 16px; margin-bottom: 24px;">Order Summary</h3>
            <div style="display:flex; justify-content:space-between; margin-bottom: 16px; color: var(--text-muted);">
                <span>Subtotal</span>
                <span style="color: var(--text-main); font-weight:600;">₹<?= number_format($total, 2) ?></span>
            </div>
            <div style="display:flex; justify-content:space-between; margin-bottom: 24px; color: var(--text-muted);">
                <span>Delivery</span>
                <span style="color: var(--success); font-weight:600;">Free</span>
            </div>
            
            <div style="display:flex; justify-content:space-between; margin-top: 24px; padding-top: 16px; border-top: 1px solid var(--border-color); font-size: 20px; font-weight: 800;">
                <span>Total</span>
                <span style="color: var(--primary-dark);">₹<?= number_format($total, 2) ?></span>
            </div>
            
            <a href="checkout.php" class="btn btn-primary" style="width: 100%; font-size: 16px; padding: 14px; margin-top: 32px; border-radius: var(--radius-full);">Proceed to Checkout <i class="fas fa-arrow-right" style="margin-left: 8px;"></i></a>
        </div>
    </div>
<?php else: ?>
    <div style="text-align: center; padding: 80px 0;">
        <i class="fas fa-shopping-basket" style="font-size: 64px; color: #e2e8f0; margin-bottom: 24px;"></i>
        <h3 style="font-size: 24px; margin-bottom: 16px;">Your cart is empty</h3>
        <p style="color: var(--text-muted); margin-bottom: 32px;">Looks like you haven't added anything yet.</p>
        <a href="products.php" class="btn btn-black" style="padding: 12px 32px;">Start Shopping</a>
    </div>
<?php endif; ?>

<?php include 'footer.php'; ?>
