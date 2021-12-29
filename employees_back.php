<?php
include 'connect.php';
if(isset($_POST['user'])){
    if($_POST['user'] == "select_emp"){
        for($i=1;$i<1000;$i++){
        $sql = "UPDATE emp_table SET emp_po_name = '$_POST[emp_po1]' where emp_id = '$_POST[emp_id]'; ";
        $result = $conn->query($sql);
        echo json_encode($data);
        }
    }
}
 ?>