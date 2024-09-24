<?php
session_start();
include "header.php";
//Khai báo utf-8 để hiển thị được tiếng việt
header('Content-Type: text/html; charset=UTF-8');

//Xử lý đăng nhập
if (isset($_POST['submit'])) {
    //Kết nối tới database
    include('./admin2/DataProvider.php');

    //Lấy dữ liệu nhập vào
    $username = addslashes($_POST['Username']);
    $password = addslashes($_POST['Password']);


    //Kiểm tra đã nhập đủ tên đăng nhập với mật khẩu chưa
    if (!$username || !$password) {
        echo '<script> alert("Vui lòng nhập tên đăng nhập và mật khẩu."); history.go(-1);  </script>';
        exit;
    }

    //Kiểm tra tên đăng nhập có tồn tại không
    $query = mysqli_query($conn, "SELECT USERNAME, PASSWORD FROM taikhoan WHERE USERNAME='$username'");

    if (mysqli_num_rows($query) == 0) {
        echo '<script> alert("Tên đăng nhập này không tồn tại. Vui lòng kiểm tra lại"); history.go(-1);  </script>';
        exit;
    }

    //Lấy mật khẩu trong database ra
    $passwordRow = mysqli_fetch_array($query);
    //So sánh mật khẩu có trùng khớp với database hay không
    if (!password_verify($password, $passwordRow[1])) {
        echo '<script> alert("Mật khẩu không đúng. Vui lòng nhập lại."); history.go(-1);  </script>';
        exit;
    }

    //kiểm tra phải admin không
    $result = mysqli_query($conn, "SELECT `role` FROM `taikhoan` WHERE `USERNAME`='$username'");
    $row2 = mysqli_fetch_assoc($result);
    $role = $row2['role'];
    if ($role == 1) {
        $_SESSION['Username'] = $username;
        echo '<script> window.location.href = "./admin2/accountList.php"; </script>';
        die();
    } else {
        $_SESSION['Username'] = $username;
        echo '<script> window.location.href = "./index.php"; </script>';
        die();
    }
}

?>
<!-- Login -->
<div class="login-body margin-top-10 margin-bottom-7">
    <div class="login">
        <h1 class="text-center">Đăng Nhập</h1>
        <form class="needs-validation" action="login.php" method="post">
            <div class="form-group was-validated">
                <label class="form-label" for="Username">Tên tài khoản</label>
                <input class="form-control" type="Username" name="Username" id="Username" required>
                <div class="invalid-feedback">Hãy nhập tài khoản</div>
            </div>

            <div class="form-group">
                <label class="form-label" for="Password">Mật khẩu</label>
                <input class="form-control" type="Password" name="Password" id="Password" required>
                <div class="invalid-feedback">Hãy nhập mật khẩu</div>
            </div>

            <input class="btn btn-success w-100 mt-4" type="submit" name="submit" value="Đăng Nhập">
        </form>
        <p class="another-login mt-4">--------------- Chưa có tài khoản ? ---------------</p>
        <a href="register.php"><button class="btn btn-success w-100" style="background-color: rgb(24, 172, 51);">Đăng
                Ký</button></a>
    </div>
</div>
<!-- Footer -->
<?php
include "footer.php";
?>