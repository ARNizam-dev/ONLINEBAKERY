<?php include 'header.php'; ?>

<div class="auth-page-body">
    <!-- Floating Background Elements -->
    <div class="sphere sphere-1"></div>
    <div class="sphere sphere-2"></div>
    <div class="sphere sphere-3"></div>

    <div class="auth-card">
        <!-- Left Side: Visual -->
        <div class="auth-left">
            <img src="uploads/image2.jpg" alt="Background" class="auth-left-bg">
            <div class="auth-left-overlay"></div>
            <div class="auth-left-content">
                <a href="index.php" class="brand-logo" style="color: white; border: none; padding: 0;">
                    <!-- <span style="background: white; color: var(--primary); padding: 4px 8px; border-radius: 8px;">OB</span> -->
                    BAKECART
                </a>
                
                <div class="glass-card">
                    <h3 style="color: rgba(255, 255, 255, 1);">Welcome back!</h3>
                    <p style="color: rgba(255, 255, 255, 1);">We've missed you. Log in to your account to continue your journey through the world of delightful sweets and fresh bakes.</p>
                </div>
                
                <div style="font-size: 14px; color: rgba(255,255,255,0.7);">
                    &copy; 2026 Online Bakery Inc.
                </div>
            </div>
        </div>

        <!-- Right Side: Form -->
        <div class="auth-right">
            <div class="auth-form-header">
                <span class="tag-label" style="background: #e2fef9; color: #0d9488;">Welcome Back</span>
                <h2>Sign in</h2>
                <p>Access your account to order pastries.</p>
            </div>

            <form action="controller/user-login.php" method="POST">
                <div class="form-group">
                    <label>Email Address</label>
                    <input type="email" name="email" class="form-control" placeholder="you@example.com" required>
                </div>
                <div class="form-group">
                    <label style="display: flex; justify-content: space-between;">
                        Password
                        <!-- <a href="#" style="color: #0d9488; font-size: 12px; text-decoration: none;">Forgot?</a> -->
                    </label>
                    <input type="password" name="password" class="form-control" placeholder="••••••••" required>
                </div>
                
                <button type="submit" name="login" class="btn btn-primary" style="width: 100%; font-size: 16px; padding: 14px; margin-top: 16px; background: #0d9488; border-radius: 12px;">Sign in</button>
            </form>

            <p style="text-align: center; margin-top: 32px; font-size: 14px; color: var(--text-muted);">
                Don't have an account? <a href="register.php" style="color: #0d9488; font-weight: 600; text-decoration: none;">Create one now</a>
            </p>
        </div>
    </div>
</div>

<style>
/* Force Split Layout */
.auth-page-body {
    background-color: #83f3e1 !important;
    min-height: 100vh !important;
    display: flex !important;
    align-items: center !important;
    justify-content: center !important;
    padding: 20px !important;
    position: relative !important;
    overflow-x: hidden !important;
}

.auth-card {
    display: flex !important;
    flex-direction: row !important; /* Force horizontal */
    background: white !important;
    width: 100% !important;
    max-width: 1100px !important;
    min-height: 700px !important;
    border-radius: 40px !important;
    overflow: hidden !important;
    box-shadow: 0 40px 100px -20px rgba(0, 0, 0, 0.2) !important;
    position: relative !important;
    z-index: 10 !important;
}

.auth-left {
    flex: 1.1 !important;
    position: relative !important;
    overflow: hidden !important;
    padding: 60px !important;
    display: flex !important;
    flex-direction: column !important;
    justify-content: space-between !important;
    color: white !important;
    min-width: 400px !important;
}

.auth-left-bg {
    position: absolute !important;
    top: 0 !important;
    left: 0 !important;
    width: 100% !important;
    height: 100% !important;
    object-fit: cover !important;
    z-index: 0 !important;
}

.auth-left-overlay {
    position: absolute !important;
    top: 0 !important;
    left: 0 !important;
    width: 100% !important;
    height: 100% !important;
    background: linear-gradient(135deg, rgba(15, 23, 42, 0.2) 0%, rgba(15, 23, 42, 0.4) 100%) !important;
    z-index: 1 !important;
}

.auth-left-content {
    position: relative !important;
    z-index: 2 !important;
    height: 100% !important;
    display: flex !important;
    flex-direction: column !important;
    justify-content: space-between !important;
}

.auth-right {
    flex: 1 !important;
    padding: 60px !important;
    display: flex !important;
    flex-direction: column !important;
    justify-content: center !important;
    background: white !important;
    min-width: 350px !important;
}

/* Hide header/footer on auth pages */
.navbar, .footer { display: none !important; }

/* Mobile fallback */
@media (max-width: 768px) {
    .auth-card {
        flex-direction: column !important;
        max-width: 500px !important;
    }
    .auth-left {
        min-height: 300px !important;
        min-width: 100% !important;
    }
    .auth-right {
        min-width: 100% !important;
        padding: 40px 20px !important;
    }
}
</style>

<?php include 'footer.php'; ?>

