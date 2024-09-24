<?php
require './DataProvider.php';

$request = $_REQUEST; //a PHP Super Global variable which used to collect data after submitting it from the form
$username = $request["Username_edit"];
$name = $request["Name_edit"];
$phoneNumber = $request["phoneNumber_edit"];
$email = $request["email_edit"];
$address = $request["Address_edit"];
$role = $request["Role_edit"];

if (empty($name) || empty($phoneNumber) || empty($email) || empty($address)) {
    echo "Vui lòng nhập đầy đủ thông tin!";
} else {
    if (!preg_match('/^[0-9]{10}$/', $phoneNumber)) {
        echo '<script> alert("Số điện thoại không hợp lệ. Vui lòng nhập lại số điện thoại"); history.go(-1); </script>';
        exit;
    }
    $sql = "UPDATE `taikhoan` SET `USERNAME`='" . $username . "',`NAME`='" . $name . "', `PHONE_NUMBER`='" . $phoneNumber . "', `EMAIL`='" . $email . "', `ADDRESS`='" . $address . "', `ROLE`='" . $role . "'WHERE `USERNAME`='" . $username . "'";
    $result = executeQuery($sql);
    if ($result) {
        echo "Cập nhật thông tin người dùng thành công!";
    } else {
        echo "Lỗi cập nhật thông tin người dùng!";
    }
}
?>