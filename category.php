<?php
session_start();
require 'connection.php';
require 'header.php';

$rowsPerPage = 8;

$pageNum = 1;

if (isset($_GET['page'])) {
    $pageNum = $_GET['page'];
}

$offset = ($pageNum - 1) * $rowsPerPage;
$sql1 = "SELECT * FROM sanpham LIMIT $offset, $rowsPerPage";
$all_products = $conn->query($sql1);
$sql2 = "SELECT * FROM sanpham WHERE SO_LUONG <= 20 LIMIT $offset, $rowsPerPage";
$hot_products = $conn->query($sql2);
$sql3 = "SELECT * FROM sanpham WHERE GIA <= 500000 LIMIT $offset, $rowsPerPage";
$cheap_products = $conn->query($sql3);
$sql4 = "SELECT * FROM sanpham WHERE MA_LOAI = 'FF' LIMIT $offset, $rowsPerPage";
$FF_products = $conn->query($sql4);
$sql5 = "SELECT * FROM sanpham WHERE MA_LOAI = '12F' LIMIT $offset, $rowsPerPage";
$HF_products = $conn->query($sql5);
$sql6 = "SELECT * FROM sanpham WHERE MA_LOAI = '34F' LIMIT $offset, $rowsPerPage";
$TF_products = $conn->query($sql6);

$tabData = array(
  array("id" => "pills-1", "name" => "TẤT CẢ", "selected" => "false"),
  array("id" => "pills-2", "name" => "SẢN PHẨM NỔI BẬT", "selected" => "false"),
  array("id" => "pills-3", "name" => "SẢN PHẨM GIÁ RẺ", "selected" => "false"),
  array("id" => "pills-4", "name" => "NÓN FULLFACE", "selected" => "false"),
  array("id" => "pills-5", "name" => "NÓN 1/2 ĐẦU", "selected" => "false"),
  array("id" => "pills-6", "name" => "NÓN 3/4 ĐẦU", "selected" => "false")
);
?>

<!-- Categories -->
<div class="container margin-top-7">
  <h2>Danh mục sản phẩm</h2>
  <ul class="nav nav-pills mt-3" id="pills-tab" role="tablist">
    <?php
    $count = 0;
    foreach ($tabData as $key => $tab) {
      $count = $count + 1;
      if (isset($_GET['idcat']) && $tab['id'] == "pills-" . $_GET['idcat']) {
        $tab['selected'] = 'true';
      }
      $active = ($tab['selected'] == 'true') ? 'active' : '';
      ?>
      <li class="nav-item" role="presentation">
        <a href="category.php?idcat=<?php echo $count; ?>" class="nav-link <?php echo $active; ?>" id="<?php echo $tab['id']; ?>-tab">
          <?php echo $tab['name']; ?>
        </a>
      </li>
      <?php
    }
    ?>
  </ul>

</div>
<!--Nội dung tab -->
<div class="tab-content container" id="pills-tabContent">
  <!-- Tất cả -->
  <div class="tab-pane fade" id="pills-1" role="tabpanel" aria-labelledby="pills-1-tab">
    <div class="row row-cols-2 row-cols-lg-4 g-2 g-lg-3 mt-1">
      <?php
      while ($row = mysqli_fetch_assoc($all_products)) {
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
  </div>

  <!-- Sản phẩm nổi bật -->
  <div class="tab-pane fade" id="pills-2" role="tabpanel" aria-labelledby="pills-2-tab">
    <div class="row row-cols-2 row-cols-lg-4 g-2 g-lg-3 mt-1">
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
  </div>

  <!-- Sản phẩm giá rẻ -->
  <div class="tab-pane fade" id="pills-3" role="tabpanel" aria-labelledby="pills-3-tab">
    <div class="row row-cols-2 row-cols-lg-4 g-2 g-lg-3 mt-1">
      <?php
      while ($row = mysqli_fetch_assoc($cheap_products)) {
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
  </div>

  <!-- FULLFACE -->
  <div class="tab-pane fade" id="pills-4" role="tabpanel" aria-labelledby="pills-4-tab">
    <div class="row row-cols-2 row-cols-lg-4 g-2 g-lg-3 mt-1">
      <?php
      while ($row = mysqli_fetch_assoc($FF_products)) {
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
  </div>

  <!-- 1/2 Đầu -->
  <div class="tab-pane fade" id="pills-5" role="tabpanel" aria-labelledby="pills-5-tab">
    <div class="row row-cols-2 row-cols-lg-4 g-2 g-lg-3 mt-1">
      <?php
      while ($row = mysqli_fetch_assoc($HF_products)) {
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
  </div>
  <!-- 3/4 Đầu -->
  <div class="tab-pane fade" id="pills-6" role="tabpanel" aria-labelledby="pills-6-tab">
    <div class="row row-cols-2 row-cols-lg-4 g-2 g-lg-3 mt-1">
      <?php
      while ($row = mysqli_fetch_assoc($TF_products)) {
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
  </div>
</div>
<br>
<ul id="page" class="listPage mt-3">
<?php
  include "paging.php";
?>
</ul>
<!-- Footer -->
<?php
foreach ($tabData as $key => $tab) {
  if (isset($_GET['idcat']) && $tab['id'] == "pills-" . $_GET['idcat']) {
    echo "<script>";
    echo "document.getElementById('pills-" . $_GET['idcat'] . "').classList.add('show', 'active');";
    echo "</script>";
  }
}
include "footer.php";
?>