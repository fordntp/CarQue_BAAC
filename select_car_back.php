<?php
include 'connect.php';

if(isset($_POST['user'])){
    if($_POST['user'] == "update"){
        $sql = "UPDATE form_table SET car_num = '$_POST[car_num]' ,d_fname = '$_POST[d_fname]' where form_id = (SELECT MAX(form_id) FROM form_table); ";
        $result = $conn->query($sql);
}
}
?>