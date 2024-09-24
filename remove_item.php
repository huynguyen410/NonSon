<?php
session_start();

if (isset($_POST['id'])) {
    $product_id = $_POST['id'];

    // Xóa sản phẩm khỏi giỏ hàng
    if (isset($_SESSION['cart'][$product_id])) {
        unset($_SESSION['cart'][$product_id]);
    }
}
