<?php
// Kết nối tới cơ sở dữ liệu
$conn = new mysqli("localhost", "root", "", "adminpanel");

if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

$product_id = $_POST['id'];

$MA_HD = generateRandomString(3);
$NGAY_TAO_HD = date('Y-m-d H:i:s');
$USERNAME = $_POST['nickname']; 
$TEN_NGUOI_NHAN = $_POST['ten'];  
$DIA_CHI_NHAN = $_POST['diachi'];
$THANH_TIEN = $_POST['thanhtien'];;   ;// Giả sử
$TRANG_THAI = 1; // Giả sử

// Prepare the statement to add a new entity to hoadon
$insert_stmt = $conn->prepare("INSERT INTO hoadon (MA_HD, NGAY_TAO_HD, USERNAME, TEN_NGUOI_NHAN, DIA_CHI_NHAN, THANH_TIEN, TRANG_THAI) VALUES (?, ?, ?, ?, ?, ?, ?)");

$insert_stmt->bind_param("sssssii", $MA_HD, $NGAY_TAO_HD, $USERNAME, $TEN_NGUOI_NHAN, $DIA_CHI_NHAN, $THANH_TIEN, $TRANG_THAI);

if (!$insert_stmt) {
    die("Binding parameters failed: " . $conn->error);
}

// Execute the query to add a new entity to hoadon
if (!$insert_stmt->execute()) {
    die("Execute failed: " . $insert_stmt->error);
}

$insert_stmt->close();



$a_stmt = $conn->prepare("INSERT INTO chitiet_hoadon (MA_HD, MA_SP, GIA, SOLUONG) VALUES (?, ?, ?, ?)");

$a_stmt->bind_param("ssii", $MA_HD, $product_id, $THANH_TIEN, $TRANG_THAI);

if (!$a_stmt) {
    die("Binding parameters failed: " . $conn->error);
}

// Execute the query to add a new entity to hoadon
if (!$a_stmt->execute()) {
    die("Execute failed: " . $a_stmt->error);
}

$a_stmt->close();




// Prepare the statement to update sanpham
$stmt = $conn->prepare("UPDATE sanpham SET SO_LUONG = SO_LUONG - 1 WHERE MA_SP = ?");
$stmt->bind_param("s", $product_id);

// Execute the query to update sanpham
if (!$stmt->execute()) {
    die("Execute failed: " . $stmt->error);
}

$stmt->close();
$conn->close();

function generateRandomString($length = 3) {
    $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
    $randomString = '';
    $charCount = strlen($characters);
    
    // Lặp để tạo kí tự ngẫu nhiên
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charCount - 1)];
    }
    
    return $randomString;
}
?>
