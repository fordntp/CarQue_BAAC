<?php
include 'connect.php';

if(isset($_POST['user'])){
    if($_POST['user'] == "insert"){
        $sql = "INSERT INTO car_table (car_brand, car_num, car_val) VALUES ('$_POST[car_brand]','$_POST[car_num]','$_POST[car_val]')";
        $result = $conn->query($sql);
        echo json_encode($result);
    }
}
?>