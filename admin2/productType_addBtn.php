<?php
require './DataProvider.php';
if (isset($_POST['addTypeProduct'])) {
    $maloai = $_POST["typeID"];
    $tenloai = $_POST["productTypeName"];
    $chitiet = $_POST["productTypeDetail"];

    if (empty($maloai) || empty($tenloai) || empty($chitiet)) {
        echo '<script> alert("Vui lòng nhập đầy đủ thông tin!"); history.go(-1); </script>';
        exit;
    }
    if (mysqli_num_rows(mysqli_query($conn, "SELECT `MA_LOAI` FROM loai_sanpham WHERE MA_LOAI='$maloai'")) > 0) {
        echo '<script> alert("Mã loại sản phẩm này đã tồn tại."); history.go(-1); </script>';
        exit;
    } else {
        $query = "INSERT INTO `loai_sanpham` VALUES('$maloai','$tenloai','$chitiet')";
        mysqli_query($conn, $query);
        echo '<script> alert("Thêm thành công"); window.location.href = "./productType.php";</script>';
    }
}
?>