<?php
require './DataProvider.php';
if (isset($_POST['addProduct'])) {
    $masp = $_POST["productID"];
    $maloai = $_POST["typeID"];
    $tensp = $_POST["productName"];
    $mau = $_POST["color"];
    $gia = $_POST["price"];
    $soluong = $_POST["remainingProducts"];
    // $tinhtrang = $_POST["productStatus"];
    // $hinhanh = $_POST["productImg"];
    $chitiet = $_POST["productDetail"];

    $tmp_name =  $_FILES["productImg"]["tmp_name"];
    $fldimageurl = "../img/" . $_FILES["productImg"]["name"];
    $hinhanh = $_FILES["productImg"]["name"];
    move_uploaded_file($tmp_name, $fldimageurl);

    if (empty($masp) || empty($tensp) || empty($mau) || empty($gia) || empty($soluong) || empty($chitiet)) {
        echo '<script> alert("Vui lòng nhập đầy đủ thông tin!"); history.go(-1); </script>';
        exit;
    }
    //Kiểm tra sp có chưa
    if (mysqli_num_rows(mysqli_query($conn, "SELECT `MA_LOAI`, `TEN_SP` FROM sanpham WHERE MA_LOAI='$maloai' AND TEN_SP='$tensp'")) > 0) {
        echo '<script> alert("Sản phẩm này đã tồn tại."); history.go(-1); </script>';
        exit;
    }
    if (mysqli_num_rows(mysqli_query($conn, "SELECT `MA_SP` FROM sanpham WHERE MA_SP='$masp'")) > 0) {
        echo '<script> alert("Mã sản phẩm này đã tồn tại."); history.go(-1); </script>';
        exit;
    }
    if (mysqli_num_rows(mysqli_query($conn, "SELECT `MA_LOAI` FROM loai_sanpham WHERE MA_LOAI='$maloai'")) == 0) {
        echo '<script> alert("Mã loại này không tồn tại."); history.go(-1); </script>';
        exit;
    }
    $uploadError = validateImageUpload($_FILES["productImg"]);
    if ($uploadError !== null) {
        echo '<script> alert("Lỗi: ' . $uploadError . '"); history.go(-1); </script>';
        exit;
    } else {
        $query = "INSERT INTO `sanpham` VALUES('$masp','$maloai','$tensp','$mau','$gia','$soluong','1','img/$hinhanh','$chitiet')";
        mysqli_query($conn, $query);
        echo '<script> alert("Thêm thành công"); window.location.href = "./product.php";</script>';
    }
}
?>
<?php
function validateImageUpload($file)
{
    // Kiểm tra xem có file upload hay không
    if (!isset($file) || empty($file['tmp_name'])) {
        return "Chưa chọn file ảnh.";
    }

    // Kiểm tra định dạng của file upload
    $allowedExtensions = array("jpg", "jpeg", "png", "gif");
    $extension = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
    if (!in_array($extension, $allowedExtensions)) {
        return "File upload không đúng định dạng.";
    }
    // Nếu không có lỗi, trả về null
    return null;
}

?>