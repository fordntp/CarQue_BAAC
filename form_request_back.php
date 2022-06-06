<?php
include 'connect.php';

if(isset($_POST['user'])){
    if($_POST['user'] == "insertt"){
        $sql = "INSERT INTO form_table (u_fname,d_fname,u_tel,due_date,time_start,time_end,work_title,workplace,num_worker,car_num,uc_name,t_car) VALUES ('$_POST[u_fname]','$_POST[d_fname]','$_POST[u_tel]','$_POST[datepicker]','$_POST[time_start]','$_POST[time_end]','$_POST[work_title]','$_POST[workplace]','$_POST[num_worker]','$_POST[car_num]','$_POST[u_name]','$_POST[t_car]')";
        $result = $conn->query($sql);
        echo json_encode($result);
    }
}
?>