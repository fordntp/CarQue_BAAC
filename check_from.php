<?php
include 'connect.php';

if(isset($_POST['user'])){
    if($_POST['user'] == "checkform"){
        $sql = "INSERT INTO check_form (ch_time) VALUES ('$_POST[time_start1]');";
        $result = $conn->query($sql);
        echo json_encode($result);
    }
  }
?>