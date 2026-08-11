<?php include 'header.php'; ?>
<div class="login-body">
    <div class="login-card">
        <div class="login-logo">
            <i class="fab fa-dyalog"></i>
            <span>SKODASH</span>
        </div>
        <h3 style="text-align:center; color:var(--text-main); margin-bottom: 30px; font-weight: 600;">Agent Login Portal</h3>
        <form action="../controller/DeliveryPerson-login.php" method="POST">
            <div class="form-group">
                <label>Agent Email</label>
                <input type="email" name="email" class="form-control" placeholder="Enter your email" required>
            </div>
            <div class="form-group">
                <label style="display: flex; justify-content: space-between;">
                    Password
                    <!-- <a href="#" style="color: var(--primary); font-size: 12px; text-decoration: none;">Forgot?</a> -->
                </label>
                <input type="password" name="password" class="form-control" placeholder="Agent password" required>
            </div>
            <button type="submit" name="login" class="btn btn-primary" style="width: 100%; font-size: 15px; padding: 12px; margin-top:10px;">Login to Dashboard</button>
        </form>
    </div>
</div>
<?php include 'footer.php'; ?>
