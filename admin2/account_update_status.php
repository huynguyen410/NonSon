<?php
require './DataProvider.php';
$username = $_GET["username"];
$status = $_GET["status"];

$sql = "UPDATE `taikhoan`
SET `STATUS` = $status
WHERE 
`USERNAME` = '$username'";
executeQuery($sql);

header('Location:accountList.php');
?>