<?php
include 'config.php';
$adminDetails = new Admin();

// Get Cart items count
$cart_count = 0;
if(isset($_SESSION['user_id'])) {
    $uid = $_SESSION['user_id'];
    $stmt = $adminDetails->ret("SELECT SUM(quantity) as c FROM cart WHERE user_id='$uid'");
    $cart_count = $stmt->fetch(PDO::FETCH_ASSOC)['c'] ?? 0;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online Bakery</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,400;0,600;0,700;1,400;1,600&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">

    <style>
        /* ── DESIGN TOKENS (shared across all pages) ── */
        :root {
            --cream:        #faf7f2;
            --warm-white:   #fffdf9;
            --ink:          #1a1410;
            --ink-light:    #4a3f35;
            --ink-muted:    #8c7b6e;
            --gold:         #c9a96e;
            --gold-light:   #e8d5b0;
            --gold-pale:    #f5edd8;
            --rust:         #b85c38;
            --sage:         #7a8c6e;
            --success:      #7a8c6e;
            --warning:      #e8b84b;
            --border:       rgba(26,20,16,0.1);
            --border-warm:  rgba(201,169,110,0.22);
            --shadow-sm:    0 2px 12px rgba(26,20,16,0.06);
            --shadow-md:    0 8px 40px rgba(26,20,16,0.10);
            --shadow-lg:    0 24px 80px rgba(26,20,16,0.15);

            /* legacy aliases so existing style.css rules don't break */
            --primary:      #c9a96e;
            --primary-dark: #a6834a;
            --black-btn:    #1a1410;
            --text-main:    #1a1410;
            --text-muted:   #8c7b6e;
            --bg-main:      #faf7f2;
        }

        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: 'DM Sans', sans-serif;
            background: var(--warm-white);
            color: var(--ink);
            overflow-x: hidden;
        }

        h1, h2, h3, h4, h5 {
            font-family: 'Cormorant Garamond', serif;
        }

        /* ── ANNOUNCEMENT BAR ── */
        .announcement-bar {
            background: var(--ink);
            color: rgba(255,255,255,0.75);
            text-align: center;
            font-size: 12px;
            letter-spacing: 0.12em;
            font-weight: 400;
            padding: 9px 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }

        .announcement-bar strong {
            color: var(--gold);
            font-weight: 600;
        }

        .announcement-dot {
            width: 4px; height: 4px;
            background: var(--gold);
            border-radius: 50%;
            opacity: 0.6;
        }

        /* ── NAVBAR ── */
        .navbar {
            position: sticky;
            top: 0;
            z-index: 100;
            background: rgba(255, 253, 249, 0.92);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border-bottom: 1px solid var(--border-warm);
            transition: box-shadow 0.3s;
        }

        .navbar.scrolled {
            box-shadow: 0 4px 32px rgba(26,20,16,0.08);
        }

        .nav-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 32px;
            height: 72px;
            display: flex;
            align-items: center;
            gap: 48px;
        }

        /* Brand */
        .brand-logo {
            display: flex;
            align-items: center;
            gap: 10px;
            text-decoration: none;
            flex-shrink: 0;
        }

        .brand-icon {
            width: 38px; height: 38px;
            background: var(--ink);
            border-radius: 10px;
            display: flex; align-items: center; justify-content: center;
            color: var(--gold);
            font-size: 17px;
            transition: background 0.2s, transform 0.2s;
        }

        .brand-logo:hover .brand-icon {
            background: var(--gold);
            color: var(--ink);
            transform: rotate(-6deg);
        }

        .brand-name {
            font-family: 'Cormorant Garamond', serif;
            font-size: 22px;
            font-weight: 700;
            color: var(--ink);
            letter-spacing: -0.01em;
            line-height: 1;
        }

        .brand-name span {
            font-style: italic;
            color: var(--gold);
        }

        /* Nav links */
        .nav-links {
            display: flex;
            align-items: center;
            gap: 4px;
            flex: 1;
        }

        .nav-links a {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 8px 14px;
            border-radius: 999px;
            font-size: 13.5px;
            font-weight: 500;
            color: var(--ink-muted);
            text-decoration: none;
            letter-spacing: 0.01em;
            position: relative;
            transition: color 0.2s, background 0.2s;
        }

        .nav-links a:hover {
            color: var(--ink);
            background: var(--gold-pale);
        }

        .nav-links a.active {
            color: var(--ink);
            background: var(--gold-pale);
            font-weight: 600;
        }

        /* Nav actions */
        .nav-actions {
            display: flex;
            align-items: center;
            gap: 10px;
            flex-shrink: 0;
        }

        /* Auth greeting */
        .nav-greeting {
            font-size: 13px;
            font-weight: 500;
            color: var(--ink-light);
            padding: 0 4px;
        }

        .nav-greeting strong {
            color: var(--ink);
            font-weight: 600;
        }

        /* Buttons */
        .nav-btn-ghost {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 8px 20px;
            border-radius: 999px;
            font-family: 'DM Sans', sans-serif;
            font-size: 13px;
            font-weight: 500;
            color: var(--ink-light);
            border: 1px solid var(--border);
            background: transparent;
            text-decoration: none;
            letter-spacing: 0.01em;
            transition: border-color 0.2s, color 0.2s, background 0.2s;
            cursor: pointer;
        }

        .nav-btn-ghost:hover {
            border-color: var(--gold);
            color: var(--gold);
            background: var(--gold-pale);
        }

        .nav-btn-solid {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 9px 22px;
            border-radius: 999px;
            font-family: 'DM Sans', sans-serif;
            font-size: 13px;
            font-weight: 600;
            color: #fff;
            background: var(--ink);
            text-decoration: none;
            letter-spacing: 0.01em;
            transition: background 0.2s, transform 0.15s;
        }

        .nav-btn-solid:hover {
            background: var(--ink-light);
            transform: translateY(-1px);
        }

        /* Cart icon */
        .nav-cart {
            position: relative;
            width: 40px; height: 40px;
            display: flex; align-items: center; justify-content: center;
            border-radius: 50%;
            border: 1px solid var(--border);
            color: var(--ink);
            text-decoration: none;
            font-size: 16px;
            transition: border-color 0.2s, background 0.2s, color 0.2s;
            background: transparent;
        }

        .nav-cart:hover {
            border-color: var(--gold);
            background: var(--gold-pale);
            color: var(--gold);
        }

        .cart-badge {
            position: absolute;
            top: -4px; right: -4px;
            background: var(--rust);
            color: #fff;
            font-size: 10px;
            font-weight: 700;
            min-width: 18px; height: 18px;
            border-radius: 999px;
            display: flex; align-items: center; justify-content: center;
            padding: 0 4px;
            border: 2px solid var(--warm-white);
            line-height: 1;
        }

        /* Divider */
        .nav-divider {
            width: 1px;
            height: 22px;
            background: var(--border);
            flex-shrink: 0;
        }

        /* Logout icon button */
        .nav-icon-btn {
            width: 38px; height: 38px;
            display: flex; align-items: center; justify-content: center;
            border-radius: 50%;
            color: var(--ink-muted);
            text-decoration: none;
            font-size: 15px;
            transition: background 0.2s, color 0.2s;
        }

        .nav-icon-btn:hover {
            background: #fde8e2;
            color: var(--rust);
        }

        /* ── MAIN CONTAINER ── */
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 32px;
        }

        /* ── SCROLL BEHAVIOUR ── */
    </style>
