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
?>