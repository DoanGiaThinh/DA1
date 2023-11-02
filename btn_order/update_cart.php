<?php session_start(); 
if (isset($_POST['quantity']) && is_array($_POST['quantity'])) {
     foreach ($_POST['quantity'] as $productId => $quantity) { 
        $quantity = intval($quantity); // Đảm bảo số lượng không âm và lớn hơn 0 
        if ($quantity >= 1) { $_SESSION['cart'][$productId] = $quantity; } 
        } 
    } 
    header("Location: cart.php"); 
?>