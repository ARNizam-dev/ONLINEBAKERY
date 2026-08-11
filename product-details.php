<?php 
include 'header.php'; 

if (!isset($_GET['id'])) {
    echo "<script>window.location.href='products.php';</script>";
    exit;
}

$product_id = $_GET['id'];
$stmt = $adminDetails->ret("SELECT p.*, c.name as category_name FROM products p JOIN categories c ON p.category_id=c.category_id WHERE p.product_id='$product_id' AND p.status='Active'");

if ($stmt->rowCount() == 0) {
    echo "<div class='container' style='text-align: center; padding: 100px 0;'><h2>Product not found.</h2><a href='products.php' class='btn btn-primary' style='margin-top: 20px;'>Back to Products</a></div>";
    include 'footer.php';
    exit;
}

$product = $stmt->fetch(PDO::FETCH_ASSOC);
?>

<div style="margin: 40px 0;">
    <a href="products.php" style="color: var(--text-muted); text-decoration: none; font-weight: 500;"><i class="fas fa-arrow-left"></i> Back to Menu</a>
</div>

<div class="grid" style="grid-template-columns: repeat(auto-fit, minmax(400px, 1fr)); gap: 60px; align-items: start; margin-bottom: 100px;">
    <!-- Product Image -->
    <div>
        <img src="uploads/<?= $product['image'] ?>" alt="<?= $product['name'] ?>" style="width: 100%; height: auto; max-height: 600px; object-fit: cover; border-radius: 24px; box-shadow: var(--shadow-lg);" onerror="this.src='https://images.unsplash.com/photo-1550617931-e17a7b70dce2?q=80&w=800&auto=format&fit=crop'">
    </div>
    
    <!-- Product Info -->
    <div>
        <span class="tag-label"><?= $product['category_name'] ?></span>
        <h1 style="font-size: 48px; margin-bottom: 16px;"><?= $product['name'] ?></h1>
        
        <div style="display: flex; align-items: center; gap: 16px; margin-bottom: 24px;">
            <div style="color: var(--warning); font-size: 18px;">
                <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star-half-alt"></i>
            </div>
            <span style="color: var(--text-muted); font-weight: 500;">(4.9 Based on 124 reviews)</span>
        </div>
        
        <div style="font-size: 32px; font-weight: 800; color: var(--primary-dark); margin-bottom: 32px; display: flex; align-items: baseline; gap: 12px;">
            ₹<?= number_format($product['price'], 2) ?>
            <?php if(!empty($product['kg'])) { ?>
                <span style="font-size: 18px; color: var(--text-muted); font-weight: 500;">(<?= htmlspecialchars($product['kg']) ?>)</span>
            <?php } ?>
        </div>
        
        <div style="margin-bottom: 40px;">
            <h3 style="font-size: 18px; margin-bottom: 12px;">Description</h3>
            <p style="color: var(--text-muted); font-size: 16px; line-height: 1.8;">
                <?= nl2br(htmlspecialchars($product['description'])) ?>
            </p>
        </div>
        
        <div style="padding: 24px; background: var(--bg-secondary); border: 1px solid var(--border-color); border-radius: 16px;">
            <?php if($product['stock_quantity'] > 0) { ?>
                <div style="color: var(--success); font-weight: 600; margin-bottom: 16px; display: flex; align-items: center; gap: 8px;">
                    <i class="fas fa-check-circle"></i> In Stock (<?= $product['stock_quantity'] ?> available)
                </div>
                <form action="controller/user-add-to-cart.php" method="POST" style="display: grid; grid-template-columns: 100px 1fr; gap: 16px;">
                    <input type="hidden" name="product_id" value="<?= $product['product_id'] ?>">
                    <input type="hidden" name="price" value="<?= $product['price'] ?>">
                    <input type="number" name="quantity" class="form-control" value="1" min="1" max="<?= $product['stock_quantity'] ?>" style="text-align:center; font-size: 18px; padding: 14px;">
                    <button type="submit" name="add_to_cart" class="btn btn-black" style="width: 100%; border-radius: 12px; font-size: 18px;"><i class="fas fa-cart-plus" style="margin-right: 8px;"></i> Add to Cart</button>
                </form>
            <?php } else { ?>
                <div style="color: var(--danger); font-weight: 600; font-size: 18px; display: flex; align-items: center; gap: 8px;">
                    <i class="fas fa-times-circle"></i> Currently Out of Stock
                </div>
            <?php } ?>
        </div>
        
        <div style="margin-top: 32px; display: flex; flex-direction: column; gap: 12px; color: var(--text-muted); font-size: 14px; font-weight: 500;">
            <div style="display: flex; align-items: center; gap: 12px;"><i class="fas fa-door-open" style="color: var(--success); font-size: 18px; width: 24px;"></i> Next day delivery available</div>
            <div style="display: flex; align-items: center; gap: 12px;"><i class="fas fa-box" style="color: var(--primary); font-size: 18px; width: 24px;"></i> Carefully packaged for freshness</div>
            <div style="display: flex; align-items: center; gap: 12px;"><i class="fas fa-leaf" style="color: #10b981; font-size: 18px; width: 24px;"></i> 100% natural artisan ingredients</div>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>
