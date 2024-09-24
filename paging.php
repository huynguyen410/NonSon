<?php
$numrows = 0;
// dem so mau tin co trong CSDL
if (isset($_GET['idcat'])) {
    switch ($_GET['idcat']) {
        case 1:
            $sql = "SELECT COUNT(*) AS numrows FROM sanpham";
            break;
        case 2:
            $sql = "SELECT COUNT(*) AS numrows FROM sanpham WHERE SO_LUONG <= 20";
            break;
        case 3:
            $sql = "SELECT COUNT(*) AS numrows FROM sanpham WHERE GIA <= 500000";
            break;
        case 4:
            $sql = "SELECT COUNT(*) AS numrows FROM sanpham WHERE MA_LOAI = 'FF'";
            break;
        case 5:
            $sql = "SELECT COUNT(*) AS numrows FROM sanpham WHERE MA_LOAI = '12F'";
            break;
        default:
            $sql = "SELECT COUNT(*) AS numrows FROM sanpham WHERE MA_LOAI = '34F'";
    }
} else if (isset($_GET['search']) && isset($_GET['submit'])) {
    $string = $_GET['search'];
    $searchSql = "SELECT * FROM sanpham WHERE TEN_SP LIKE '%$string%'";
    $searchResult = $conn->query($searchSql);
    if ($string !== "") {
        $sql = "SELECT COUNT(*) AS numrows FROM sanpham WHERE TEN_SP LIKE '%$string%'";
    } else if ($string === "" || $searchResult->$num_rows == 0) {
        $sql = "SELECT COUNT(*) AS numrows FROM sanpham";
    }
} else if (isset($_GET['category']) && isset($_GET['price-range'])) {
    $sql = "SELECT COUNT(*) AS numrows FROM sanpham WHERE 1=1";
    if (isset($_GET['price-range'])) {
        $priceRange = $_GET['price-range'];
        $filterSql = "SELECT * FROM sanpham WHERE 1=1";
        if ($priceRange !== '') {
            $priceRangeParts = explode('-', $priceRange);
            $minPrice = $priceRangeParts[0];
            $maxPrice = isset($priceRangeParts[1]) ? $priceRangeParts[1] : PHP_INT_MAX;
            $filterSql .= " AND GIA >= $minPrice AND GIA <= $maxPrice";
            $sql .= " AND GIA >= $minPrice AND GIA <= $maxPrice";
        }
    }
    if (isset($_GET['category'])) {
        $category = $_GET['category'];
        if ($category !== '') {
            $filterSql .= " AND MA_LOAI = '$category'";
            $sql .= " AND MA_LOAI = '$category'";
        }
    }
    $filterResult = $conn->query($filterSql);
    if ($filterResult->num_rows == 0) {
        $sql = "SELECT COUNT(*) AS numrows FROM sanpham";
    }
}

$result = $conn->query($sql);
$row = $result->fetch_array();
$numrows = $row['numrows'];

$maxPage = ceil($numrows / $rowsPerPage);

if (isset($_GET['idcat']))
    $self = "category.php?idcat=" . $_GET['idcat'];
else if (isset($_GET['search']) && isset($_GET['submit']))
    $self = "search.php?search=" . $_GET['search'] . "&submit=";
else if (isset($_GET['category']) && isset($_GET['price-range']))
    $self = "search.php?category=" . $_GET['category'] . "&price-range=" . $_GET['price-range'];
$nav = '';

for ($page = 1; $page <= $maxPage; $page++) {
    if ($page == $pageNum) {
        $nav .= "<li class='active'> $page </li>"; // khong can tao link cho trang hien hanh
    } else {
        $nav .= "<a href=\"$self&page=$page\"><li>$page</li></a>";
    }
}
// tao lien ket den trang truoc & trang sau, trang dau, trang cuoi
if ($pageNum > 1) {
    $page = $pageNum - 1;
    $prev = "<a href=\"$self&page=$page\"><li><</li></a>";

    $first = "<a href=\"$self&page=1\"><li><<</li></a>";
} else {
    $prev = ''; // dang o trang 1, khong can in lien ket trang truoc
    $first = ''; // va lien ket trang dau
}

if ($pageNum < $maxPage) {
    $page = $pageNum + 1;
    $next = "<a href=\"$self&page=$page\"><li>></li></a>";

    $last = "<a href=\"$self&page=$maxPage\"><li>>></li></a>";
} else {
    $next = ''; // dang o trang cuoi, khong can in lien ket trang ke
    $last = ''; // va lien ket trang cuoi
}

// hien thi cac link lien ket trang
echo "<center>" . $first . $prev . $nav . $next . $last . "</center>";
?>