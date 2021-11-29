<?php
include 'connect.php';

if(isset($_POST['user'])){
    if($_POST['user'] == "insert"){
        $sql = "DELETE FROM car_table WHERE car_num = '$_POST[car_num2]'";
        $result = $conn->query($sql);
        echo json_encode($result);
    }
}
?>