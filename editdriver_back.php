<?php
include 'connect.php';
if(isset($_GET['user'])){
    if($_GET['user'] == "select_driver"){
        $sql = "SELECT * FROM driver_table WHERE d_id = '$_GET[d_id]' ";
        $result = $conn->query($sql);
        $data = $result->fetch_assoc();
        echo json_encode($data);
    }
}
if(isset($_POST['user'])){
    if($_POST['user'] == "editdriver"){
        $sql = "UPDATE driver_table SET d_fname = '$_POST[d_fname]' ,d_lname = '$_POST[d_lname]', d_tel = '$_POST[d_tel]' WHERE d_id = '$_POST[d_id]'; ";
        $result = $conn->query($sql);
        echo json_encode($data);
    }
}