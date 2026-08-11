<?php
include '../config.php';
$admin = new Admin();
try {
    $admin->cud("ALTER TABLE products ADD COLUMN kg VARCHAR(50) DEFAULT '' AFTER price", "");
    echo "Column kg added successfully\n";
} catch (Exception $e) {
    echo "Error adding column: " . $e->getMessage() . "\n";
}
?>
