<?php
include 'connect.php';

if(isset($_POST['user'])){
    if($_POST['user'] == "insert"){
        $sql = "INSERT INTO driver_table (d_fname, d_lname, d_tel, d_status) VALUES ('$_POST[d_fname]','$_POST[d_lname]','$_POST[d_tel]','$_POST[d_status]')";
        $result = $conn->query($sql);
        echo json_encode($result);
    }
}
?>