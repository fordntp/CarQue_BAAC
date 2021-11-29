<?php
include 'connect.php';

if(isset($_POST['user'])){
    if($_POST['user'] == "insert"){
        $sql = "DELETE FROM driver_table WHERE d_id = '$_POST[d_fname2]'";
        $result = $conn->query($sql);
        echo json_encode($result);
    }
}
?>