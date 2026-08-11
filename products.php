<?php 
include 'header.php'; 

$cat_id = isset($_GET['cat_id']) ? $_GET['cat_id'] : null;

$query = "SELECT p.*, c.name as category_name FROM products p JOIN categories c ON p.category_id=c.category_id WHERE p.status='Active'";
if($cat_id) {
    $query .= " AND p.category_id='$cat_id'";
    $c_stmt = $adminDetails->ret("SELECT name FROM categories WHERE category_id='$cat_id'");
    $cat_name = $c_stmt->fetch(PDO::FETCH_ASSOC)['name'] ?? 'All Products';
} else {
    $cat_name = 'All Bakery Items';
}
$query .= " ORDER BY p.product_id DESC";
$products = $adminDetails->ret($query);
?>

<div style="margin-bottom: 40px;">
    <span class="tag-label">Shop</span>
    <h2 style="font-size: 40px;"><?= $cat_name ?></h2>
    <p style="color: var(--text-muted); margin-top: 8px;">Explore our carefully crafted recipes delivered freshly daily.</p>
</div>

<!-- Top Filters -->
<div style="display: flex; gap: 12px; margin-bottom: 40px; overflow-x: auto; padding-bottom: 10px;">
    <a href="products.php" class="btn <?= !$cat_id ? 'btn-black' : 'btn-outline' ?>" style="white-space: nowrap;">All</a>
    <?php
    $cats = $adminDetails->ret("SELECT * FROM categories WHERE status='Active'");
    while($c = $cats->fetch(PDO::FETCH_ASSOC)) {
        $active_class = ($cat_id == $c['category_id']) ? 'btn-black' : 'btn-outline';
        echo "<a href='products.php?cat_id={$c['category_id']}' class='btn {$active_class}' style='white-space: nowrap;'>{$c['name']}</a>";
    }
    ?>
</div>

<div class="grid">
    <?php
    if($products->rowCount() > 0) {
        while($row = $products->fetch(PDO::FETCH_ASSOC)) {
    ?>
    <div class="item-card">
        <a href="product-details.php?id=<?= $row['product_id'] ?>" style="display: block; text-decoration: none; color: inherit;">
            <img src="uploads/<?= $row['image'] ?>" class="item-image" alt="<?= $row['name'] ?>" onerror="this.src='https://images.unsplash.com/photo-1550617931-e17a7b70dce2?q=80&w=400&auto=format&fit=crop'">
        </a>
        <div class="item-content">
            <div style="display:flex; justify-content:space-between; align-items:flex-start; margin-bottom: 8px;">
                <a href="product-details.php?id=<?= $row['product_id'] ?>" class="item-title" style="text-decoration: none; color: inherit; transition: color 0.2s;" onmouseover="this.style.color='var(--primary)'" onmouseout="this.style.color='inherit'"><?= $row['name'] ?></a>
                <div style="color: var(--warning); font-size: 13px;"><i class="fas fa-star"></i> 4.9</div>
            </div>
            
            <div class="item-desc"><?= substr($row['description'], 0, 80) ?>...</div>
            <div class="item-price">₹<?= number_format($row['price'], 2) ?></div>
            
            <?php if($row['stock_quantity'] > 0) { ?>
                <form action="controller/user-add-to-cart.php" method="POST" style="margin-top: 24px; display: grid; grid-template-columns: 80px 1fr; gap: 12px;">
                    <input type="hidden" name="product_id" value="<?= $row['product_id'] ?>">
                    <input type="hidden" name="price" value="<?= $row['price'] ?>">
                    <input type="number" name="quantity" class="form-control" value="1" min="1" max="<?= $row['stock_quantity'] ?>" style="text-align:center;">
                    <button type="submit" name="add_to_cart" class="btn btn-black" style="width: 100%; border-radius: 8px;">Add to Cart</button>
                </form>
            <?php } else { ?>
                <div style="margin-top: 24px; color: var(--danger); font-weight: 600; text-align: center; padding: 12px; background: #fee2e2; border-radius: 8px;">Out of Stock</div>
            <?php } ?>
        </div>
    </div>
    <?php 
        } 
    } else {
        echo "<div style='grid-column: 1 / -1; text-align: center; padding: 60px; color: var(--text-muted);'>No products found in this category.</div>";
    }
    ?>
</div>

<?php include 'footer.php'; ?>
