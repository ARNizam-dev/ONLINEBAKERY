
<?php include 'header.php'; ?>


<style>
@import url('https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,700;0,900;1,400;1,700&family=DM+Sans:wght@300;400;500;600&display=swap');


:root {
--cream: #fdf6ee;
--rose: #f4a0a0;
--blush: #fce4ec;
--deep: #2d1b12;
--caramel: #c8784a;
--caramel-light: #f5e6da;
--gold: #d4a96a;
--text-muted: #8a6f5e;
--white: #fff;
--shadow: 0 8px 40px rgba(45, 27, 18, 0.10);
--shadow-lg: 0 20px 60px rgba(45, 27, 18, 0.15);
}


* {
box-sizing: border-box;
}


body {
font-family: 'DM Sans', sans-serif;
background: var(--cream);
color: var(--deep);
margin: 0;
}


/* ─── ANIMATIONS ─── */
@keyframes fadeUp {
from {
opacity: 0;
transform: translateY(36px);
}


to {
opacity: 1;
transform: translateY(0);
}
}


@keyframes scaleIn {
from {
transform: scale(0.92);
opacity: 0;
}


to {
transform: scale(1);
opacity: 1;
}
}


@keyframes floatBadge {


0%,
100% {
transform: translateY(0px);
}


50% {
transform: translateY(-10px);
}
}


@keyframes marquee {
from {
transform: translateX(0);
}


to {
transform: translateX(-50%);
}
}


@keyframes pulse {


0%,
100% {
transform: scale(1);
}


50% {
transform: scale(1.06);
}
}


.animate-fadeup {
animation: fadeUp 0.8s cubic-bezier(.22, 1, .36, 1) both;
}


.delay-1 {
animation-delay: 0.1s;
}


.delay-2 {
animation-delay: 0.22s;
}


.delay-3 {
animation-delay: 0.36s;
}


.delay-4 {
animation-delay: 0.5s;
}


/* ─── MARQUEE TICKER ─── */
.marquee-wrap {
background: var(--deep);
color: var(--gold);
overflow: hidden;
white-space: nowrap;
padding: 13px 0;
font-family: 'DM Sans', sans-serif;
font-size: 13px;
font-weight: 500;
letter-spacing: 0.08em;
text-transform: uppercase;
}


.marquee-track {
display: inline-block;
animation: marquee 28s linear infinite;
}


.marquee-track span {
display: inline-block;
padding: 0 32px;
}


.marquee-track span i {
color: var(--rose);
margin-right: 8px;
}


/* ─── HERO ─── */
.hero {
display: grid;
grid-template-columns: 1fr 1fr;
gap: 56px;
align-items: center;
padding: 80px 60px 100px;
max-width: 1280px;
margin: 0 auto;
}


.hero-tag {
display: inline-flex;
align-items: center;
gap: 8px;
background: var(--blush);
color: var(--caramel);
border-radius: 999px;
padding: 6px 18px;
font-size: 13px;
font-weight: 600;
letter-spacing: 0.05em;
text-transform: uppercase;
margin-bottom: 24px;
}


.hero-tag i {
font-size: 12px;
animation: pulse 2s ease-in-out infinite;
}


.hero h1 {
font-family: 'Playfair Display', serif;
font-size: clamp(44px, 5vw, 68px);
font-weight: 900;
line-height: 1.08;
margin: 0 0 24px;
color: var(--deep);
}


.hero h1 em {
font-style: italic;
color: var(--caramel);
}


.hero-sub {
color: var(--text-muted);
font-size: 17px;
line-height: 1.75;
max-width: 480px;
margin-bottom: 36px;
}


.hero-btns {
display: flex;
gap: 14px;
flex-wrap: wrap;
}


.btn-primary-cake {
display: inline-flex;
align-items: center;
gap: 10px;
background: var(--caramel);
color: white;
border-radius: 999px;
padding: 16px 34px;
font-size: 16px;
font-weight: 600;
text-decoration: none;
box-shadow: 0 4px 24px rgba(200, 120, 74, 0.32);
transition: background 0.2s, transform 0.2s, box-shadow 0.2s;
}


