<?php
include 'connect.php';

if(isset($_POST['user'])){
    if($_POST['user'] == "addemp"){
        $sql = "INSERT INTO emp_table (emp_fname,emp_lname,emp_tel,job_title,emp_po_name) VALUES ('$_POST[emp_fname]','$_POST[emp_lname]','$_POST[emp_tel]','$_POST[job_title]','$_POST[emp_po_name]')";
        $result = $conn->query($sql);
        echo json_encode($result);
    }
}

if(isset($_POST['user'])){
    if($_POST['user'] == "removeemp"){
        $sql = "DELETE FROM emp_table WHERE emp_id = '$_POST[emp_select_name]'";
        $result = $conn->query($sql);
        echo json_encode($result);
    }
}
?>