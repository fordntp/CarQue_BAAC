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

if(isset($_GET['user'])){
    if($_GET['user'] == "del"){
        $sql = "DELETE FROM form_table WHERE form_id = '$_GET[form_id]'";
        $result = $conn->query($sql);
        echo json_encode($result);
        echo "<script>alert(\"ลบข้อมูลเสร็จสิ้น !!\"); window.location=\"ap_manage.php\"</script>";
    }
}

if(isset($_GET['user'])){
    if($_GET['user'] == "del1"){
        $sql = "DELETE FROM form_table WHERE form_id = '$_GET[form_id]'";
        $result = $conn->query($sql);
        echo json_encode($result);
        echo "<script>alert(\"ลบข้อมูลเสร็จสิ้น !!\"); window.location=\"approver_manage.php\"</script>";
    }
}

if(isset($_GET['user'])){
    if($_GET['user'] == "del2"){
        $sql = "DELETE FROM form_table WHERE form_id = '$_GET[form_id]'";
        $result = $conn->query($sql);
        echo json_encode($result);
        echo "<script>alert(\"ลบข้อมูลเสร็จสิ้น !!\"); window.location=\"home.php\"</script>";
    }
}

if(isset($_GET['user']) == "select_edit"){
    if($_GET['user'] == "select_edit"){
        $sql = "SELECT * FROM form_table WHERE form_id = '$_GET[form_id]' ";
        $result = $conn->query($sql);
        $data = $result->fetch_assoc();
        echo json_encode($data);
    }

}

if(isset($_POST['user'])){
    if($_POST['user'] == "updateform"){
        $sql = "UPDATE form_table SET u_fname = '$_POST[u_fname]' , u_tel = '$_POST[u_tel]',due_date = '$_POST[datepicker]', time_start = '$_POST[time_start]',time_end = '$_POST[time_end]',work_title = '$_POST[work_title]',workplace = '$_POST[workplace]', num_worker = '$_POST[num_worker]' where form_id = '$_POST[form_id]'";
        $result = $conn->query($sql);
        echo json_encode($data);
    }
}
if(isset($_GET['user']) == "select_edit"){
    if($_GET['user'] == "select_edit1"){
        $sql = "SELECT * FROM form_table WHERE form_id = '$_GET[form_id]' ";
        $result = $conn->query($sql);
        $data = $result->fetch_assoc();
        echo json_encode($data);
    }

}

if(isset($_POST['user'])){
    if($_POST['user'] == "updateform1"){
        $sql = "UPDATE form_table SET u_fname = '$_POST[u_fname]' , u_tel = '$_POST[u_tel]',due_date = '$_POST[datepicker]', time_start = '$_POST[time_start]',time_end = '$_POST[time_end]',work_title = '$_POST[work_title]',workplace = '$_POST[workplace]', num_worker = '$_POST[num_worker]' where form_id = '$_POST[form_id]'";
        $result = $conn->query($sql);
        echo json_encode($data);
    }
}
?>