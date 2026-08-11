<?php
include '../config.php';
$admin = new Admin();

if (isset($_POST['checkout'])) {
    if (!isset($_SESSION['user_id'])) {
        echo "<script>alert('Please login first'); window.location.href='../login.php';</script>";
        exit;
    }

    $user_id = $_SESSION['user_id'];
    $delivery_address = $_POST['delivery_address'];
    $city = $_POST['city'];
    $pincode = $_POST['pincode'];
    $phone = $_POST['phone'];
    $payment_method = $_POST['payment_method']; // UPI, Credit Card, Debit Card, Cash on Delivery
    $order_notes = $_POST['order_notes'];
    if (!empty($_POST['order_kg'])) {
        $order_notes = "Selected Weight: " . $_POST['order_kg'] . "\n" . $order_notes;
    }
    
    // Calculate total amount from cart
    $stmt = $admin->ret("SELECT SUM(price * quantity) as total FROM `cart` WHERE `user_id`='$user_id'");
    $cart_row = $stmt->fetch(PDO::FETCH_ASSOC);
    $total_amount = $cart_row['total'];

    // Apply weight multiplier
    if (!empty($_POST['order_kg'])) {
        $multiplier = floatval($_POST['order_kg']);
        if ($multiplier > 0) {
            $total_amount = $total_amount * $multiplier;
        }
    }

    if (!$total_amount || $total_amount == 0) {
        echo "<script>alert('Your cart is empty'); window.location.href='../cart.php';</script>";
        exit;
    }

    $payment_status = ($payment_method == 'Cash on Delivery') ? 'Pending' : 'Completed'; 
    
    $query = "INSERT INTO `orders` (`user_id`, `delivery_address`, `city`, `pincode`, `phone`, `payment_method`, `order_notes`, `total_amount`, `payment_status`, `order_status`) 
              VALUES ('$user_id', '$delivery_address', '$city', '$pincode', '$phone', '$payment_method', '$order_notes', '$total_amount', '$payment_status', 'Pending')";
    
    $order_id = $admin->Rcud($query);

    if ($order_id) {
        $cart_items = $admin->ret("SELECT * FROM `cart` WHERE `user_id`='$user_id'");
        while ($item = $cart_items->fetch(PDO::FETCH_ASSOC)) {
            $pid = $item['product_id'];
            $qty = $item['quantity'];
            $price = $item['price'];
            $admin->cud("INSERT INTO `order_items` (`order_id`, `product_id`, `quantity`, `price`) VALUES ('$order_id', '$pid', '$qty', '$price')", "");
            
            $admin->cud("UPDATE `products` SET `stock_quantity` = `stock_quantity` - $qty WHERE `product_id` = '$pid'", "");
        }
        
        $admin->cud("DELETE FROM `cart` WHERE `user_id`='$user_id'", "");

        echo "<script>alert('Order placed successfully'); window.location.href='../order-history.php';</script>";
    } else {
        echo "<script>alert('Failed to place order'); window.location.href='../checkout.php';</script>";
    }
}
?>
