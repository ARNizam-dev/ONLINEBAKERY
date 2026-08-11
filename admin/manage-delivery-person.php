<?php include 'header.php'; ?>

<h2 class="page-title">Manage Delivery Agents</h2>

<div style="display: grid; grid-template-columns: 350px 1fr; gap: 24px; align-items: start;">
    <!-- Add DP Form -->
    <div class="content-card">
        <div class="content-card-header">
            <h3 class="content-card-title">Add New Agent</h3>
        </div>
        <div class="content-card-body">
            <form action="../controller/admin-add-dp.php" method="POST">
                <div class="form-group">
                    <label>Full Name</label>
                    <input type="text" name="name" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>Phone Number</label>
                    <input type="text" name="phone" class="form-control" placeholder="+919876543210" value="+91" pattern="^\+91[0-9]{10}$" title="Must start with +91 followed by 10 digits" oninput="this.value = this.value.replace(/[^0-9+]/g, ''); if(!this.value.startsWith('+91')){ this.value = '+91'; }" required>
                </div>
                <div class="form-group">
                    <label>Email Address</label>
                    <input type="email" name="email" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="password" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>Vehicle Number</label>
                    <input type="text" name="vehicle_number" class="form-control">
                </div>
                <div class="form-group">
                    <label>Delivery Area</label>
                    <input type="text" name="delivery_area" class="form-control">
                </div>
                <button type="submit" name="add_dp" class="btn btn-primary" style="width: 100%; justify-content: center;">Add Agent</button>
            </form>
        </div>
    </div>

    <!-- Agent List -->
    <div class="content-card">
        <div class="content-card-header">
            <h3 class="content-card-title">All Agents</h3>
        </div>
        <div class="content-card-body">
            <div class="table-responsive">
                <table>
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Contact</th>
                            <th>Vehicle No</th>
                            <th>Area</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $stmt = $adminDetails->ret("SELECT * FROM delivery_persons ORDER BY dp_id DESC");
                        while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        ?>
                        <tr>
                            <td>
                                <div style="font-weight: 600; color: var(--text-main);"><?= $row['name'] ?></div>
                                <div style="font-size: 13px; color: var(--text-muted);"><?= $row['email'] ?></div>
                            </td>
                            <td><?= $row['phone'] ?></td>
                            <td><?= $row['vehicle_number'] ?></td>
                            <td><?= $row['delivery_area'] ?></td>
                            <td style="white-space: nowrap;">
                                <a href="manage-delivery-person.php?edit=<?= $row['dp_id'] ?>" class="btn btn-primary btn-icon"><i class="fas fa-edit"></i></a>
                                <a href="../controller/admin-delete-dp.php?id=<?= $row['dp_id'] ?>" class="btn btn-danger btn-icon" onclick="return confirm('Are you sure?')"><i class="fas fa-trash"></i></a>
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
    $dp = $adminDetails->ret("SELECT * FROM delivery_persons WHERE dp_id='$edit_id'")->fetch(PDO::FETCH_ASSOC);
?>
<div style="position: fixed; top:0; left:0; width: 100%; height: 100vh; background: rgba(0,0,0,0.5); z-index: 999; display: flex; align-items: center; justify-content: center;">
    <div class="content-card" style="width: 400px; max-width: 90%;">
        <div class="content-card-header">
            <h3 class="content-card-title">Edit Agent</h3>
            <a href="manage-delivery-person.php" style="color: var(--text-muted); text-decoration: none;"><i class="fas fa-times"></i></a>
        </div>
        <div class="content-card-body">
            <form action="../controller/admin-edit-dp.php" method="POST">
                <input type="hidden" name="dp_id" value="<?= $dp['dp_id'] ?>">
                <div class="form-group">
                    <label>Full Name</label>
                    <input type="text" name="name" class="form-control" value="<?= $dp['name'] ?>" required>
                </div>
                <div class="form-group">
                    <label>Phone Number</label>
                    <input type="text" name="phone" class="form-control" value="<?= $dp['phone'] ?>" required>
                </div>
                <div class="form-group">
                    <label>Email Address</label>
                    <input type="email" name="email" class="form-control" value="<?= $dp['email'] ?>" required>
                </div>
                <div class="form-group">
                    <label>Password (Leave blank to keep)</label>
                    <input type="password" name="password" class="form-control">
                </div>
                <div class="form-group">
                    <label>Vehicle Number</label>
                    <input type="text" name="vehicle_number" class="form-control" value="<?= $dp['vehicle_number'] ?>">
                </div>
                <div class="form-group">
                    <label>Delivery Area</label>
                    <input type="text" name="delivery_area" class="form-control" value="<?= $dp['delivery_area'] ?>">
                </div>
                <button type="submit" name="edit_dp" class="btn btn-primary" style="width: 100%; justify-content: center;">Update Agent</button>
            </form>
        </div>
    </div>
</div>
<?php } ?>

<?php include 'footer.php'; ?>
