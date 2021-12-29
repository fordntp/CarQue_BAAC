<?php
include 'connect.php';
if($_POST["submit"] == "login"){
    $sql = "select * from user_table us 
    join position_table ps on us.po_id = ps.po_id
    where u_name = '$_POST[username]' and u_password = '$_POST[password]' ";
    $result = $conn->query($sql);
    $num_row = $result->num_rows;
    $row = $result->fetch_assoc();
    if($num_row == 1){
        $_SESSION["u_id"] = $row["u_id"];
        $_SESSION["u_name"] = $row["u_name"];
        $_SESSION["u_fname"] = $row["u_fname"];
        $_SESSION["u_lname"] = $row["u_lname"];
        $_SESSION["po_name"] = $row["po_name"];
        if($_SESSION["po_name"] == "admin"){
            echo "admin";
            header("Location: ap_manage.php");
        }
        else if($_SESSION["po_name"] == "user"){
            echo "user";
            header("Location: home.php");
        }
        else if($_SESSION["po_name"] == "Driver"){
            echo "user";
            header("Location: driver_home.php");
        }
        else if($_SESSION["po_name"] == "approver"){
            echo "user";
            header("Location: approver_home.php");
        }
    }else{
        header("Location: index.php?status=not");
    }
}else{
    header("Location: index.php");
}
?>