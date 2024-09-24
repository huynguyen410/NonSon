<?php
session_start();
require 'header.php';
require 'connection.php';
if (isset($_POST['submit'])) {
  $username = $_POST["Username"];
  $password = $_POST["Password"];
  $confirmpassword = $_POST["Password_2"];
  $name = $_POST["Name"];
  $phoneNumber = $_POST["phoneNumber"];
  $email = $_POST["Email"];
  $address = $_POST["Address"];

  //mã hoá mk
  $decryptedPassword = password_hash($password, PASSWORD_DEFAULT);
  //Kiểm tra số điện thoại hợp lệ
  if (!preg_match('/^[0-9]{10}$/', $phoneNumber)) {
    echo '<script> alert("Số điện thoại không hợp lệ. Vui lòng nhập lại số điện thoại"); history.go(-1); </script>';
    exit;
  }
  //Kiểm tra tên đăng nhập này đã có người dùng chưa
  if (mysqli_num_rows(mysqli_query($conn, "SELECT USERNAME, EMAIL FROM taikhoan WHERE USERNAME='$username' OR EMAIL='$email'")) > 0) {
    echo '<script> alert("Tên đăng nhập hoặc email này đã tồn tại. Vui lòng chọn tên đăng nhập hoặc email khác"); history.go(-1); </script>';
    exit;
  } else {
    if ($password == $confirmpassword) {
      //đưa vô csdl
      $query = "INSERT INTO taikhoan VALUES('$username','$decryptedPassword','$name','$phoneNumber','$email','$address','0','1')";
      mysqli_query($conn, $query);
      echo
      '<script> alert("Đăng kí thành công"); window.location.href = "./login.php"; </script>';
    } else {
      echo '<script> alert("Mật khẩu không trùng khớp"); history.go(-1); </script>';
    }
  }
}
?>
  <!-- Register -->
  <br><br><br>
  <div class="Register-body margin-top-10 margin-bottom-10">
    <div class="Register">
      <h1 class="text-center">Đăng ký</h1>
      <form class="needs-validation" method="post">

        <div class="form-group was-validated">
          <label class="form-label" for="Username">Tên đăng nhập</label>
          <input class="form-control" type="text" name="Username" id="Username" required>
          <div class="invalid-feedback">Username KHÔNG viết dấu và khoảng cách</div>
        </div>

        <div class="form-group was-validated">
          <label class="form-label" for="Password">Mật khẩu</label>
          <input class="form-control" type="Password" name="Password" id="Password" required>
          <div class="invalid-feedback">Hãy nhập mật khẩu</div>
        </div>

        <div class="form-group">
          <label class="form-label" for="Password_2">Nhập lại mật khẩu</label>
          <input class="form-control" type="Password" name="Password_2" id="Password_2" required>
          <div class="invalid-feedback">Hãy nhập mật khẩu</div>
        </div>

        <div class="form-group was-validated">
          <label class="form-label" for="Name">Nhập tên của bạn</label>
          <input class="form-control" type="text" name="Name" id="Name" required>
          <div class="invalid-feedback">Tối thiểu 3 ký tự và tối đa 50 ký tự</div>
        </div>

        <div class="form-group was-validated">
          <label class="form-label" for="phoneNumber">Nhập số điện thoại</label>
          <input class="form-control" type="text" name="phoneNumber" id="phoneNumber" required>
        </div>

        <div class="form-group was-validated">
          <label class="form-label" for="Email">Email</label>
          <input class="form-control" type="email" name="Email" id="Email" required>
          <div class="invalid-feedback">Email không đúng định dạng</div>
        </div>

        <div class="form-group was-validated">
          <label class="form-label" for="Address">Nhập địa chỉ nhận hàng</label>
          <input class="form-control" type="text" name="Address" id="Address" required>
        </div>

        <div class="form-group form-check" style="padding-top: 20px; ">
          <input class="form-check-input" type="checkbox" id="check" required>
          <label class="form-check-label" for="check">Tôi đồng ý với chính sách của Bán Nón</label>
        </div>
        <input class="btn btn-success w-100 mt-3" type="submit" name="submit" value="Đăng ký">
      </form>
    </div>
  </div>
  <br><br><br><br><br>
  <!-- Footer -->
<?php 
include 'footer.php';
?>