.btn-primary-cake:hover {
background: #b5633a;
transform: translateY(-2px);
box-shadow: 0 8px 32px rgba(200, 120, 74, 0.40);
}


.btn-outline-cake {
display: inline-flex;
align-items: center;
gap: 10px;
background: transparent;
color: var(--deep);
border: 2px solid var(--deep);
border-radius: 999px;
padding: 16px 34px;
font-size: 16px;
font-weight: 600;
text-decoration: none;
transition: background 0.2s, color 0.2s, transform 0.2s;
}


.btn-outline-cake:hover {
background: var(--deep);
color: white;
transform: translateY(-2px);
}


.hero-social-proof {
display: flex;
align-items: center;
gap: 16px;
margin-top: 40px;
}


.avatar-stack {
display: flex;
}


.avatar-stack img {
width: 42px;
height: 42px;
border-radius: 50%;
border: 3px solid white;
margin-right: -10px;
object-fit: cover;
box-shadow: 0 2px 8px rgba(0, 0, 0, 0.12);
}


.proof-text {
font-size: 14px;
font-weight: 500;
}


.stars {
color: #f59e0b;
font-size: 12px;
margin-bottom: 3px;
}


/* ─── HERO IMAGE ─── */
.hero-img-wrap {
position: relative;
}


.hero-img-wrap img {
width: 100%;
height: 580px;
object-fit: cover;
border-radius: 40px;
box-shadow: var(--shadow-lg);
animation: scaleIn 1s cubic-bezier(.22, 1, .36, 1) both;
transition: transform 0.5s ease;
}


.hero-img-wrap:hover img {
transform: scale(1.02);
}


.hero-badge {
position: absolute;
bottom: 36px;
left: -40px;
background: white;
padding: 18px 22px;
border-radius: 22px;
box-shadow: var(--shadow-lg);
display: flex;
align-items: center;
gap: 14px;
animation: floatBadge 3s ease-in-out infinite;
z-index: 2;
}


.hero-badge-icon {
width: 50px;
height: 50px;
border-radius: 50%;
background: #dcfce7;
color: #16a34a;
display: flex;
align-items: center;
justify-content: center;
font-size: 22px;
}


.hero-badge-text strong {
display: block;
font-size: 18px;
font-weight: 800;
color: var(--deep);
}


.hero-badge-text span {
font-size: 13px;
color: var(--text-muted);
}


.hero-rating-badge {
position: absolute;
top: 32px;
right: -20px;
background: var(--caramel);
color: white;
padding: 16px 20px;
border-radius: 20px;
box-shadow: 0 8px 32px rgba(200, 120, 74, 0.35);
text-align: center;
animation: floatBadge 3.5s ease-in-out 0.5s infinite;
z-index: 2;
}


.hero-rating-badge .rating-num {
font-size: 26px;
font-weight: 900;
line-height: 1;
}


.hero-rating-badge .rating-label {
font-size: 11px;
opacity: 0.88;
}


/* ─── SECTION COMMON ─── */
.section-wrap {
max-width: 1280px;
margin: 0 auto;
padding: 0 60px;
}


.section-header {
text-align: center;
margin-bottom: 56px;
}


.section-tag {
display: inline-flex;
align-items: center;
gap: 8px;
background: var(--caramel-light);
color: var(--caramel);
border-radius: 999px;
padding: 6px 18px;
font-size: 12px;
font-weight: 700;
letter-spacing: 0.08em;
text-transform: uppercase;
margin-bottom: 18px;
}


.section-title {
font-family: 'Playfair Display', serif;
font-size: clamp(32px, 4vw, 46px);
font-weight: 800;
margin: 0 0 14px;
color: var(--deep);
}


.section-sub {
color: var(--text-muted);
font-size: 17px;
}


