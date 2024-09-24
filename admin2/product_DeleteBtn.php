<?php
require './DataProvider.php';
$masp = $_GET["MA_SP"];
$sql = "DELETE FROM `sanpham` WHERE MA_SP = '$masp'";
executeQuery($sql);
header('Location:product.php');
?>