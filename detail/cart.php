<?php
session_start();
require '../admin2/DataProvider.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Giỏ hàng | Software Store</title>
  <link href="../img/logo/icon-trans.png" rel="icon" sizes="16x16 32x32" type="image/png">
  <link rel="stylesheet" href="../css/style.css">
  <link rel="stylesheet" href="../css/bootstrap.css">

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
  <link rel="stylesheet" href="../css/all.min.css">
  <link rel="stylesheet" href="../css/ChiTiet.css">
  <script src="../js/bootstrap.bundle.min.js"></script>
  <script src="../js/script.js"></script>
  <script src="https://code.iconify.design/iconify-icon/1.0.1/iconify-icon.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="../css/giohang.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
</head>

<body>
  <nav class="navbar navbar-expand-lg navbar-dark fixed-top">
    <div class="container">
      <a href="../index.php" class="navbar-brand me-5">
        <img src="../img/logo/logo-trans.png">
      </a>

      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navmenu">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navmenu">
        <ul class="navbar-nav">
          <li class="nav-item mx-lg-4">
            <a href="../index.php" class="btn btn-outline-light">Trang chủ</a>
          </li>
        </ul>
        <ul class="navbar-nav">
          <li class="nav-item me-lg-3">
            <a href="#ThongTin" class="btn btn-outline-light">Thông tin</a>
          </li>
        </ul>
      </div>
      <form class="d-flex" role="search">
        <div>
          <input id="searchBar" onkeyup="searchForProducts()" style="border-radius: 0.25rem 0 0 0.25rem;" class="form-control me-2" type="text" placeholder="Tìm kiếm sản phẩm" aria-label="Search" size="56">
          <!-- <ul style="display:none;" id="searchList" class="list-group searchInput mt-1">
            <li><a href="../priceFilter.html" class="list-group-item list-group-item-action">Tìm kiếm theo giá</a>
            <li><a href="#" class="list-group-item list-group-item-action">Tài Khoản Netflix
                Premium 1 ngày - Xem phim chất lượng 4k và Full HD</a></li>
            <li><a href="#" class="list-group-item list-group-item-action">Tài khoản nghe
                nhạc
                Spotify
                Premium (1 tuần)</a></li>
            <li><a href="#" class="list-group-item list-group-item-action">Tài khoản nghe
                nhạc
                Spotify
                Premium (1 tháng)</a></li>
            <li><a href="#" class="list-group-item list-group-item-action">Tài khoản
                YouTube
                Premium +
                YouTube Music (1 tháng)</a></li>
            <li><a href="#" class="list-group-item list-group-item-action">Tài khoản Canva 1
                tháng</a></li>
            <li><a href="Canva1nam.html" class="list-group-item list-group-item-action">Tài khoản Canva 1
                năm</a>
            </li>
            <li><a href="Discord1nam.html" class="list-group-item list-group-item-action">Tài khoản Discord
                Nitro 1
                năm
                (Classic)</a></li>
            <li><a href="#" class="list-group-item list-group-item-action">Tài khoản
                Discord Nitro
                1 tháng
                (Classic)</a></li>
            <li><a href="Linkedin6thang.html" class="list-group-item list-group-item-action">Tài khoản
                LinkedIn
                Premium
                Business (6 tháng)</a></li>
            <li><a href="#" class="list-group-item list-group-item-action">Tài Khoản
                Netflix
                Premium 1
                tháng - Xem phim chất lượng 4k và Full HD</a></li>
            <li><a href="Youtube1nam.html" class="list-group-item list-group-item-action">Tài khoản YouTube
                Premium
                +
                YouTube Music (1 năm)</a></li>
            <li><a href="Netflix6thang.html" class="list-group-item list-group-item-action">Tài Khoản
                Netflix
                Premium 6
                tháng - Xem phim chất lượng 4k và Full HD</a></li>
            <li><a href="Spotify1nam.html" class="list-group-item list-group-item-action">Tài khoản nghe
                nhạc
                Spotify
                Premium (1 năm)</a></li>
            <li><a href="#" class="list-group-item list-group-item-action">Tài khoản nghe
                nhạc
                Spotify
                Premium (6 tháng)</a></li>
            <li><a href="#" class="list-group-item list-group-item-action">Tài khoản
                YouTube
                Premium +
                YouTube Music (6 tháng)</a></li>
          </ul> -->
        </div>
        <div>
          <button class="btn disabled btn-outline-light">
            <i class="fa-solid fa-magnifying-glass"></i>
          </button>
        </div>
      </form>
      <div class="collapse navbar-collapse" id="navmenu">
        <ul class="navbar-nav ">
          <li class="nav-item ms-lg-3" id="just-li">
            <?php
            if (!isset($_SESSION['Username'])) {
              echo
              '<a href="../login.php" class="btn btn-outline-light" id="showName">
                Đăng nhập / Đăng ký
              </a>';
            } else {
              echo ' 
              <div class="dropdown" id="showName">
              <div class="btn btn-outline-light" data-bs-toggle="dropdown">
                Xin chào,' . $_SESSION['Username']. 
              '</div>
              <div class="dropdown-menu">
                <a class="dropdown-item" href="../logout.php"><i class="fa-solid fa-right-from-bracket"></i> Đăng xuất</a>
              </div>
        </div>';
            }
            ?>
          </li>
          <li class="nav-item ms-lg-3">
            <a href="cart.php">
              <div class="cart">
                <i class="fa-solid fa-cart-shopping"></i> Giỏ hàng
                <div id="cartAmount" class="cartAmount">0</div>
              </div>
            </a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  <br>
  <br>
  <div class="container margin-bottom-4">
    <div class="row">
      <div class="shopping-cart margin-top-4 col-8" id="shopping-cart"></div>
      <div id="label" class="margin-top-4 col-4"></div>
    </div>
    <div class="text-center;">
                        <h2 class="margin-top-10;" style="padding-left: 90px;">Giỏ hàng trống!</h2>
                        <p class="p-2">Thêm sản phẩm vào giỏ và quay lại trang này để thanh toán&#128526</p>
                        <img class="img-fluid" style="width: 150%;" src="../img/emptyCart.png">
                    </div>
  </div>
  <div class="popup" id="popup1"> <img src="../img/BlueTick.png">
    <h2 style="font-size: 25px;">Thanh toán thành công!</h2>
    <p class="p-2">Vui lòng kiểm tra Email để nhận được thông tin sản phẩm</pc>
      <button class="btn" type="button" onclick="closePopup1()">
        <p class="text-light mt-2 fs-5 ">Đóng</p>
      </button>
  </div>
  <!-- Footer -->
  <div class="container-fluid footer-bg mt-4" id="ThongTin">
    <h1 class="text-center">LIÊN HỆ CHÚNG TÔI</h1>
    <div class="social d-flex justify-content-around">
      <a href="https://www.facebook.com/" title="facebook">
        <i class="fa-brands fa-facebook"></i>
      </a>
      <a href="https://www.youtube.com/">
        <i class="fa-brands fa-youtube"></i>
      </a>
      <a href="https://twitter.com/">
        <i class="fa-brands fa-twitter"></i>
      </a>
    </div>

    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center border-bottom"></div>

    <div class="row text-center mt-2">
      <div class="col">
        <p>Thứ 2 - Thứ 6: 8:00 - 17:00</p>
        <p>Cuối tuần: 8:00 - 12:00</p>
      </div>
      <div class="col">
        <p>Số điện thoại: 0499-499-499</p>
        <p>daihocsaigon@gmail.com</p>
        <p>Quận 5 - Thành phố Hồ Chí Minh - Việt Nam </p>
      </div>
      <div class="col">
        <p title="3121411086">Nguyễn Hoàng Bảo Huy</p>
        <p title="3121411058">Nguyễn Hữu Đức</p>
        <p title="3121411070">Huỳnh Lê Trung Hiếu</p>
        <p title="3121411081">Trương Quang Hùng</p>
      </div>
      <div>
        <hr class="light-100 mt-1">
        <h5>&copy; Software Store</h5>
      </div>
    </div>
  </div>
</body>
<script>
  initData()
  showLatedLogin()
</script>
<script src="../js/Data.js"></script>
<script src="../js/cart.js"></script>

</html>