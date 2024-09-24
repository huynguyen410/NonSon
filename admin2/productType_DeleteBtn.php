<?php
require './DataProvider.php';
$maloai = $_GET["MA_LOAI"];
if (mysqli_num_rows(mysqli_query($conn, "SELECT `MA_LOAI` FROM sanpham WHERE MA_LOAI='$maloai'")) > 0) {
    echo '<script> alert("Vui lòng thay đổi thông tin sản phẩm mang mã loại này."); history.go(-1); </script>';
    exit;
}
$sql = "DELETE FROM `loai_sanpham`
WHERE MA_LOAI = '$maloai'";
executeQuery($sql);
echo '<script> alert("Xoá thành công"); window.location.href = "./productType.php";</script>';
?>