/* ─── STATS BAR ─── */
.stats-bar {
display: grid;
grid-template-columns: repeat(4, 1fr);
background: white;
border-radius: 28px;
box-shadow: var(--shadow);
margin-bottom: 120px;
overflow: hidden;
border: 1.5px solid #f0e8e0;
}


.stat-item {
padding: 40px 20px;
text-align: center;
border-right: 1.5px solid #f0e8e0;
transition: background 0.2s;
}


.stat-item:last-child {
border-right: none;
}


.stat-item:hover {
background: var(--caramel-light);
}


.stat-icon {
font-size: 28px;
margin-bottom: 12px;
display: block;
}


.stat-num {
font-family: 'Playfair Display', serif;
font-size: 38px;
font-weight: 900;
color: var(--caramel);
display: block;
line-height: 1;
}


.stat-label {
font-size: 14px;
color: var(--text-muted);
margin-top: 6px;
font-weight: 500;
}


/* ─── CATEGORIES ─── */
.cat-grid {
display: grid;
grid-template-columns: repeat(3, 1fr);
gap: 28px;
margin-bottom: 120px;
}


.cat-card {
border-radius: 28px;
overflow: hidden;
text-decoration: none;
color: var(--deep);
background: white;
box-shadow: var(--shadow);
position: relative;
transition: transform 0.35s cubic-bezier(.22, 1, .36, 1), box-shadow 0.35s;
display: block;
}


.cat-card:hover {
transform: translateY(-8px) scale(1.02);
box-shadow: var(--shadow-lg);
}


.cat-card img {
width: 100%;
height: 220px;
object-fit: cover;
transition: transform 0.5s ease;
}


.cat-card:hover img {
transform: scale(1.08);
}


.cat-card-body {
padding: 24px;
text-align: center;
}


.cat-card-body h3 {
font-family: 'Playfair Display', serif;
font-size: 20px;
font-weight: 700;
margin: 0 0 8px;
}


.cat-card-body p {
font-size: 14px;
color: var(--text-muted);
margin: 0 0 16px;
}


.cat-link {
display: inline-flex;
align-items: center;
gap: 6px;
color: var(--caramel);
font-size: 14px;
font-weight: 600;
transition: gap 0.2s;
}


.cat-card:hover .cat-link {
gap: 12px;
}


/* ─── PROMO BANNER ─── */
.promo-banner {
background: var(--deep);
border-radius: 36px;
overflow: hidden;
display: grid;
grid-template-columns: 1.2fr 1fr;
margin-bottom: 120px;
box-shadow: var(--shadow-lg);
}


.promo-content {
padding: 70px 60px;
color: white;
display: flex;
flex-direction: column;
justify-content: center;
}


.promo-tag {
display: inline-flex;
align-items: center;
gap: 8px;
background: rgba(212, 169, 106, 0.2);
color: var(--gold);
border-radius: 999px;
padding: 6px 18px;
font-size: 12px;
font-weight: 700;
letter-spacing: 0.08em;
text-transform: uppercase;
margin-bottom: 20px;
width: fit-content;
}


.promo-content h2 {
font-family: 'Playfair Display', serif;
font-size: clamp(32px, 3.5vw, 50px);
font-weight: 900;
line-height: 1.1;
margin: 0 0 20px;
color: white;
}


.promo-content h2 em {
font-style: italic;
color: var(--gold);
}


.promo-content p {
color: #c4b4a8;
font-size: 17px;
line-height: 1.7;
margin-bottom: 36px;
}


.promo-checklist {
list-style: none;
padding: 0;
margin: 0 0 40px;
display: flex;
flex-direction: column;
gap: 14px;
}


.promo-checklist li {
display: flex;
align-items: center;
gap: 12px;
font-weight: 500;
font-size: 15px;
color: #e8d8ce;
}


.promo-checklist li i {
color: #4ade80;
font-size: 18px;
}


.promo-img {
overflow: hidden;
}


.promo-img img {
width: 100%;
height: 100%;
object-fit: cover;
transition: transform 0.6s ease;
min-height: 440px;
}


