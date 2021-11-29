<?php
include 'connect.php';
if(isset($_POST['user'])){
    if($_POST['user'] == "edit"){
        for($i=1;$i<1000;$i++){
        $a = 'q_status'.$i;
        $sql = "UPDATE form_table SET q_status = '$_POST[$a]' WHERE form_id = '$i'";
        $result = $conn->query($sql);
    }
}
}
?>