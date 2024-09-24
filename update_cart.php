<?php
session_start();
require 'connection.php';

// Kiểm tra xem yêu cầu là POST và tồn tại dữ liệu giỏ hàng
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['cart'])) {
    // Lấy dữ liệu giỏ hàng từ yêu cầu AJAX
    $cart = $_POST['cart'];

    // Lặp qua các mục giỏ hàng
    foreach ($cart as $product) {
        $product_id = $product['id'];
        $quantity = $product['quantity'];

        // Lấy số lượng hiện tại trong cơ sở dữ liệu
        $sql = "SELECT SO_LUONG FROM sanpham WHERE MA_SP = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $product_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $current_quantity = $row['SO_LUONG'];

        // Kiểm tra xem có đủ số lượng trong cơ sở dữ liệu hay không
        if ($current_quantity >= $quantity) {
            // Cập nhật số lượng sản phẩm trong cơ sở dữ liệu
            $sql = "UPDATE sanpham SET SO_LUONG = SO_LUONG - ? WHERE MA_SP = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("is", $quantity, $product_id);
            $stmt->execute();

            // Xóa sản phẩm khỏi giỏ hàng
            unset($_SESSION['cart'][$product_id]);
        } else {
            // Nếu không đủ số lượng, xóa sản phẩm khỏi giỏ hàng
            unset($_SESSION['cart'][$product_id]);
            echo "Product $product_id is out of stock and has been removed from your cart.";
            exit();
        }
    }

    // Kiểm tra xem còn sản phẩm nào trong giỏ hàng hay không
    if (empty($_SESSION['cart'])) {
        // Nếu không còn sản phẩm nào trong giỏ hàng, xóa giỏ hàng
        unset($_SESSION['cart']);
    }

    // Trả về phản hồi thành công
    echo "Checkout success";
    exit();
} else {
    // Nếu yêu cầu không hợp lệ, chuyển hướng về trang chủ
    header("Location: index.php");
    exit();
}
?>