.promo-banner:hover .promo-img img {
transform: scale(1.05);
}


/* ─── HOW IT WORKS ─── */
.steps-grid {
display: grid;
grid-template-columns: repeat(3, 1fr);
gap: 36px;
margin-bottom: 120px;
}


.step-card {
background: white;
border-radius: 28px;
padding: 48px 28px 40px;
text-align: center;
position: relative;
box-shadow: var(--shadow);
border: 1.5px solid #f0e8e0;
transition: transform 0.3s ease, box-shadow 0.3s ease;
}


.step-card:hover {
transform: translateY(-6px);
box-shadow: var(--shadow-lg);
}


.step-num {
position: absolute;
top: -20px;
left: 50%;
transform: translateX(-50%);
background: var(--deep);
color: var(--gold);
width: 42px;
height: 42px;
border-radius: 50%;
display: flex;
align-items: center;
justify-content: center;
font-family: 'Playfair Display', serif;
font-weight: 800;
font-size: 18px;
border: 4px solid var(--cream);
box-shadow: 0 4px 16px rgba(45, 27, 18, 0.18);
}


.step-icon-wrap {
width: 90px;
height: 90px;
border-radius: 50%;
background: var(--caramel-light);
display: flex;
align-items: center;
justify-content: center;
margin: 18px auto 24px;
font-size: 36px;
transition: transform 0.3s ease;
}


.step-card:hover .step-icon-wrap {
transform: rotate(-8deg) scale(1.1);
}


.step-card h3 {
font-family: 'Playfair Display', serif;
font-size: 22px;
font-weight: 700;
margin: 0 0 12px;
}


.step-card p {
color: var(--text-muted);
font-size: 15px;
line-height: 1.65;
margin: 0;
}


