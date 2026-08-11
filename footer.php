</main>

<footer class="footer" style="border-top: 1px solid var(--border-color); padding: 80px 0 40px; margin-top: 60px; background: var(--bg-main); color: var(--text-main);">
    <div class="container">
        <div style="display: grid; grid-template-columns: 2fr 1fr 1fr 1fr; gap: 40px; text-align: left;">
            <!-- Brand -->
            <div>
                <a href="index.php" class="brand-logo" style="margin-bottom: 24px; display: inline-flex;">
                    <span style="background: var(--black-btn); color: white; border-radius: 8px; padding: 4px 8px; font-size: 16px; margin-right: 8px;"><i class="fas fa-cookie-bite"></i></span>
                    Bakery
                </a>
                <p style="color: var(--text-muted); font-size: 14px; line-height: 1.6; max-width: 250px; margin-bottom: 32px;">
                    Freshly baked cakes, pastries and desserts delivered to your door. Enjoy sweetness in every bite!
                </p>
                <p style="color: var(--text-muted); font-size: 13px;">
                    &copy; <?= date('Y') ?> Online Bakery.<br>All rights reserved.
                </p>
            </div>

            <!-- Links -->
            <div>
                <h4 style="font-size: 14px; font-weight: 700; margin-bottom: 24px; text-transform: uppercase; letter-spacing: 0.5px;">Quick Links</h4>
                <ul style="list-style: none; padding: 0; margin: 0; display: flex; flex-direction: column; gap: 16px;">
                    <li><a href="index.php" style="color: var(--text-muted); text-decoration: none; font-size: 14px; transition: color 0.2s;" onmouseover="this.style.color='var(--text-main)'" onmouseout="this.style.color='var(--text-muted)'">Home</a></li>
                    <li><a href="products.php" style="color: var(--text-muted); text-decoration: none; font-size: 14px; transition: color 0.2s;" onmouseover="this.style.color='var(--text-main)'" onmouseout="this.style.color='var(--text-muted)'">Products</a></li>
                    <li><a href="about.php" style="color: var(--text-muted); text-decoration: none; font-size: 14px; transition: color 0.2s;" onmouseover="this.style.color='var(--text-main)'" onmouseout="this.style.color='var(--text-muted)'">About Us</a></li>
                    <li><a href="service.php" style="color: var(--text-muted); text-decoration: none; font-size: 14px; transition: color 0.2s;" onmouseover="this.style.color='var(--text-main)'" onmouseout="this.style.color='var(--text-muted)'">Services</a></li>
                </ul>
            </div>

            <!-- Legal / Access -->
            <div>
                <h4 style="font-size: 14px; font-weight: 700; margin-bottom: 24px; text-transform: uppercase; letter-spacing: 0.5px;">Legal</h4>
                <ul style="list-style: none; padding: 0; margin: 0; display: flex; flex-direction: column; gap: 16px;">
                    <li><a href="#" style="color: var(--text-muted); text-decoration: none; font-size: 14px; transition: color 0.2s;" onmouseover="this.style.color='var(--text-main)'" onmouseout="this.style.color='var(--text-muted)'">Privacy Policy</a></li>
                    <li><a href="#" style="color: var(--text-muted); text-decoration: none; font-size: 14px; transition: color 0.2s;" onmouseover="this.style.color='var(--text-main)'" onmouseout="this.style.color='var(--text-muted)'">Terms of Service</a></li>
                    <li><a href="admin/login.php" style="color: var(--text-muted); text-decoration: none; font-size: 14px; transition: color 0.2s;" onmouseover="this.style.color='var(--text-main)'" onmouseout="this.style.color='var(--text-muted)'">Admin Portal</a></li>
                    <li><a href="DeliveryPerson/login.php" style="color: var(--text-muted); text-decoration: none; font-size: 14px; transition: color 0.2s;" onmouseover="this.style.color='var(--text-main)'" onmouseout="this.style.color='var(--text-muted)'">Agent Portal</a></li>
                </ul>
            </div>

            <!-- Social Media -->
            <div>
                <h4 style="font-size: 14px; font-weight: 700; margin-bottom: 24px; text-transform: uppercase; letter-spacing: 0.5px;">Social</h4>
                <div style="display: flex; gap: 16px;">
                    <a href="#" style="color: var(--text-muted); font-size: 18px; transition: color 0.2s;" onmouseover="this.style.color='var(--text-main)'" onmouseout="this.style.color='var(--text-muted)'"><i class="fab fa-twitter"></i></a>
                    <a href="#" style="color: var(--text-muted); font-size: 18px; transition: color 0.2s;" onmouseover="this.style.color='var(--text-main)'" onmouseout="this.style.color='var(--text-muted)'"><i class="fab fa-instagram"></i></a>
                    <a href="#" style="color: var(--text-muted); font-size: 18px; transition: color 0.2s;" onmouseover="this.style.color='var(--text-main)'" onmouseout="this.style.color='var(--text-muted)'"><i class="fab fa-facebook-f"></i></a>
                </div>
            </div>
        </div>
    </div>
</footer>

</body>
</html>