<?php
session_start();

if (isset($_GET['product'])) {
    $productId = $_GET['product'];

    if (isset($_SESSION['cart'])) {
        unset($_SESSION['cart'][$productId]); // Xóa sản phẩm khỏi giỏ hàng
    }
}

header("Location: cart.php"); // Chuyển hướng trở lại trang giỏ hàng
exit();
?>