/* ─── TESTIMONIALS ─── */
.testimonials-section {
background: linear-gradient(135deg, #fff5f5 0%, #fdf6ee 50%, #fff5f7 100%);
border-radius: 40px;
padding: 80px 60px;
margin-bottom: 120px;
border: 1.5px solid #f4ddd0;
}


.testi-grid {
display: grid;
grid-template-columns: repeat(3, 1fr);
gap: 28px;
}


.testi-card {
background: white;
border-radius: 24px;
padding: 36px;
box-shadow: var(--shadow);
border: 1px solid #f5ede6;
transition: transform 0.3s ease, box-shadow 0.3s ease;
position: relative;
overflow: hidden;
}


.testi-card::before {
content: '"';
font-family: 'Playfair Display', serif;
font-size: 120px;
color: var(--caramel-light);
position: absolute;
top: -10px;
right: 20px;
line-height: 1;
pointer-events: none;
}


.testi-card:hover {
transform: translateY(-5px);
box-shadow: var(--shadow-lg);
}


.testi-stars {
color: #f59e0b;
font-size: 13px;
margin-bottom: 16px;
display: flex;
gap: 3px;
}


.testi-text {
font-size: 15px;
font-style: italic;
color: #4a3728;
line-height: 1.7;
margin-bottom: 24px;
position: relative;
z-index: 1;
}


.testi-author {
display: flex;
align-items: center;
gap: 14px;
}


.testi-author img {
width: 48px;
height: 48px;
border-radius: 50%;
object-fit: cover;
}


.testi-author-name {
font-weight: 700;
font-size: 15px;
color: var(--deep);
}


.testi-author-label {
font-size: 12px;
color: var(--text-muted);
}


/* ─── CTA ─── */
.cta-section {
border-radius: 40px;
overflow: hidden;
margin-bottom: 80px;
position: relative;
min-height: 460px;
display: flex;
align-items: center;
justify-content: center;
}


.cta-bg {
position: absolute;
inset: 0;
background-image: url('https://images.unsplash.com/photo-1578985545062-69928b1d9587?q=80&w=1500&auto=format&fit=crop');
background-size: cover;
background-position: center;
transition: transform 0.6s ease;
}


.cta-section:hover .cta-bg {
transform: scale(1.04);
}


.cta-overlay {
position: absolute;
inset: 0;
background: linear-gradient(135deg, rgba(45, 27, 18, 0.88) 0%, rgba(200, 120, 74, 0.72) 100%);
}


.cta-content {
position: relative;
z-index: 2;
text-align: center;
color: white;
padding: 60px 20px;
max-width: 640px;
}


.cta-content h2 {
font-family: 'Playfair Display', serif;
font-size: clamp(34px, 4vw, 54px);
font-weight: 900;
margin: 0 0 20px;
}


.cta-content p {
font-size: 18px;
color: #f0ddd4;
margin-bottom: 40px;
line-height: 1.65;
}


.cta-btns {
display: flex;
gap: 16px;
justify-content: center;
flex-wrap: wrap;
}


.btn-cta-main {
display: inline-flex;
align-items: center;
gap: 10px;
background: var(--gold);
color: var(--deep);
border-radius: 999px;
padding: 16px 40px;
font-size: 17px;
font-weight: 700;
text-decoration: none;
box-shadow: 0 4px 28px rgba(212, 169, 106, 0.4);
transition: transform 0.2s, box-shadow 0.2s, background 0.2s;
}


.btn-cta-main:hover {
transform: translateY(-2px);
background: #e8c07a;
}


.btn-cta-outline {
display: inline-flex;
align-items: center;
gap: 10px;
background: transparent;
color: white;
border: 2px solid rgba(255, 255, 255, 0.7);
border-radius: 999px;
padding: 16px 40px;
font-size: 17px;
font-weight: 600;
text-decoration: none;
transition: background 0.2s, border-color 0.2s, transform 0.2s;
}


.btn-cta-outline:hover {
background: rgba(255, 255, 255, 0.12);
border-color: white;
transform: translateY(-2px);
}
</style>


<!-- ═══ MARQUEE TICKER ═══ -->
<div class="marquee-wrap">
<div class="marquee-track">
<span><i class="fas fa-birthday-cake"></i> Free Delivery on Orders Above ₹499</span>
<span><i class="fas fa-star"></i> 100% Fresh — Baked Every Morning</span>
<span><i class="fas fa-gift"></i> Custom Cakes Available — Order 48hrs in Advance</span>
<span><i class="fas fa-leaf"></i> Organic Ingredients, Always</span>
<span><i class="fas fa-birthday-cake"></i> Free Delivery on Orders Above ₹499</span>
<span><i class="fas fa-star"></i> 100% Fresh — Baked Every Morning</span>
<span><i class="fas fa-gift"></i> Custom Cakes Available — Order 48hrs in Advance</span>
<span><i class="fas fa-leaf"></i> Organic Ingredients, Always</span>
</div>
</div>


<!-- ═══ HERO ═══ -->
<div class="hero">
<div>
<div class="hero-tag animate-fadeup"><i class="fas fa-birthday-cake"></i> Online Cake Bakery</div>
<h1 class="animate-fadeup delay-1">Sweet dreamss,<br><em>delivered</em><br>to your door.</h1>
<p class="hero-sub animate-fadeup delay-2">Handcrafted cakes, fresh-baked pastries, and artisan breads — made with
love and shipped to your doorstep while still warm.</p>
<div class="hero-btns animate-fadeup delay-3">
<a href="products.php" class="btn-primary-cake"><i class="fas fa-birthday-cake"></i> Order a Cake</a>
<a href="about.php" class="btn-outline-cake">Our Story <i class="fas fa-arrow-right"></i></a>
</div>
<div class="hero-social-proof animate-fadeup delay-4">
<div class="avatar-stack">
<img src="https://i.pravatar.cc/100?img=1" alt="">
<img src="https://i.pravatar.cc/100?img=2" alt="">
<img src="https://i.pravatar.cc/100?img=3" alt="">
</div>
<div class="proof-text">
<div class="stars">
<i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i
class="fas fa-star"></i>
</div>
Trusted by 5,000+ happy customers
</div>
</div>
</div>


<div class="hero-img-wrap animate-fadeup delay-2">
<img src="https://images.unsplash.com/photo-1550617931-e17a7b70dce2?q=80&w=800&auto=format&fit=crop"
alt="Beautiful cake">
<div class="hero-badge">
<div class="hero-badge-icon"><i class="fas fa-leaf"></i></div>
<div class="hero-badge-text">
<strong>100% Organic</strong>
<span>Locally sourced flour</span>
</div>
</div>
<div class="hero-rating-badge">
<div class="rating-num">4.9 <i class="fas fa-star" style="font-size:16px;"></i></div>
<div class="rating-label">5,000+ reviews</div>
</div>
</div>
</div>


<!-- ═══ STATS BAR ═══ -->
<div class="section-wrap">
<div class="stats-bar animate-fadeup">
<div class="stat-item">
<span class="stat-icon">🎂</span>
<span class="stat-num">500+</span>
<div class="stat-label">Cake Varieties</div>
</div>
<div class="stat-item">
<span class="stat-icon">🚀</span>
<span class="stat-num">2hr</span>
<div class="stat-label">Express Delivery</div>
</div>
<div class="stat-item">
<span class="stat-icon">⭐</span>
<span class="stat-num">4.9</span>
<div class="stat-label">Average Rating</div>
</div>
<div class="stat-item">
<span class="stat-icon">💝</span>
<span class="stat-num">50k+</span>
<div class="stat-label">Orders Delivered</div>
</div>
</div>
</div>


<!-- ═══ CATEGORIES ═══ -->
<div class="section-wrap">
<div class="section-header animate-fadeup">
<div class="section-tag"><i class="fas fa-th"></i> Our Menu</div>
<h2 class="section-title">Browse by Category</h2>
<p class="section-sub">Find exactly what you're craving today.</p>
</div>
<div class="cat-grid">
<?php
$stmt = $adminDetails->ret("SELECT * FROM categories WHERE status='Active' LIMIT 6");

while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
  ?>
  <a href="products.php?cat_id=<?= $row['category_id'] ?>" class="cat-card">
  <img src="uploads/<?= $row['image'] ?>" alt="<?= $row['name'] ?>"
  onerror="this.src='https://images.unsplash.com/photo-1509440159596-0249088772ff?q=80&w=400&auto=format&fit=crop'">
  <div class="cat-card-body">
  <h3>
  <?= $row['name'] ?>
  </h3>
  <p>Browse daily fresh
  <?= strtolower($row['name']) ?>
  </p>
  <div class="cat-link">Shop Now <i class="fas fa-arrow-right"></i></div>
  </div>
  </a>
<?php } ?>
</div>
</div>


