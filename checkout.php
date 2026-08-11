<?php 
include 'header.php'; 

if(!isset($_SESSION['user_id'])) {
    echo "<script>alert('Please login to checkout'); window.location.href='login.php';</script>";
    exit;
}

$user_id = $_SESSION['user_id'];
$cart_stmt = $adminDetails->ret("SELECT SUM(price * quantity) as total FROM cart WHERE user_id='$user_id'");
$total = $cart_stmt->fetch(PDO::FETCH_ASSOC)['total'] ?? 0;

if($total == 0) {
    echo "<script>alert('Your cart is empty'); window.location.href='products.php';</script>";
    exit;
}

$user_stmt = $adminDetails->ret("SELECT * FROM users WHERE user_id='$user_id'");
$user = $user_stmt->fetch(PDO::FETCH_ASSOC);
?>

<div style="margin-bottom: 40px;">
    <span class="tag-label">Secure Checkout</span>
    <h2 style="font-size: 40px;">Complete Your Order</h2>
</div>

<div style="display: grid; grid-template-columns: 1fr 400px; gap: 40px; align-items: start;">
    <div class="auth-wrapper" style="margin: 0; max-width: 100%;">
        <form action="controller/user-checkout.php" method="POST">
            <h3 style="font-size: 20px; font-weight: 700; border-bottom: 1px solid var(--border-color); padding-bottom: 16px; margin-bottom: 24px;">Shipping Details</h3>
            
            <div class="form-group">
                <label>Delivery Address</label>
                <input type="text" name="delivery_address" class="form-control" value="<?= $user['address'] ?>" required>
            </div>
            
         
                <div class="form-group">
                    <label>City</label>
                    <input type="text" name="city" class="form-control" value="<?= $user['city'] ?>" required>
                </div>
               
         
                <div class="form-group">
                    <label>pincode</label>
                    <input type="number" name="pincode" class="form-control" value="<?= $user['pincode'] ?>" required>
                </div>
               
         
            
            <!-- <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px;"> -->
                <div class="form-group">
                    <label>Contact Phone</label>
                    <input type="text" name="phone" class="form-control" value="<?= $user['phone'] ?>" required pattern="\d{10}" title="Please enter a 10-digit phone number" maxlength="10" oninput="this.value = this.value.replace(/[^0-9]/g, '');">
                </div>
                
                <div class="form-group">
                    <select name="order_kg" id="order_kg" class="form-control">
                        <option value="1 KG">1 KG (Default)</option>
                        <option value="0.5 KG">0.5 KG</option>
                        <option value="1.5 KG">1.5 KG</option>
                        <option value="2 KG">2 KG</option>
                        <option value="3 KG">3 KG</option>
                        <option value="4 KG">4 KG</option>
                        <option value="5 KG">5 KG</option>
                    </select>
                </div>
            <!-- </div> -->
            
            <div class="form-group">
                <label>Order Notes (optional)</label>
                <textarea name="order_notes" class="form-control" rows="3" placeholder="Special instructions for delivery..."></textarea>
            </div>

            <h3 style="font-size: 20px; font-weight: 700; border-bottom: 1px solid var(--border-color); padding-bottom: 16px; margin: 40px 0 24px;">Payment Method</h3>
            
            <div class="radio-group">
                <label class="radio-card">
                    <input type="radio" name="payment_method" value="Cash on Delivery" checked>
                    <div>
                        <div style="font-weight: 600; font-size: 15px;">Cash on Delivery</div>
                        <div style="font-size: 13px; color: var(--text-muted);">Pay securely when the baker arrives.</div>
                    </div>
                </label>
                
                <label class="radio-card">
                    <input type="radio" name="payment_method" value="UPI">
                    <div>
                        <div style="font-weight: 600; font-size: 15px;">UPI / QR Code</div>
                        <div style="font-size: 13px; color: var(--text-muted);">Fast and secure digital payment.</div>
                    </div>
                </label>
                
                <label class="radio-card">
                    <input type="radio" name="payment_method" value="Credit Card">
                    <div>
                        <div style="font-weight: 600; font-size: 15px;">Credit / Debit Card</div>
                        <div style="font-size: 13px; color: var(--text-muted);">Mastercard, Visa, AMEX supported.</div>
                    </div>
                </label>
            </div>
            
            <!-- Card Details Section -->
            <div id="card-details-section" style="display:none; margin-top:20px; padding:20px; border:1px solid var(--border-color); border-radius:12px; background:var(--bg-secondary);">
                <h4 style="margin-bottom:15px; font-weight:600;">Card Details</h4>
                <div class="form-group">
                    <label>Cardholder Name</label>
                    <input type="text" id="card_name" name="card_name" class="form-control" placeholder="e.g. John Doe">
                </div>
                <div class="form-group">
                    <label>Card Number</label>
                    <input type="text" id="card_number" name="card_number" class="form-control" placeholder="XXXX XXXX XXXX XXXX" maxlength="19">
                </div>
                <div style="display:grid; grid-template-columns: 1fr 1fr; gap:16px;">
                    <div class="form-group">
                        <label>Expiry Date</label>
                        <input type="text" id="card_exp" name="card_exp" class="form-control" placeholder="MM/YY" maxlength="5">
                    </div>
                    <div class="form-group">
                        <label>CVV / CVC</label>
                        <input type="password" id="card_cvv" name="card_cvv" class="form-control" placeholder="123" maxlength="3">
                    </div>
                </div>
            </div>
            
            <button type="submit" name="checkout" class="btn btn-black" style="width: 100%; font-size: 16px; padding: 16px; margin-top: 40px; border-radius: var(--radius-full);">Confirm Order &middot; <span id="btn-total">₹<?= number_format($total, 2) ?></span></button>
        </form>
    </div>

    <!-- Order Summary Sticky Panel -->
    <div class="auth-wrapper" style="margin: 0; position: sticky; top: 100px; background: var(--bg-secondary); border: none;">
        <h3 style="font-size: 20px; font-weight: 700; border-bottom: 1px solid var(--border-color); padding-bottom: 16px; margin-bottom: 24px;">Your Order</h3>
        
        <div style="max-height: 300px; overflow-y: auto; margin-bottom: 24px;">
            <?php
            $items = $adminDetails->ret("SELECT c.*, p.name FROM cart c JOIN products p ON c.product_id = p.product_id WHERE c.user_id='$user_id'");
            while($item = $items->fetch(PDO::FETCH_ASSOC)):
            ?>
            <div style="display:flex; justify-content:space-between; margin-bottom: 16px;">
                <div style="display:flex; gap: 8px;">
                    <span style="color:var(--primary); font-weight:600;"><?= $item['quantity'] ?>x</span>
                    <span style="font-weight:500;"><?= $item['name'] ?></span>
                </div>
                <span style="font-weight:600; color:var(--text-muted);">₹<?= number_format($item['price']*$item['quantity'], 2) ?></span>
            </div>
            <?php endwhile; ?>
        </div>
        
        <div style="display:flex; justify-content:space-between; margin-bottom: 16px; color: var(--text-muted);">
            <span>Subtotal</span>
            <span id="summary-subtotal" style="font-weight:600; color:var(--text-main);">₹<?= number_format($total, 2) ?></span>
        </div>
        <div style="display:flex; justify-content:space-between; margin-bottom: 24px; color: var(--text-muted);">
            <span>Delivery</span>
            <span style="color: var(--success); font-weight:600;">Free</span>
        </div>
        
        <div style="display:flex; justify-content:space-between; padding-top: 16px; border-top: 1px dashed var(--border-color); font-size: 20px; font-weight: 800;">
            <span>Total</span>
            <span id="summary-total" style="color: var(--primary-dark);">₹<?= number_format($total, 2) ?></span>
        </div>
    </div>
