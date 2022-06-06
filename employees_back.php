<?php
include 'connect.php';

if(isset($_POST['user'])){
    if($_POST['user'] == "addemp"){
        $sql = "INSERT INTO emp_table (emp_id, emp_fname,emp_lname,emp_tel,job_title,emp_po_name) VALUES ('$_POST[emp_id]','$_POST[emp_fname]','$_POST[emp_lname]','$_POST[emp_tel]','$_POST[job_title]','$_POST[emp_po_name]')";
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

if(isset($_POST['roll'])){
        if($_POST['roll'] == "adduser"){
            if($_POST['emp_po_name'] == 'แอดมิน'){
                $po1 = '001';
                $name = 'admin'.'_'.$_POST['emp_id'];
            }
            else if($_POST['emp_po_name'] == 'ผู้จอง'){
                $po1 = '002';
                $name = 'user'.'_'.$_POST['emp_id'];
            }
            else if($_POST['emp_po_name'] == 'ผู้อนุมัติ'){
                $po1 = '003';
                $name = 'approver'.'_'.$_POST['emp_id'];

            }
            else if($_POST['emp_po_name'] == 'พนักงานขับรถ'){
                $po1 = '004';
                $name = 'driver'.'_'.$_POST['emp_id'];
            }
        
        $sql = "INSERT INTO user_table (u_name,u_password,u_fname,u_lname,po_id) VALUES ('$name','$_POST[emp_id]','$_POST[emp_fname]','$_POST[emp_lname]','$po1')";
        $result = $conn->query($sql);
        echo json_encode($result);
    }
}
?>