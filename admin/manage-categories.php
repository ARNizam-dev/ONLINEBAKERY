<?php include 'header.php'; ?>

<h2 class="page-title">Manage Categories</h2>

<div style="display: grid; grid-template-columns: 350px 1fr; gap: 24px; align-items: start;">
    <!-- Add Category Form -->
    <div class="content-card">
        <div class="content-card-header">
            <h3 class="content-card-title">Add New Category</h3>
        </div>
        <div class="content-card-body">
            <form action="../controller/admin-add-category.php" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label>Category Name</label>
                    <input type="text" name="name" class="form-control" placeholder="e.g. Cakes" required>
                </div>
                <div class="form-group">
                    <label>Category Image</label>
                    <input type="file" name="image" class="form-control" required accept="image/*">
                </div>
                <div class="form-group">
                    <label>Status</label>
                    <select name="status" class="form-control" required>
                        <option value="Active">Active</option>
                        <option value="Inactive">Inactive</option>
                    </select>
                </div>
                <button type="submit" name="add_category" class="btn btn-primary" style="width: 100%; justify-content: center;">Add Category</button>
            </form>
        </div>
    </div>

    <!-- Category List -->
    <div class="content-card">
        <div class="content-card-header">
            <h3 class="content-card-title">All Categories</h3>
        </div>
        <div class="content-card-body">
            <div class="table-responsive">
                <table>
                    <thead>
                        <tr>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $stmt = $adminDetails->ret("SELECT * FROM categories ORDER BY category_id DESC");
                        while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                            $status_class = $row['status'] == 'Active' ? 'status-active' : 'status-inactive';
                        ?>
                        <tr>
                            <td><img src="../uploads/<?= $row['image'] ?>" width="50" height="50" style="object-fit: cover; border-radius: 8px;"></td>
                            <td><?= $row['name'] ?></td>
                            <td><span class="status-badge <?= $status_class ?>"><?= $row['status'] ?></span></td>
                            <td>
                                <!-- Inline edit is hard without modal, let's keep it simple with delete and an optional edit parameter (for simplicity just delete for now unless we do a separate page. Since we need edit, let's use a query param). -->
                                <a href="manage-categories.php?edit=<?= $row['category_id'] ?>" class="btn btn-primary btn-icon"><i class="fas fa-edit"></i></a>
                                <a href="../controller/admin-delete-category.php?id=<?= $row['category_id'] ?>" class="btn btn-danger btn-icon" onclick="return confirm('Are you sure?')"><i class="fas fa-trash"></i></a>
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
// Example simple edit modal (rendered if edit is set)
if(isset($_GET['edit'])) { 
    $edit_id = $_GET['edit'];
    $cat = $adminDetails->ret("SELECT * FROM categories WHERE category_id='$edit_id'")->fetch(PDO::FETCH_ASSOC);
?>
<div style="position: fixed; top:0; left:0; width: 100%; height: 100vh; background: rgba(0,0,0,0.5); z-index: 999; display: flex; align-items: center; justify-content: center;">
    <div class="content-card" style="width: 400px; max-width: 90%;">
        <div class="content-card-header">
            <h3 class="content-card-title">Edit Category</h3>
            <a href="manage-categories.php" style="color: var(--text-muted); text-decoration: none;"><i class="fas fa-times"></i></a>
        </div>
        <div class="content-card-body">
            <form action="../controller/admin-edit-category.php" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="category_id" value="<?= $cat['category_id'] ?>">
                <div class="form-group">
                    <label>Category Name</label>
                    <input type="text" name="name" class="form-control" value="<?= $cat['name'] ?>" required>
                </div>
                <div class="form-group">
                    <label>Category Image (Leave blank to keep current)</label>
                    <input type="file" name="image" class="form-control" accept="image/*">
                    <img src="../uploads/<?= $cat['image'] ?>" width="50" style="margin-top: 10px;">
                </div>
                <div class="form-group">
                    <label>Status</label>
                    <select name="status" class="form-control" required>
                        <option value="Active" <?= $cat['status']=='Active'?'selected':'' ?>>Active</option>
                        <option value="Inactive" <?= $cat['status']=='Inactive'?'selected':'' ?>>Inactive</option>
                    </select>
                </div>
                <button type="submit" name="edit_category" class="btn btn-primary" style="width: 100%; justify-content: center;">Update Category</button>
            </form>
        </div>
    </div>
</div>
<?php } ?>

<?php include 'footer.php'; ?>
