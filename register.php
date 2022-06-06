<?php
include 'connect.php';


?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <title>สร้างบัญชีใหม่</title>
    <link href="img/favicon.ico" rel="icon" type="image/x-icon" />
    <link href="assets/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/dist/css/floating-labels.css" rel="stylesheet">
    <script type="text/javascript" src="assets/datatables/jQuery-3.3.1/jquery-3.5.1.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@200&display=swap" rel="stylesheet">
  </head>
  <body>
    <div class="p-3 " style="width: 50rem; margin: auto;opacity: .95;">
    <div class="text-center mb-4">
        <p id="head">สร้างบัญชีใหม่</p>
        <p id="keed">...................................................................................................</p>
    </div>
    <div class="form-label-group">
        <input type="text" name="u_id" id="u_id" class="form-control" placeholder="รหัสประจำตัวพนักงาน" required autofocus>
        <label for="inputEmail">รหัสประจำตัวพนักงาน</label>
    </div>
    <div class="form-label-group">
        <input type="text" name="u_fname" id="u_fname" class="form-control" placeholder="ชื่อจริง" required autofocus>
        <label for="inputEmail">ชื่อ</label>
    </div>
    <div class="form-label-group">
        <input type="text" name="u_lname" id="u_lname" class="form-control" placeholder="นามสกุล" required autofocus>
        <label for="inputEmail">นามสกุล</label>
    </div>
    <div class="form-label-group">
        <input type="text" name="u_name" id="u_name" class="form-control" placeholder="Username" required autofocus>
        <label for="inputEmail">ชื่อผู้ใช้</label>
    </div>
    <div>
    <label for="State">ตำแหน่งพนักงาน : </label>
    <?php
            $sql = "SELECT * FROM position_table";
            $result = $conn->query($sql);
        ?>
    <select class="form-select btn-block text-center" aria-label="Default select example"  id="u_emp" name="u_emp">
                <?php 
                        $i = 0;
                        while($row = $result->fetch_assoc()){
                            $i++;
                        ?>
                <option  value="<?php echo $row["po_id"];?>" selected>
                        <?php echo $row["po_title"];?>
                </option> 
                <?php } ?>
            </select>
    </div>
    <br>
    <div class="form-label-group">
        <input type="password" name="u_password" id="u_password" class="form-control" placeholder="รหัสผ่าน" required>
        <label for="inputPassword">รหัสผ่าน</label>
    </div>
    <div class="form-label-group">
        <input type="password" name="u_password_confirm" id="u_password_confirm" class="form-control" placeholder="รหัสผ่าน" required>
        <label for="inputPassword">ยืนยันรหัสผ่าน</label>
    </div>
    <div class="alert alert-warning" id="alert_login" role="alert">
         กรุณากรอกรหัสผ่านยืนยันให้ถูกต้อง
    </div>
    <div class="form-label">
        <center ><input class="mr-3" id="check_login" type="checkbox">
        <span>ยืนยันลงทะเบียนเข้าสู่ระบบ</span></center>
    </div>
    <button class="btn btn-lg btn-green btn-block mt-4" type="submit" name="submit" value="login" onclick="return check()">ลงทะเบียน</button>
    <br>
    <center><p>มีบัญชีแล้ว? <a style="font-style: italic;" href="index.php">เข้าสู่ระบบ</a></center>
    </div>
<script>
$("#alert_login").hide();
function check(){
    if($("#check_login:checked").val() == "on"){
        if($("#u_password").val() == $("#u_password_confirm").val()){
            $("#alert_login").hide();
            $.ajax({
                url: "register_add.php",
                type: "POST",
                dataType: "json",
                data: {
                    user: "insert",
                    u_id: $("#u_id").val(),
                    u_fname: $("#u_fname").val(),
                    u_lname: $("#u_lname").val(),
                    u_name: $("#u_name").val(),
                    u_password: $("#u_password").val(),
                    u_emp:$("#u_emp").val()
                },
                success: function (response) {
                    alert("ลงทะเบียนเสร็จสิ้น");
                    location.href = 'index.php';
                }
            })
        }else{
            console.log("NO");
            $("#alert_login").show();
        }
    }
}

</script>
</body>
</html>
<style>
body{
  background-color:#F4F4F4;
  font-family: 'Kanit', sans-serif;
  font-size:1rem;
}
#keed{
    text-decoration: line-through solid 12px #047857 ;
    color:#F4F4F4;
}
.btn-green {
  color: #fff;
  background-color: #047857;
}
a{
    color: #047857;
}
#head{
    font-size:2rem;
}

</style>
