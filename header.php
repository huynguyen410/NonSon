<?php if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['addToCart'])) {
  if (!isset($_SESSION)) {
    session_start();
  }

  $id = $_GET['id'];
  if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = array();
  }

  // Kiểm tra xem sản phẩm đã tồn tại trong giỏ hàng hay chưa
  if (array_key_exists($id, $_SESSION['cart'])) {
    $_SESSION['cart'][$id] += 1; // Tăng số lượng sản phẩm trong giỏ hàng lên 1
  } else {
    $_SESSION['cart'][$id] = 1; // Thêm sản phẩm mới vào giỏ hàng với số lượng là 1
  }
}

?>

<!DOCTYPE html>
<html lang="en">
<link>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<link href="img/logo/icon-trans.png" rel="icon" sizes="16x16 32x32" type="image/png">
<link rel="stylesheet" href="css/style.css">
<link rel="stylesheet" href="css/bootstrap.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
<link rel="stylesheet" href="css/giohang.css">
<link rel="stylesheet" href="css/Login-site.css">
<link rel="stylesheet" href="css/Register-site.css">
<link rel="stylesheet" href="css/all.min.css">
<link rel="stylesheet" href="css/ChiTiet.css">
<script src="js/bootstrap.bundle.min.js"></script>
<script src="js/script.js"></script>
<script src="https://code.iconify.design/iconify-icon/1.0.1/iconify-icon.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
<title>NonSon Store</title>
</head>

<body>
  <!-- Navbar -->

  <nav class="navbar navbar-expand-lg navbar-dark fixed-top">
    <div class="container">
      <a href="./index.php" class="navbar-brand me-5">
        <img src="img/logo/logo-trans1.png">
      </a>

      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navmenu">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navmenu">
        <ul class="navbar-nav">
          <li class="nav-item mx-lg-4">
            <a href="index.php" class="btn btn-outline-light">Trang chủ</a>
          </li>
        </ul>
        <ul class="navbar-nav">
          <li class="nav-item me-lg-3">
            <a href="#ThongTin" class="btn btn-outline-light">Thông tin</a>
          </li>
        </ul>
      </div>
      <form class="d-flex" role="search" method="GET" action="search.php">
        <div>
          <input name="search" id="searchBar" style="border-radius: 0.25rem 0 0 0.25rem;" class="form-control me-2"
            type="text" placeholder="Tìm kiếm sản phẩm" aria-label="Search" size="56">
        </div>
        <div>
          <button name="submit" type="submit" class="btn btn-outline-light">
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
                '<a href="login.php" class="btn btn-outline-light" id="showName">
                Đăng nhập / Đăng ký
              </a>';
            } else {
              echo ' 
              <div class="dropdown" id="showName">
                <div class="btn btn-outline-light" data-bs-toggle="dropdown">
                Xin chào,' . $_SESSION['Username']
                . '</div>
              <div class="dropdown-menu">
                <a class="dropdown-item" href="./logout.php"><i class="fa-solid fa-right-from-bracket"></i> Đăng xuất</a>
              </div>
        </div>';
            }
            ?>
          </li>
          <li class="nav-item ms-lg-3">
            <a href="cart.php">
              <div class="cart">
                <i class="fa-solid fa-cart-shopping"></i> Giỏ hàng
                <div id="cartAmount" class="cartAmount">
                  <?php
                  if (isset($_SESSION['cart'])) {
                    $totalItems = array_sum($_SESSION['cart']);
                    echo $totalItems;
                  } else {
                    echo 0;
                  }
                  ?>

                </div>

              </div>
            </a>
          </li>
        </ul>
      </div>
    </div>
  </nav>