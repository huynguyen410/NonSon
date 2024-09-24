<?php
session_start();
include "connection.php";
include "header.php";

$rowsPerPage = 8;

$pageNum = 1;

if (isset($_GET['page'])) {
    $pageNum = $_GET['page'];
}

$offset = ($pageNum - 1) * $rowsPerPage;

if (isset($_GET["search"])) {
  $str = $_GET["search"];
  $sql = "SELECT * FROM sanpham WHERE TEN_SP LIKE '%$str%'";
} else {
  $str = "";
}
if (isset($_GET['price-range'])) {
  $priceRange = $_GET['price-range'];
  $sql = "SELECT * FROM sanpham WHERE 1=1";
  if ($priceRange !== '') {
    $priceRangeParts = explode('-', $priceRange);
    $minPrice = $priceRangeParts[0];
    $maxPrice = isset($priceRangeParts[1]) ? $priceRangeParts[1] : PHP_INT_MAX;
    $sql .= " AND GIA >= $minPrice AND GIA <= $maxPrice";
  }
}
if (isset($_GET['category'])) {
  $category = $_GET['category'];
  if ($category !== '') {
    $sql .= " AND MA_LOAI = '$category'";
  }
}
$sql .= " LIMIT $offset, $rowsPerPage";
$result = $conn->query($sql);
$all_sql = "SELECT * FROM sanpham LIMIT $offset, $rowsPerPage";
$all_products = $conn->query($all_sql);
?>

<div class="container margin-top-6">
  <h2>Tìm kiếm sản phẩm</h2>
  <?php
  if (isset($_GET["submit"]) && isset($_GET['search'])) {
    if ($str !== "") {
      if ($result->num_rows > 0) {
        echo "<p>Hiển thị kết quả tìm kiếm cho \"" . $str . "\"</p>";
        include "selection.php";
        echo "<div id='' class='row row-cols-2 row-cols-lg-4 g-2 g-lg-3 mt-1'>";
        while ($row = mysqli_fetch_assoc($result)) {
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
        echo "</div>";
      } else {
        echo "<p style='color:red;'>Không có kết quả cho tìm kiếm \"" . $str . "\".</p>";
      }
    }

    if ($str == "" || $result->num_rows == 0) {
      include "selection.php";
      echo "<div id='' class='row row-cols-2 row-cols-lg-4 g-2 g-lg-3 mt-1'>";
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
      echo "</div>";
    }
  } else if (isset($_GET['price-range']) && isset($_GET['category'])) {
    if ($result->num_rows > 0) {
      include "selection.php";
      echo "<div id='' class='row row-cols-2 row-cols-lg-4 g-2 g-lg-3 mt-1'>";
      while ($row = mysqli_fetch_assoc($result)) {
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
      echo "</div>";
    } else {
      echo "<p style='color:red;'>Không có kết quả cho Khoảng giá và Phân loại trên.</p>";
      $category = "";
      $priceRange = "";
      include "selection.php";
      echo "<div id='' class='row row-cols-2 row-cols-lg-4 g-2 g-lg-3 mt-1'>";
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
      echo "</div>";
    }
  }
  ?>
</div>
<ul id="page" class="listPage mt-3">
<?php
  include "paging.php";
?>
</ul>
<!-- Footer -->
<?php
include "footer.php";
?>