</div>

<!-- UPI Scanner Modal -->
<div id="upi-scanner-modal" style="display:none; position:fixed; top:0; left:0; width:100%; height:100vh; background:rgba(0,0,0,0.7); z-index:9999; align-items:center; justify-content:center;">
    <div style="background:white; padding:40px; border-radius:24px; text-align:center; box-shadow: 0 10px 40px rgba(0,0,0,0.2);">
        <h3 style="margin-bottom:10px; font-weight:700;">Scan QR to Pay</h3>
        <p style="color:var(--text-muted); margin-bottom:20px;">Use any UPI App to complete your payment.</p>
        <div style="width:220px; height:220px; background:#f1f5f9; margin:0 auto 20px; display:flex; align-items:center; justify-content:center; border:2px dashed #cbd5e1; border-radius:12px;">
            <i class="fas fa-qrcode" style="font-size:100px; color:#94a3b8;"></i>
        </div>
        <div style="display:flex; align-items:center; justify-content:center; gap:10px; color:var(--primary); font-weight:600;">
            <i class="fas fa-circle-notch fa-spin"></i> Awaiting payment...
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.querySelector('form[action="controller/user-checkout.php"]');
    const radios = document.querySelectorAll('input[name="payment_method"]');
    const cardSection = document.getElementById('card-details-section');
    const cardInputs = cardSection.querySelectorAll('input');
    const upiModal = document.getElementById('upi-scanner-modal');

    // Format Card Number (space every 4 digits)
    document.getElementById('card_number').addEventListener('input', function (e) {
        let value = e.target.value.replace(/\D/g, '');
        e.target.value = value.replace(/(.{4})/g, '$1 ').trim();
    });
    
    // Format Expiry Date (MM/YY)
    document.getElementById('card_exp').addEventListener('input', function (e) {
        let value = e.target.value.replace(/\D/g, '');
        if (value.length > 2) {
            value = value.substring(0, 2) + '/' + value.substring(2, 4);
        }
        e.target.value = value;
    });

    // Enforce Numbers Only for CVV
    document.getElementById('card_cvv').addEventListener('input', function (e) {
        e.target.value = e.target.value.replace(/\D/g, '');
    });

    // Toggle Card required fields dynamically
    radios.forEach(radio => {
        radio.addEventListener('change', function() {
            if (this.value === 'Credit Card') {
                cardSection.style.display = 'block';
                cardInputs.forEach(input => input.setAttribute('required', 'required'));
            } else {
                cardSection.style.display = 'none';
                cardInputs.forEach(input => {
                    input.removeAttribute('required');
                    input.value = ''; // Reset fields if hidden
                });
            }
        });
    });

    // Handle Form Submission for UPI
    let upiProcessed = false;
    form.addEventListener('submit', function(e) {
        const selectedPayment = document.querySelector('input[name="payment_method"]:checked').value;
        
        if (selectedPayment === 'UPI' && !upiProcessed) {
            e.preventDefault(); // Stop initial submission
            upiModal.style.display = 'flex'; // Show modal
            
            setTimeout(() => {
                upiModal.style.display = 'none'; // Hide modal
                alert('Payment is successful! Processing your order...');
                upiProcessed = true; // Mark as paid to avoid loops
                
                // Add hidden input to mimic the submit button being clicked
                const btnVal = document.createElement('input');
                btnVal.type = 'hidden';
                btnVal.name = 'checkout';
                btnVal.value = '1';
                form.appendChild(btnVal);
                
                form.submit(); // Natively submit to backend
            }, 3000);
        }
    });

    // KG Weight Price Calculation
    const baseTotal = <?= $total ?>;
    const kgSelect = document.getElementById('order_kg');
    const btnTotal = document.getElementById('btn-total');
    const summarySubtotal = document.getElementById('summary-subtotal');
    const summaryTotal = document.getElementById('summary-total');

    function updatePrices() {
        const kgValue = kgSelect.value;
        let multiplier = 1;
        
        if (kgValue) {
            multiplier = parseFloat(kgValue);
        }
        
        const newTotal = baseTotal * multiplier;
        const formattedTotal = '₹' + newTotal.toLocaleString('en-IN', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
        
        btnTotal.textContent = formattedTotal;
        summarySubtotal.textContent = formattedTotal;
        summaryTotal.textContent = formattedTotal;
    }

    kgSelect.addEventListener('change', updatePrices);
});
</script>

<?php include 'footer.php'; ?>
