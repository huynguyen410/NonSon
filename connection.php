<?php
// session_start();
$conn = mysqli_connect("localhost", "root", "", "adminpanel");
// Kiem tra ket noi
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
function executeQuery($sql){
$conn = mysqli_connect("localhost", "root", "", "adminpanel");
    //3. Thuc thi truy van
    if (!($result = $conn->query($sql)))
        echo $conn->connect_error;
    //4.Dong ket noi CSDL
    if (!($conn->close()))
        echo $conn->connect_error;
    return $result;
}
?>