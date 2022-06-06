<?php
include 'connect.php';
$_SESSION['t_car'] = $_POST['car_type'];
$_SESSION['d_fname'] = $_POST['d_fname'];
if(isset($_POST['user'])){
    if($_POST['user'] == "update"){
        $sql = "UPDATE form_table SET t_car = '$_POST[car_type]' where form_id = (SELECT MAX(form_id) FROM form_table); ";
        $result = $conn->query($sql);
}
}
if(isset($_POST['user'])){
    if($_POST['user'] == "driver"){
        $sql = "UPDATE form_table SET d_fname = '$_POST[d_fname]' where form_id = (SELECT MAX(form_id) FROM form_table); ";
        $result = $conn->query($sql);
}
}

?>