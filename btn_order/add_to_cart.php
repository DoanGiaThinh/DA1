<?php
session_start();

if (isset($_POST['productId']) && isset($_POST['quantity'])) {
    $productId = $_POST['productId'];
    $quantity = $_POST['quantity'];

    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = array();
    }

    // Check if the product is already in the cart
    if (isset($_SESSION['cart'][$productId])) {
        // If it's in the cart, update the quantity
        $_SESSION['cart'][$productId] += $quantity;
    } else {
        // If it's not in the cart, add it
        $_SESSION['cart'][$productId] = $quantity;
    }

    echo "Sản phẩm đã được thêm vào giỏ hàng.";
} else {
    echo "Có lỗi xảy ra. Vui lòng thử lại.";
}
?>