<!-- ═══ PROMO BANNER ═══ -->
<div class="section-wrap">
<div class="promo-banner animate-fadeup">
<div class="promo-content">
<div class="promo-tag"><i class="fas fa-bolt"></i> Weekend Special</div>
<h2>Fresh Croissants<br><em>Straight to Bed.</em></h2>
<p>Order our signature buttery croissants before Friday 8 PM and wake up to the smell of Paris in your own home.
</p>
<ul class="promo-checklist">
<li><i class="fas fa-check-circle"></i> Baked the exact morning of delivery</li>
<li><i class="fas fa-check-circle"></i> 100% French cultured butter</li>
<li><i class="fas fa-check-circle"></i> Shipped in heat-retaining eco-boxes</li>
</ul>
<div>
<a href="products.php" class="btn-primary-cake"
style="background:var(--gold);color:var(--deep);box-shadow:0 4px 24px rgba(212,169,106,0.35);">
<i class="fas fa-tag"></i> Claim Weekend Offer
</a>
</div>
</div>
<div class="promo-img">
<img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSiDtkdyRh2yjlRKvzCN-zboBk2zQt-AqGKzg&s"
alt="Croissants">
</div>
</div>
</div>


<!-- ═══ HOW IT WORKS ═══ -->
<div class="section-wrap">
<div class="section-header animate-fadeup">
<div class="section-tag"><i class="fas fa-route"></i> How It Works</div>
<h2 class="section-title">From Oven to Doorstep</h2>
</div>
<div class="steps-grid">
<div class="step-card animate-fadeup delay-1">
<div class="step-num">1</div>
<div class="step-icon-wrap">🛒</div>
<h3>Choose Your Treats</h3>
<p>Browse our extensive menu of cakes, breads, and pastries. Add your favorites to the cart.</p>
</div>
<div class="step-card animate-fadeup delay-2">
<div class="step-num">2</div>
<div class="step-icon-wrap">👩‍🍳</div>
<h3>We Bake Daily</h3>
<p>Our master bakers arrive early to prepare your items fresh. No day-old stock — strictly pristine quality.</p>
</div>
<div class="step-card animate-fadeup delay-3">
<div class="step-num">3</div>
<div class="step-icon-wrap">🚀</div>
<h3>Fast Delivery</h3>
<p>Our private fleet safely drops the pastries at your doorstep, hot and ready for you to enjoy.</p>
</div>
</div>
</div>


