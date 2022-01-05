<?php
include 'connect.php';
if(isset($_GET['user'])){
    if($_GET['user'] == "selectemp"){
        $sql = "SELECT * FROM emp_table WHERE emp_id = '$_GET[emp_edit]' ";
        $result = $conn->query($sql);
        $data = $result->fetch_assoc();
        echo json_encode($data);
    }
}
if(isset($_POST['user'])){
    if($_POST['user'] == "editemp"){
        $sql = "UPDATE emp_table SET emp_fname = '$_POST[edemp_fname]' ,emp_lname = '$_POST[edemp_lname]',emp_tel = '$_POST[edemp_tel]',job_title = '$_POST[edjob_title]',emp_po_name = '$_POST[edemp_po_name]' where emp_id = '$_POST[emp_edit]'; ";
        $result = $conn->query($sql);
        echo json_encode($data);
    }
}
?>