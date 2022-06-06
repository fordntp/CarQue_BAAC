<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <title>ระบบจองยานพาหนะ</title>
    <link href="assets/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/dist/css/floating-labels.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@200&display=swap" rel="stylesheet">
  </head>
  <body>
    <form class="form-signin" action="check_login.php" method="POST">
    <div class="text-center mb-3" >
    <img class="text-center" src="img/tks.png" alt="" style="width:30%;">
    </div>
  <div class="text-center mb-4">
    <h3>ระบบจองยานพาหนะ</h3>
    <h5>สำนักงาน ธ.ก.ส.จังหวัดสุราษฎร์ธานี</h5>
  </div>
  <div class="form-label-group">
    <input type="text" name="username" class="form-control" placeholder="ชื่อบัญชีผู้ใช้" required autofocus>
    <label for="inputEmail">ชื่อบัญชีผู้ใช้</label>
  </div>
  <div class="form-label-group">
    <input type="password" name="password"  class="form-control" placeholder="รหัสผ่าน" required>
    <label for="inputPassword">รหัสผ่าน</label>
  </div>
  <?php
  if(isset($_GET["status"])){
  ?>
  <div class="alert alert-danger" role="alert">
    รหัสผู้ใช้หรือรหัสผ่านไม่ถูกต้องกรุณาตรวจสอบ!!
  </div>
  <?php } ?>
  <?php
  if(isset($_GET["notlogin"])){
  ?>
  <div class="alert alert-warning" role="alert">
  กรุณาเข้าสู่ระบบ!!
  </div>
  <?php } ?>
  <?php
  if(isset($_GET["logout"])){
  ?>
  <div class="alert alert-success" role="alert">
  ออกจากระบบสำเร็จ!!
  </div>
  <?php } ?>
  <button class="btn btn-lg btn-green btn-block" type="submit" name="submit" value="login">เข้าสู่ระบบ</button>
    </form>
</body>
</html>
<style>
body{
  background-color:#F4F4F4;
  font-family: 'Kanit', sans-serif;
  font-size:1rem;
}
a{
    color: #047857;
}
.btn-green {
  color: #fff;
  background-color: #047857;
}
</style>