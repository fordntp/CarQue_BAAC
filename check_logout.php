<?php
if(isset($_GET["user_logout"])){
    session_start(); 
    session_destroy();
    header("Location: index.php?logout"); 
}
?>