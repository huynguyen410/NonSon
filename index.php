<?php
session_start();
include 'header.php';
require 'connection.php';
$sql1 = "SELECT * FROM sanpham WHERE SO_LUONG <= 20 LIMIT 8";
$hot_products = $conn->query($sql1);
$sql2 = "SELECT * FROM sanpham WHERE GIA < 500000";
$cheap_products = $conn->query($sql2);

// Kiểm tra xem người dùng đã đăng nhập chưa
if (isset($_SESSION['name'])) {
  // Nếu đã đăng nhập, hiển thị tên người dùng
  echo '<div class="dropdown" id="showName">';
  echo '<div class="btn btn-outline-light" data-bs-toggle="dropdown">';
  echo 'Xin chào, ' . $_SESSION['name'];
  echo '</div>';
  echo '<div class="dropdown-menu">';
  echo '<a class="dropdown-item" href="logout.php"><i class="fa-solid fa-right-from-bracket"></i> Đăng xuất</a>';
  echo '</div>';
  echo '<div class="btn btn-outline-light" data-bs-toggle="dropdown">';
  echo 'Xin chào, ' . $_SESSION['name'];
  echo '</div>';
  echo '<div class="dropdown-menu">';
  echo '<a class="dropdown-item" href="logout.php"><i class="fa-solid fa-right-from-bracket"></i> Đăng xuất</a>';
  echo '</div>';
  echo '</div>';
} else {
  // Nếu chưa đăng nhập, hiển thị nút đăng nhập
  echo '<a class="btn btn-outline-light" href="login.php">Đăng nhập</a>';
}
?>
<!-- Header -->
<!-- Carousel and the List -->
<div class="container mt-5">
  <div class="row row-cols-lg-5 g-2 g-lg-3">
    <div class="col-md-3">
      <div id="DanhMuc" class="d-inine-flex flex-column border border-light bg-list rounded mt-2 mb-2">
        <div class="p-2 ms-2 text-center fw-bold">DANH MỤC SẢN PHẨM</div>
        <hr class="mt-2 mb-2 bg-secondary">
        <div class="p-2 fw-bold"><a href="category.php?idcat=1"><i class="fa-solid fa-helmet-un"
              style="color: #4b6bec;"></i> TẤT CẢ</a></div>
        <div class="p-2 fw-bold"><a href="category.php?idcat=2"><i class="fa-solid fa-helmet-un"
              style="color: #4b6bec;"></i> SẢN PHẨM NỔI BẬT</a></div>
        <div class="p-2 fw-bold"><a href="category.php?idcat=3"><i class="fa-solid fa-helmet-un"
              style="color: #4b6bec;"></i> SẢN PHẨM GIÁ RẺ</a></div>
        <div class="p-2 fw-bold"><a href="category.php?idcat=4"><i class="fa-solid fa-helmet-un"
              style="color: #4b6bec;"></i> NÓN FULLFACE</a></div>
        <div class="p-2 fw-bold"><a href="category.php?idcat=5"><i class="fa-solid fa-helmet-un"
              style="color: #4b6bec;"></i> NÓN 1/2 ĐẦU</a></div>
        <div class="p-2 fw-bold"><a href="category.php?idcat=6"><i class="fa-solid fa-helmet-un"
              style="color: #4b6bec;"></i> NÓN 3/4 ĐẦU</a></div>
      </div>
    </div>
    <div class="col-md-6">
      <div id="carouselIndicators" class="carousel slide" data-bs-ride="carousel">
        <!-- Indicators/dots -->
        <div class="carousel-indicators">
          <button type="button" data-bs-target="#carouselIndicators" data-bs-slide-to="0" class="active"></button>
          <button type="button" data-bs-target="#carouselIndicators" data-bs-slide-to="1"></button>
          <button type="button" data-bs-target="#carouselIndicators" data-bs-slide-to="2"></button>
        </div>

        <!-- The slideshow/carousel -->
        <div class="carousel-inner">
          <div class="carousel-item img-fluid active">
            <img src="img/car33.png" width="1280px" height="300px" class="d-block rounded">
          </div>
          <div class="carousel-item img-fluid ">
            <img src="img/car22.png" width="1280px" height="300px" class="d-block rounded">
          </div>
          <div class="carousel-item img-fluid ">
            <img src="img/car1.jpg" width="1280px" height="300px" class="d-block rounded">
          </div>
        </div>

        <!-- Left and right controls/icons -->
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselIndicators" data-bs-slide="prev">
          <span class="carousel-control-prev-icon"></span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselIndicators" data-bs-slide="next">
          <span class="carousel-control-next-icon"></span>
        </button>
      </div>
    </div>
    <div class="col-md-3">
      <a href="detail.php?id=12F1">
        <img src="img/12F1.jpg" class="img-fluid rounded mt-2">
      </a>
    </div>
  </div>
</div>
<!-- Our features -->
<div class="container">
  <div class="d-flex justify-content-between mt-3">
    <h4>Sản phẩm nổi bật</h4>
    <a href="category.php?idcat=2" class="btn btn-primary">Khám phá</a>
  </div>
  <div>Danh sách những sản phẩm theo xu hướng mà có thể bạn sẽ thích</div>
  <div id="hotProducts" class="row row-cols-2 row-cols-lg-4 g-2 g-lg-3 mt-1">
    <?php
    while ($row = mysqli_fetch_assoc($hot_products)) {
      ?>
      <div class="col-md-3">
        <a href="detail.php?id=<?php echo $row["MA_SP"]; ?>">
          <img src="<?php echo $row["HINH_ANH"]; ?>" class="img-fluid rounded w-100">
        </a>
        <a href="detail.php?id=<?php echo $row["MA_SP"]; ?>">
          <p class="my-1">
            <?php echo $row["TEN_SP"]; ?>
          </p>
        </a>
        <div class="fw-bold">
          <?php
          $formatted_price = number_format($row["GIA"]);
          echo $formatted_price . "đ";
          ?>
        </div>
      </div>
      <?php
    }
    ?>
  </div>

  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-1 border-bottom">
  </div>

  <div class="d-flex justify-content-between mt-3">
    <h4>Sản phẩm giá rẻ</h4>
    <a href="category.php?idcat=3" class="btn btn-primary">Khám phá</a>
  </div>
  <div>
    Dưới đây là những sản phẩm có giá rẻ nhưng vẫn có chất lượng tốt của chúng tôi
  </div>
  <div id="cheapProducts" class="row row-cols-2 row-cols-lg-4 g-2 g-lg-3 mt-1">
    <?php
    while ($row = mysqli_fetch_assoc($cheap_products)) {
      ?>
      <div class="col-md-3">
        <a href="detail.php?id=<?php echo $row["MA_SP"]; ?>">
        <a href="detail.php?id=<?php echo $row["MA_SP"]; ?>">
          <img src="<?php echo $row["HINH_ANH"]; ?>" class="img-fluid rounded w-100">
        </a>
        <a href="detail.php?id=<?php echo $row["MA_SP"]; ?>">
        <a href="detail.php?id=<?php echo $row["MA_SP"]; ?>">
          <p class="my-1">
            <?php echo $row["TEN_SP"]; ?>
          </p>
        </a>
        <div class="fw-bold">
          <?php 
          $formatted_price = number_format($row["GIA"], 1, '.');
          echo $formatted_price . "đ";
          ?>
        </div>
      </div>
    <?php
    }
    ?>
  </div>
</div>
<!-- Footer -->

<?php
include 'footer.php';
?>