<?php
include 'connect.php';
if(isset($_GET['user'])){
    if($_GET['user'] == "select_edit"){
        $sql = "SELECT * FROM car_table WHERE car_num = '$_GET[car_num3]' ";
        $result = $conn->query($sql);
        $data = $result->fetch_assoc();
        echo json_encode($data);
    }
}
if(isset($_POST['user'])){
    if($_POST['user'] == "editcar"){
        $sql = "UPDATE car_table SET car_num = '$_POST[car_num]' ,car_brand = '$_POST[car_brand]', car_val = '$_POST[car_val]',car_type = '$_POST[car_type2]' where car_num = '$_POST[car_num3]'; ";
        $result = $conn->query($sql);
        echo json_encode($data);
    }
}