<?php include 'header.php'; ?>
<div class="login-body">
    <div class="login-card">
        <div class="login-logo">
            <span style="background: var(--primary); padding: 5px; border-radius: 6px; display: inline-flex; justify-content: center; align-items: center; width: 40px; height: 40px;">
                <i class="fas fa-chart-bar" style="color: white; font-size: 20px;"></i>
            </span>
            <span style="color: var(--text-main);">TailAdmin</span>
        </div>
        <div class="login-title">
            Sign In to TailAdmin
        </div>
        <form action="../controller/admin-login.php" method="POST">
            <div class="form-group">
                <label>Email</label>
                <div style="position: relative;">
                    <i class="far fa-envelope" style="position: absolute; left: 16px; top: 12px; color: var(--text-muted);"></i>
                    <input type="email" name="email" class="form-control" placeholder="Enter your email" style="padding-left: 45px;" required>
                </div>
            </div>
            <div class="form-group">
                <label>Password</label>
                <div style="position: relative;">
                    <i class="fas fa-lock" style="position: absolute; left: 16px; top: 12px; color: var(--text-muted);"></i>
                    <input type="password" name="password" class="form-control" placeholder="6+ Characters, 1 Capital letter" style="padding-left: 45px;" required>
                </div>
            </div>
            <button type="submit" name="login" class="btn btn-primary" style="width: 100%; justify-content: center; padding: 12px; font-size: 16px;">Sign In</button>
        </form>
    </div>
</div>
<?php include 'footer.php'; ?>