</head>
<body>

<!-- Announcement Bar -->
<div class="announcement-bar">
    <span class="announcement-dot"></span>
    <span>Free delivery on orders over <strong>₹499</strong> &nbsp;·&nbsp; Baked fresh every morning &nbsp;·&nbsp; Order before <strong>8 PM</strong> for next-day delivery</span>
    <span class="announcement-dot"></span>
</div>

<nav class="navbar" id="mainNav">
    <div class="nav-container">

        <!-- Brand -->
        <a href="index.php" class="brand-logo">
            <div class="brand-icon"><i class="fas fa-cookie-bite"></i></div>
            <div class="brand-name">BAKE<span>CART</span></div>
        </a>

        <!-- Links -->
        <div class="nav-links">
            <a href="index.php">Categories</a>
            <a href="products.php">All Products</a>
            <a href="about.php">About Us</a>
            <a href="service.php">Services</a>
            <?php if(isset($_SESSION['user_id'])): ?>
                <a href="order-history.php">My Orders</a>
            <?php endif; ?>
        </div>

        <!-- Actions -->
        <div class="nav-actions">
            <?php if(!isset($_SESSION['user_id'])): ?>
                <a href="login.php" class="nav-btn-ghost">Sign In</a>
                <a href="register.php" class="nav-btn-solid">
                    Create Account <i class="fas fa-arrow-right" style="font-size:10px;"></i>
                </a>
            <?php else: ?>
                <span class="nav-greeting">Hello, <strong><?= $_SESSION['name'] ?></strong></span>
                <div class="nav-divider"></div>
                <a href="cart.php" class="nav-cart" title="Cart">
                    <i class="fas fa-shopping-bag"></i>
                    <?php if($cart_count > 0): ?>
                    <span class="cart-badge"><?= $cart_count ?></span>
                    <?php endif; ?>
                </a>
                <a href="controller/user-logout.php" class="nav-icon-btn" title="Logout">
                    <i class="fas fa-sign-out-alt"></i>
                </a>
            <?php endif; ?>
        </div>

    </div>
</nav>

<main class="container">

<script>
    // Sticky shadow on scroll
    const nav = document.getElementById('mainNav');
    window.addEventListener('scroll', () => {
        nav.classList.toggle('scrolled', window.scrollY > 10);
    }, { passive: true });

    // Active link highlight
    const links = document.querySelectorAll('.nav-links a');
    links.forEach(link => {
        if (link.href === window.location.href) link.classList.add('active');
    });
</script>