<?php
include 'connect.php';

if(isset($_POST['user'])){
    if($_POST['user'] == "insert"){
        $sql = "INSERT INTO user_table (u_id,u_fname, u_lname, u_name, u_password,po_id) VALUES ('$_POST[u_id]','$_POST[u_fname]','$_POST[u_lname]','$_POST[u_name]','$_POST[u_password]','$_POST[u_emp]')";
        $result = $conn->query($sql);
        echo json_encode($result);
    }
}
?>