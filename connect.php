<?php

date_default_timezone_set('Asia/Bangkok'); 
session_start(); 

$servername = "localhost"; 
$username = "root"; 
$password = "";
$dbname = "car_queue"; 

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

function check_login (){
    if($_SESSION["po_name"] == ""){
        header("Location: index.php?notlogin");
    }
}

function dateToThai($date){
    $strYear = date("Y",strtotime($date))+543;
    $strMonth = date("n",strtotime($date));
    $strMonthCut = Array("","ม.ค.","ก.พ.","มี.ค.","เม.ย.","พ.ค.","มิ.ย.","ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค.");
    $strMonththai = $strMonthCut[$strMonth];
    $strDay = date("j",strtotime($date));
    return "$strDay $strMonththai $strYear";
}
?>