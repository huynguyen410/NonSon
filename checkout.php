<?php
session_start();
require 'connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['cart'])) {
    $cart = $_POST['cart'];
    $name = $_POST['ten'];
    $address = $_POST['diachi'];
    $phoneNumber = $_POST['phoneNumber'];
    $username = $_POST['username'];
    $thanhtien = $_POST['thanhtien'];

    // Thực hiện chèn dữ liệu vào bảng hoadon trước
    $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $MA_HD = substr(str_shuffle($characters), 0, 3);
    $NGAY_TAO_HD = date('Y-m-d H:i:s');
    $TRANG_THAI = 1;

    $sql = "INSERT INTO hoadon (MA_HD, NGAY_TAO_HD, USERNAME, TEN_NGUOI_NHAN, DIA_CHI_NHAN, THANH_TIEN, TRANG_THAI) 
            VALUES ('$MA_HD', '$NGAY_TAO_HD', '$username', '$name', '$address', $thanhtien, $TRANG_THAI)";
    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully in hoadon";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Tạo một mảng để chứa thông báo về các sản phẩm hết hàng
    $out_of_stock_messages = [];
    $products_to_remove = [];

    foreach ($cart as $product) {
        $product_id = $product['id'];
        $quantity = $product['quantity'];
		$sql = "SELECT GIA FROM sanpham WHERE MA_SP = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $product_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $giaSP = $row['GIA'];

        $sql = "SELECT SO_LUONG FROM sanpham WHERE MA_SP = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $product_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $current_quantity = $row['SO_LUONG'];

        // Kiểm tra xem sản phẩm có đủ hàng hay không
        if ($current_quantity >= $quantity) {
            // Cập nhật số lượng sản phẩm trong cơ sở dữ liệu
            $sql = "UPDATE sanpham SET SO_LUONG = SO_LUONG - ? WHERE MA_SP = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("is", $quantity, $product_id);
            $stmt->execute();
			
			
			 $sql = "INSERT INTO chitiet_hoadon (MA_HD, MA_SP, GIA, SOLUONG) VALUES (?, ?, ?, ?)";
			$stmt = $conn->prepare($sql);
			$stmt->bind_param("ssii", $MA_HD, $product_id, $giaSP, $quantity);
    		$stmt->execute();
            // Thêm sản phẩm vào danh sách cần xóa khỏi giỏ hàng
            $products_to_remove[] = $product_id;
        } else {
            // Thêm một thông báo về sản phẩm hết hàng
            $out_of_stock_messages[] = "Product $product_id is out of stock and has been removed from your cart.";
            // Thêm sản phẩm vào danh sách cần xóa khỏi giỏ hàng
            $products_to_remove[] = $product_id;
        }
    }

    // Xóa các sản phẩm khỏi giỏ hàng
    foreach ($products_to_remove as $product_id) {
        unset($_SESSION['cart'][$product_id]);
    }

     // Kiểm tra xem có thông báo nào về sản phẩm hết hàng hay không
    if (!empty($out_of_stock_messages)) {
        echo implode("\n", $out_of_stock_messages);
    }

    // Kiểm tra xem còn sản phẩm nào trong giỏ hàng hay không
    if (empty($_SESSION['cart'])) {
        // Nếu không còn sản phẩm nào trong giỏ hàng, xóa giỏ hàng
        unset($_SESSION['cart']);
        echo "Checkout success";
    }

    exit();
} else {
    // Nếu yêu cầu không hợp lệ
    header("Location: index.php");
    exit();
}
?>

