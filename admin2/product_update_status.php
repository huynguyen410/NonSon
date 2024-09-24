<?php
require './DataProvider.php';
$masp = $_GET["MA_SP"];
$status = $_GET["TINH_TRANG_SP"];

$sql = "UPDATE `sanpham`
SET `TINH_TRANG_SP` = $status
WHERE 
`MA_SP` = '$masp'";
executeQuery($sql);

header('Location:product.php');
?>