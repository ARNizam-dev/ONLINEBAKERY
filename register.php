<?php include 'header.php'; ?>

<div class="auth-page-body">
    <!-- Floating Background Elements -->
    <div class="sphere sphere-1"></div>
    <div class="sphere sphere-2"></div>
    <div class="sphere sphere-3"></div>

    <div class="auth-card">
        <!-- Left Side: Visual -->
        <div class="auth-left">
            <img src="uploads/image1.jpg" alt="Background" class="auth-left-bg">
            <div class="auth-left-overlay"></div>
            <div class="auth-left-content">
                <a href="index.php" class="brand-logo" style="color: white; border: none; padding: 0;">
                    <!-- <span style="background: white; color: var(--primary); padding: 4px 8px; border-radius: 8px;">OB</span> -->
                    BAKECART
                </a>
                
                <div class="glass-card" >
                    <h3 style="color: rgba(255, 255, 255, 1);">Join our tribe of bakery lovers.</h3>
                    <p style="color: rgba(255, 255, 255, 1);">Experience the finest pastries and cakes delivered straight to your doorstep. Every bite is a piece of heaven.</p>
                </div>
                
                <div style="font-size: 14px; color: rgba(255, 255, 255, 1);">
                    &copy; 2026 Online Bakery Inc.
                </div>
            </div>
        </div>

        <!-- Right Side: Form -->
        <div class="auth-right">
            <div class="auth-form-header">
                <span class="tag-label" style="background: #e2fef9; color: #0d9488;">Sign Up</span>
                <h2>Create account</h2>
                <p>Start ordering fresh baked goods today.</p>
            </div>

            <form id="registrationForm">
                <input type="hidden" name="register" value="1">
                
                <div class="form-group">
                    <label>Full Name</label>
                    <input type="text" name="name" class="form-control" placeholder="John Doe" pattern="[A-Za-z\s]+" title="Only alphabets and spaces are allowed" oninput="this.value = this.value.replace(/[^a-zA-Z\s]/g, '')" required>
                </div>

              <!-- Email + Phone -->
<div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px;">
    <div class="form-group">
        <label>Email Address</label>
        <input type="email" name="email" class="form-control" placeholder="you@example.com" required>
    </div>

    <div class="form-group">
        <label>Phone Number</label>
        <input 
            type="text"  
            name="phone" 
            class="form-control" 
            placeholder="Enter 10 digit number"
            pattern="[6-9][0-9]{9}" 
            title="Phone number must start with 6, 7, 8, or 9 and be 10 digits"
            maxlength="10"
            oninput="this.value = this.value.replace(/[^0-9]/g, '')"
            required>
    </div>
</div>

<!-- Password + Confirm Password -->
<div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px;">
    <div class="form-group">
        <label>Password</label>
        <input type="password" name="password" class="form-control" placeholder="Min 8 chars" minlength="8" pattern="(?=.*[.!:;@#$%^&*()]).{8,}" required>
    </div>

    <div class="form-group">
        <label>Confirm Password</label>
        <input type="password" name="cpassword" class="form-control" placeholder="Repeat password" required>
    </div>
</div>

                <div class="form-group">
                    <label>Delivery Address</label>
                    <input type="text" name="address" class="form-control" placeholder="Street layout, House No." required>
                </div>

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px;">
                    <div class="form-group">
                        <label>City</label>
                        <input type="text" name="city" class="form-control" placeholder="City" required>
                    </div>
                    <div class="form-group">
                        <label>Pincode</label>
                        <input type="text" name="pincode" class="form-control" placeholder="6-digit Pincode" pattern="\d{6}" title="Pincode must be exactly 6 digits" maxlength="6" oninput="this.value = this.value.replace(/[^0-9]/g, '');" required>
                    </div>
                </div>
                
                <button type="submit" id="submitBtn" class="btn btn-primary" style="width: 100%; font-size: 16px; padding: 14px; margin-top: 16px; display: flex; align-items: center; justify-content: center; background: #0d9488; border-radius: 12px;">
                    <div class="spinner" style="display: none;"></div>
                    <span class="btn-text">Create Account</span>
                </button>
            </form>
            
            <p style="text-align: center; margin-top: 24px; font-size: 14px; color: var(--text-muted);">
                Already have an account? <a href="login.php" style="color: #0d9488; font-weight: 600; text-decoration: none;">Sign in here</a>
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

.spinner {
    width: 18px;
    height: 18px;
    border: 2px solid rgba(255,255,255,0.3);
    border-radius: 50%;
    border-top-color: #fff;
    animation: spin 1s ease-in-out infinite;
    display: inline-block;
    vertical-align: middle;
    margin-right: 8px;
}

@keyframes spin {
    to { transform: rotate(360deg); }
}

.btn:disabled {
    opacity: 0.8;
    cursor: not-allowed;
}

/* Hide header/footer on auth pages */
.navbar, .footer { display: none !important; }

/* Mobile fallback: only scale down, don't stack unless very small */
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

<script>
document.getElementById('registrationForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const form = this;
    const btn = document.getElementById('submitBtn');
    const btnText = btn.querySelector('.btn-text');
    const spinner = btn.querySelector('.spinner');
    const password = form.password.value;
    const cpassword = form.cpassword.value;

    // Client-side confirmation check
    if (password !== cpassword) {
        alert('Passwords do not match');
        return;
    }

    // Show loading state
    btn.disabled = true;
    spinner.style.display = 'inline-block';
    btnText.innerText = 'Processing...';

    const formData = new FormData(form);

    fetch('controller/user-register.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.status === 'success') {
            alert(data.message);
            window.location.href = 'login.php';
        } else {
            alert(data.message);
            // Re-enable button
            btn.disabled = false;
            spinner.style.display = 'none';
            btnText.innerText = 'Create Account';
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('An error occurred. Please try again.');
        btn.disabled = false;
        spinner.style.display = 'none';
        btnText.innerText = 'Create Account';
    });
});
</script>

<?php include 'footer.php'; ?>

