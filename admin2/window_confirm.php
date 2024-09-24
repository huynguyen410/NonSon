<?php
if (isset($_POST['confirm'])) {
    if ($_POST['confirm'] == 'Yes') {
        header("Location:edit.php?id=1");
    }
    else if ($_POST['confirm'] == 'No') {
        header("goBack.php");
    } 
}
?>