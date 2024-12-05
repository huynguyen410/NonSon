<?php
require './DataProvider.php';

try {
    $request = $_REQUEST;

    // Check if the productImg_edit file is uploaded
    if (isset($_FILES['productImg_edit']) && !empty($_FILES['productImg_edit']['tmp_name'])) {
        $targetDirectory = "img/"; // Set your target directory
        $targetFile = $targetDirectory . basename($_FILES['productImg_edit']['name']);
        if (!move_uploaded_file($_FILES['productImg_edit']['tmp_name'], $targetFile)) {
            throw new ErrorException("Lỗi khi tải file lên.");
        }
    } else {
        throw new ErrorException("Chưa chọn file ảnh.");
    }

    // Get other form data
    $typeid = $request["typeID_edit"];
    $productid = $request["productID_edit"];
    $productName = $request["productName_edit"];
    $color = $request["color_edit"];
    $price = $request["price_edit"];
    $remainingProducts = $request["remainingProducts_edit"];
    $productDetail = $request["productDetail"];

    if (empty($productName) || empty($color) || empty($price) || empty($remainingProducts)) {
        echo "Vui lòng nhập đầy đủ thông tin!";
    } else {
        $sql = "UPDATE `sanpham` SET 
                `MA_LOAI`='$typeid',
                `MA_SP`='$productid',
                `TEN_SP`='$productName',
                `MAU`='$color',
                `GIA`='$price',
                `SO_LUONG`='$remainingProducts',
                `HINH_ANH`='$targetFile',
                `CHI_TIET`='$productDetail'
                WHERE `MA_SP`='$productid'";
        
        $result = executeQuery($sql);
        if ($result) {
            echo "Cập nhật thông tin sản phẩm thành công!";
        } else {
            echo "Lỗi cập nhật thông tin sản phẩm!";
        }
    }
} catch (Throwable $e) {
    echo $e->getMessage();
    http_response_code(400);
    exit;
}
?>
