<?php
require './DataProvider.php';

try{
    $request = $_REQUEST; //a PHP Super Global variable which used to collect data after submitting it from the form
    if(
        empty($request['typeID_edit'])
        ||
        empty($request['productStatus_edit'])
    ){
        throw new ErrorException('thieu61');
    }
    $typeid = $request["typeID_edit"];
    $productid = $request["productID_edit"];
    $productName = $request["productName_edit"];
    $color = $request["color_edit"];
    $price = $request["price_edit"];
    $remainingProducts = $request["remainingProducts_edit"];
    $productStatus = $request["productStatus_edit"];
    $productImg = $request["productImg_edit"];
    $productDetail = $request["productDetail"];
    
    
    if (empty($productName) || empty($color) || empty($price) || empty($remainingProducts)) {
        echo "Vui lòng nhập đầy đủ thông tin!";
    } else {
        $sql = "UPDATE `sanpham` SET `MA_LOAI`='" . $typeid . "',`MA_SP`='" . $productid . "',`TEN_SP`='" . $productName . "',`MAU`='" . $color . "', `GIA`='" . $price . "', `SO_LUONG`='" . $remainingProducts. "', `HINH_ANH`='" . $productImg . "', `CHI_TIET`='" . $productDetail . "'WHERE `MA_SP`='" . $productid . "'";
        $result = executeQuery($sql);
        if ($result) {
            echo "Cập nhật thông tin sản phẩm thành công!";
        } else {
            echo "Lỗi cập nhật thông tin sản phẩm!";
        }
    }
} catch(Throwable $e){
    echo $e->getMessage();
    http_response_code(400);
    exit;
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