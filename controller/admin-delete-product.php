<?php
include '../config.php';
$admin = new Admin();

if (isset($_GET['id'])) {
    $product_id = $_GET['id'];
    
    // Check if the product is part of any active orders (not yet delivered or cancelled)
    $active_check_query = "SELECT COUNT(*) as count FROM `order_items` oi JOIN `orders` o ON oi.order_id = o.order_id WHERE oi.product_id='$product_id' AND o.order_status NOT IN ('Delivered', 'Cancelled')";
    $check_stmt = $admin->ret($active_check_query);
    $check_row = $check_stmt->fetch(PDO::FETCH_ASSOC);
    
    if ($check_row['count'] > 0) {
        echo "<script>alert('Cannot delete this product because it is currently part of active/pending orders.\\nPlease wait until they are delivered.'); window.location.href='../admin/manage-products.php';</script>";
    } else {
        // Safe to delete. First, carefully remove it from order history items to satisfy the foreign key constraints.
        $admin->cud("DELETE FROM `order_items` WHERE `product_id`='$product_id'", "");
        
        $query = "DELETE FROM `products` WHERE `product_id`='$product_id'";
        if ($admin->cud($query, "")) {
            echo "<script>alert('Product deleted successfully'); window.location.href='../admin/manage-products.php';</script>";
        } else {
            echo "<script>alert('Failed to delete product'); window.location.href='../admin/manage-products.php';</script>";
        }
    }
}
?>
