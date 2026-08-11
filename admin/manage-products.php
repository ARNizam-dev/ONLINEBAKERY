<?php include 'header.php'; ?>

<h2 class="page-title">Manage Products</h2>

<div style="display: grid; grid-template-columns: 350px 1fr; gap: 24px; align-items: start;">
    <!-- Add Product Form -->
    <div class="content-card">
        <div class="content-card-header">
            <h3 class="content-card-title">Add New Product</h3>
        </div>
        <div class="content-card-body">
            <form action="../controller/admin-add-product.php" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label>Product Name</label>
                    <input type="text" name="name" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>Category</label>
                    <select name="category_id" class="form-control" required>
                        <option value="">Select Category</option>
                        <?php
                        $cats = $adminDetails->ret("SELECT * FROM categories");
                        while($c = $cats->fetch(PDO::FETCH_ASSOC)) {
                            echo "<option value='{$c['category_id']}'>{$c['name']}</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label>Description</label>
                    <textarea name="description" class="form-control" rows="3"></textarea>
                </div>
                <div class="form-group">
                    <label>Price</label>
                    <input type="number" step="0.01" name="price" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>Weight (KG)</label>
                    <input type="text" name="kg" class="form-control" placeholder="e.g. 1, 0.5, 2" required>
                </div>
                <div class="form-group">
                    <label>Stock Quantity</label>
                    <input type="number" name="stock_quantity" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>Product Image</label>
                    <input type="file" name="image" class="form-control" required accept="image/*">
                </div>
                <div class="form-group">
                    <label>Status</label>
                    <select name="status" class="form-control" required>
                        <option value="Active">Active</option>
                        <option value="Inactive">Inactive</option>
                    </select>
                </div>
                <button type="submit" name="add_product" class="btn btn-primary" style="width: 100%; justify-content: center;">Add Product</button>
            </form>
        </div>
    </div>

    <!-- Product List -->
    <div class="content-card">
        <div class="content-card-header">
            <h3 class="content-card-title">All Products</h3>
        </div>
        <div class="content-card-body">
            <div class="table-responsive">
                <table>
                    <thead>
                        <tr>
                            <th>Img</th>
                            <th>Name</th>
                            <th>Category</th>
                            <th>Price</th>
                            <th>KG</th>
                            <th>Stock</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $stmt = $adminDetails->ret("SELECT p.*, c.name as category_name FROM products p LEFT JOIN categories c ON p.category_id = c.category_id ORDER BY p.product_id DESC");
                        while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                            $status_class = $row['status'] == 'Active' ? 'status-active' : 'status-inactive';
                        ?>
                        <tr>
                            <td><img src="../uploads/<?= $row['image'] ?>" width="40" height="40" style="object-fit: cover; border-radius: 8px;"></td>
                            <td><?= $row['name'] ?></td>
                            <td><?= $row['category_name'] ?></td>
                            <td>₹<?= number_format($row['price'], 2) ?></td>
                            <td><?= $row['kg'] ?? 'N/A' ?></td>
                            <td><?= $row['stock_quantity'] ?></td>
                            <td><span class="status-badge <?= $status_class ?>"><?= $row['status'] ?></span></td>
                            <td style="white-space: nowrap;">
                                <a href="manage-products.php?edit=<?= $row['product_id'] ?>" class="btn btn-primary btn-icon"><i class="fas fa-edit"></i></a>
                                <a href="../controller/admin-delete-product.php?id=<?= $row['product_id'] ?>" class="btn btn-danger btn-icon" onclick="return confirm('Are you sure?')"><i class="fas fa-trash"></i></a>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php 
// Edit Modal
if(isset($_GET['edit'])) { 
    $edit_id = $_GET['edit'];
    $prod = $adminDetails->ret("SELECT * FROM products WHERE product_id='$edit_id'")->fetch(PDO::FETCH_ASSOC);
?>
<div style="position: fixed; top:0; left:0; width: 100%; height: 100vh; background: rgba(0,0,0,0.5); z-index: 999; display: flex; align-items: center; justify-content: center;">
    <div class="content-card" style="width: 400px; max-width: 90%; max-height: 90vh; overflow-y: auto;">
        <div class="content-card-header">
            <h3 class="content-card-title">Edit Product</h3>
            <a href="manage-products.php" style="color: var(--text-muted); text-decoration: none;"><i class="fas fa-times"></i></a>
        </div>
        <div class="content-card-body">
            <form action="../controller/admin-edit-product.php" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="product_id" value="<?= $prod['product_id'] ?>">
                <div class="form-group">
                    <label>Product Name</label>
                    <input type="text" name="name" class="form-control" value="<?= $prod['name'] ?>" required>
                </div>
                <div class="form-group">
                    <label>Category</label>
                    <select name="category_id" class="form-control" required>
                        <?php
                        $cats = $adminDetails->ret("SELECT * FROM categories");
                        while($c = $cats->fetch(PDO::FETCH_ASSOC)) {
                            $sel = $c['category_id'] == $prod['category_id'] ? 'selected' : '';
                            echo "<option value='{$c['category_id']}' $sel>{$c['name']}</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label>Description</label>
                    <textarea name="description" class="form-control" rows="2"><?= $prod['description'] ?></textarea>
                </div>
                <div class="form-group">
                    <label>Price</label>
                    <input type="number" step="0.01" name="price" class="form-control" value="<?= $prod['price'] ?>" required>
                </div>
                <div class="form-group">
                    <label>Weight (KG)</label>
                    <input type="text" name="kg" class="form-control" value="<?= $prod['kg'] ?? '' ?>" required>
                </div>
                <div class="form-group">
                    <label>Stock Quantity</label>
                    <input type="number" name="stock_quantity" class="form-control" value="<?= $prod['stock_quantity'] ?>" required>
                </div>
                <div class="form-group">
                    <label>Product Image (Leave blank to keep)</label>
                    <input type="file" name="image" class="form-control" accept="image/*">
                </div>
                <div class="form-group">
                    <label>Status</label>
                    <select name="status" class="form-control" required>
                        <option value="Active" <?= $prod['status']=='Active'?'selected':'' ?>>Active</option>
                        <option value="Inactive" <?= $prod['status']=='Inactive'?'selected':'' ?>>Inactive</option>
                    </select>
                </div>
                <button type="submit" name="edit_product" class="btn btn-primary" style="width: 100%; justify-content: center;">Update Product</button>
            </form>
        </div>
    </div>
</div>
<?php } ?>

<?php include 'footer.php'; ?>
