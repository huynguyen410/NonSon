<?php
require './DataProvider.php';

if (isset($_POST['add'])) {
    $username = $_POST["Username"];
    $password = $_POST["Password"];
    $name = $_POST["Name"];
    $phoneNumber = $_POST["phoneNumber"];
    $email = $_POST["email"];
    $address = $_POST["Address"];
    $role = $_POST["Role"];

    //mã hoá mk
    $decryptedPassword = password_hash($password, PASSWORD_DEFAULT);

    if (empty($username) ||empty($password) ||empty($name) || empty($phoneNumber) || empty($email) || empty($address)) {
        echo '<script> alert("Vui lòng nhập đầy đủ thông tin!"); history.go(-1);</script>';
        exit;
    }
    //Kiểm tra số điện thoại hợp lệ
    if (!preg_match('/^[0-9]{10}$/', $phoneNumber)) {
        echo '<script> alert("Số điện thoại không hợp lệ. Vui lòng nhập lại số điện thoại"); history.go(-1);</script>';
        exit;
    }
    //Kiểm tra tên đăng nhập này đã có người dùng chưa
    if (mysqli_num_rows(mysqli_query($conn, "SELECT `USERNAME`, `EMAIL` FROM taikhoan WHERE USERNAME='$username' OR EMAIL='$email'")) > 0) {
        echo '<script> alert("Tên đăng nhập hoặc email này đã tồn tại. Vui lòng chọn tên đăng nhập hoặc email khác"); history.go(-1); </script>';
        exit;
    } else {
        $query = "INSERT INTO taikhoan VALUES('$username','$decryptedPassword','$name','$phoneNumber','$email','$address','$role','1')";
        mysqli_query($conn, $query);
        echo
        '<script> alert("Thêm thành công"); window.location.href = "./accountList.php";</script>';
    }
}