<!-- ═══ TESTIMONIALS ═══ -->
<div class="section-wrap">
<div class="testimonials-section animate-fadeup">
<div class="section-header" style="margin-bottom:48px;">
<div class="section-tag"><i class="fas fa-heart"></i> Happy Customers</div>
<h2 class="section-title">What Our Customers Say</h2>
</div>
<div class="testi-grid">
<div class="testi-card">
<div class="testi-stars">
<i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i
class="fas fa-star"></i>
</div>
<p class="testi-text">"The sourdough bread is absolutely phenomenal. It has the perfect crust and soft inside.
Hands down the best bakery in town."</p>
<div class="testi-author">
<img src="https://i.pravatar.cc/150?img=47" alt="Sarah">
<div>
<div class="testi-author-name">Sarah Jenkins</div>
<div class="testi-author-label">✅ Verified Buyer</div>
</div>
</div>
</div>
<div class="testi-card">
<div class="testi-stars">
<i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i
class="fas fa-star"></i>
</div>
<p class="testi-text">"Ordered a custom chocolate fudge cake for my daughter's birthday. It looked incredible
and tasted even better. Smooth delivery!"</p>
<div class="testi-author">
<img src="https://i.pravatar.cc/150?img=11" alt="Michael">
<div>
<div class="testi-author-name">Michael Chen</div>
<div class="testi-author-label">✅ Verified Buyer</div>
</div>
</div>
</div>
<div class="testi-card">
<div class="testi-stars">
<i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i
class="fas fa-star"></i>
</div>
<p class="testi-text">"So convenient having my morning pastries delivered reliably. The croissants are flaky,
warm, and rival bakeries I visited in France."</p>
<div class="testi-author">
<img src="https://i.pravatar.cc/150?img=32" alt="Emily">
<div>
<div class="testi-author-name">Emily Rostova</div>
<div class="testi-author-label">✅ Verified Buyer</div>
</div>
</div>
</div>
</div>
</div>
</div>


<!-- ═══ BOTTOM CTA ═══ -->
<div class="section-wrap">
<div class="cta-section animate-fadeup">
<div class="cta-bg"></div>
<div class="cta-overlay"></div>
<div class="cta-content">
<h2>Ready to treat yourself?</h2>
<p>Join thousands of happy customers who get fresh baked goods delivered daily.</p>
<div class="cta-btns">
<a href="products.php" class="btn-cta-main"><i class="fas fa-birthday-cake"></i> Start Shopping</a>
<?php if (!isset($_SESSION['user_id'])): ?>
  <a href="register.php" class="btn-cta-outline"><i class="fas fa-user-plus"></i> Create Account</a>
<?php endif; ?>
</div>
</div>
</div>
</div>


<?php include 'footer.php'; ?>




