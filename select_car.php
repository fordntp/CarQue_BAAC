<?php
include 'connect.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ระบบจองยานพาหนะ</title>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <script
  src="http://code.jquery.com/jquery-3.3.1.min.js"
  integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
  crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
  <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js" ></script>
    <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@200&display=swap" rel="stylesheet">
  </head>
<body>
<nav class="navbar navbar-expand  sticky-top bg-green">
        <a class="mll mt-1 mb-1" href="#">
            <img src="img/tks.png" width="60px" height="60px"/>
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
            <strong class="navbar-toggler-icon"></strong>
          </button>
          <div class="collapse navbar-collapse" id="navbarText">
            <ul class="navbar-nav mr-auto" >
            <h5 class="p-3">ระบบจองยานพาหนะ <br> สำนักงาน ธ.ก.ส.จังหวัดสุราษฎร์ธานี</h5>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li id="ic" onclick="window.location.href='home.php'" ><img src="img/house-fill.svg" width="50px" height="50px"/></li>
                <li id="ic" onclick="window.location.href=href='check_logout.php?user_logout'"  class="pl-4"><img src="img/box-arrow-right.svg" width="50px" height="50px"/></li>
            </ul>
    </nav>
    <!--Navbar End-->
    <div class="row row-height">
    <div id="lside" class="col-2 p-4 col-auto row-height lside">
        <button id="home" onclick="window.location.href='home.php'" class="btn btn-block pt-4 pb-4 btn-green mb-4">หน้าแรก</button>
        <button id="c_request" onclick="window.location.href='form_request.php'" class="btn btn-block pt-4 pb-4 btn-green mb-4">สร้างคำร้องขอ</button>
        <button id="contact" onclick="window.location.href='contact.php'" class="btn btn-block pt-4 pb-4 btn-green mb-4">ข้อมูลการติดต่อ</button>
      </div>
      <div class="col-10 p-5 row-height rside">
    <div class="row">
      <div class="col-12 text-center">
        <h4>เลือกรถที่คุณต้องการ</h4>
      </div>
    </div>
  <div class="form-row">
  <?php
            $sql = "SELECT * FROM `form_table` left JOIN Driver_table ON form_table.d_fname != driver_table.d_fname WHERE due_date IN (SELECT due_date FROM form_table WHERE form_id = (SELECT MAX(form_id) FROM form_table)) AND form_table.d_fname = '' 
            AND Driver_table.d_fname NOT IN (SELECT DISTINCT form_table.d_fname FROM `form_table` RIGHT JOIN Driver_table ON form_table.d_fname != Driver_table.d_fname WHERE due_date IN (SELECT due_date FROM form_table WHERE form_id = (SELECT MAX(form_id) FROM form_table))  
                  AND time_start BETWEEN 
                  
                    (SELECT DISTINCT time_start FROM `form_table` left JOIN Driver_table ON form_table.d_fname != Driver_table.d_fname WHERE due_date IN (SELECT due_date FROM form_table WHERE form_id = (SELECT MAX(form_id) FROM form_table)) AND form_table.d_fname = '') 
                    AND (SELECT DISTINCT time_end FROM `form_table` left JOIN Driver_table ON form_table.d_fname != Driver_table.d_fname WHERE due_date IN (SELECT due_date FROM form_table WHERE form_id = (SELECT MAX(form_id) FROM form_table)) AND form_table.d_fname = '') 
                      
                  OR due_date IN (SELECT due_date FROM form_table WHERE form_id = (SELECT MAX(form_id) FROM form_table))  
                  AND time_end BETWEEN  
                    
                     (SELECT DISTINCT time_start FROM `form_table` left JOIN Driver_table ON form_table.d_fname != Driver_table.d_fname WHERE due_date IN (SELECT due_date FROM form_table WHERE form_id = (SELECT MAX(form_id) FROM form_table)) AND form_table.d_fname = '') 
                    AND (SELECT DISTINCT time_end FROM `form_table` left JOIN Driver_table ON form_table.d_fname != Driver_table.d_fname WHERE due_date IN (SELECT due_date FROM form_table WHERE form_id = (SELECT MAX(form_id) FROM form_table)) AND form_table.d_fname = '') 
                    
                   OR due_date IN (SELECT due_date FROM form_table WHERE form_id = (SELECT MAX(form_id) FROM form_table )) AND time_start < (SELECT DISTINCT time_start FROM `form_table` left JOIN Driver_table ON form_table.d_fname != Driver_table.d_fname WHERE due_date IN (SELECT due_date FROM form_table WHERE form_id = (SELECT MAX(form_id) FROM form_table)) AND form_table.d_fname = '') 
                   
                   AND due_date IN (SELECT due_date FROM form_table WHERE form_id = (SELECT MAX(form_id) FROM form_table )) 
                   AND time_end > (SELECT DISTINCT time_end FROM `form_table` left JOIN Driver_table ON form_table.d_fname != Driver_table.d_fname WHERE due_date IN (SELECT due_date FROM form_table WHERE form_id = (SELECT MAX(form_id) FROM form_table)) AND form_table.d_fname = '')
                    )";
            $result = $conn->query($sql);
        ?>
    <div class="form-group col-md-6">
      <label for=d_fname>ชื่อผู้ขับ</label>
      <select class="form-select form-control" aria-label="Default select example"  id="d_fname" name="d_fname">
        <option value="ขับเอง" selected>ขับเอง</option>
      <?php 
        $i = 0;
          while($row = $result->fetch_assoc()){
            $i++;?>
          <option  value="<?php echo $row["d_fname"];?>" >
          <?php echo $row["d_fname"], " ", $row["d_lname"];?>
          </option> 
      <?php } ?>
      </select>
    </div>
    <?php
        $sql = "SELECT * FROM `form_table` left JOIN car_table ON form_table.car_num != car_table.car_num WHERE due_date IN (SELECT due_date FROM form_table WHERE form_id = (SELECT MAX(form_id) FROM form_table)) AND form_table.car_num = '' AND car_table.car_num NOT IN (SELECT DISTINCT form_table.car_num FROM `form_table` RIGHT JOIN car_table ON form_table.car_num != car_table.car_num WHERE due_date IN (SELECT due_date FROM form_table WHERE form_id = (SELECT MAX(form_id) FROM form_table))  
        AND time_start BETWEEN 
        
          (SELECT DISTINCT time_start FROM `form_table` left JOIN car_table ON form_table.car_num != car_table.car_num WHERE due_date IN (SELECT due_date FROM form_table WHERE form_id = (SELECT MAX(form_id) FROM form_table)) AND form_table.car_num = '') 
          AND (SELECT DISTINCT time_end FROM `form_table` left JOIN car_table ON form_table.car_num != car_table.car_num WHERE due_date IN (SELECT due_date FROM form_table WHERE form_id = (SELECT MAX(form_id) FROM form_table)) AND form_table.car_num = '')
            
        OR due_date IN (SELECT due_date FROM form_table WHERE form_id = (SELECT MAX(form_id) FROM form_table))  
        AND time_end BETWEEN  
          
            (SELECT DISTINCT time_start FROM `form_table` left JOIN car_table ON form_table.car_num != car_table.car_num WHERE due_date IN (SELECT due_date FROM form_table WHERE form_id = (SELECT MAX(form_id) FROM form_table)) AND form_table.car_num = '') 
          AND (SELECT DISTINCT time_end FROM `form_table` left JOIN car_table ON form_table.car_num != car_table.car_num WHERE due_date IN (SELECT due_date FROM form_table WHERE form_id = (SELECT MAX(form_id) FROM form_table)) AND form_table.car_num = '')
         OR due_date IN (SELECT due_date FROM form_table WHERE form_id = (SELECT MAX(form_id) FROM form_table )) AND time_start < (SELECT DISTINCT time_start FROM `form_table` left JOIN car_table ON form_table.car_num != car_table.car_num WHERE due_date IN (SELECT due_date FROM form_table WHERE form_id = (SELECT MAX(form_id) FROM form_table)) AND form_table.car_num = '')  AND due_date IN (SELECT due_date FROM form_table WHERE form_id = (SELECT MAX(form_id) FROM form_table )) AND time_end > (SELECT DISTINCT time_end FROM `form_table` left JOIN car_table ON form_table.car_num != car_table.car_num WHERE due_date IN (SELECT due_date FROM form_table WHERE form_id = (SELECT MAX(form_id) FROM form_table)) AND form_table.car_num = '')
         
          )";            
        $result = $conn->query($sql);
        ?>
    <div class="form-group col-md-6">
      <label for=car_num>ทะเบียนรถที่ต้องการ</label>
      <select class="form-select form-control" aria-label="Default select example"  id="car_num" name="car_num">
      <?php 
        $i = 0;
          while($row = $result->fetch_assoc()){
            $i++;?>
          <option  value="<?php echo $row["car_num"];?>" selected>
              <?php echo $row["car_brand"],' ',$row["car_num"];?>
          </option> 
      <?php } ?>
      </select>
    </div>
  </div>
  <input id="u_name" value="<?php echo $_SESSION["u_name"]?>" hidden>
  <div class="col-12 text-center">
  <button class="btn btn-green pl-5 pr-5 mt-2" type="submit" name="submit"  onclick="return checkform1()">ส่งคำขอ</button>

  </div>
      </div>

    </div>
</body>
</html>
<script>

function checkform1(){
  alert("บันทึกแบบฟอร์มสำเร็จ");
            $.ajax({
                url: "select_car_back.php",
                type: "POST",
                dataType: "json",
                data: {
                    user: "update",
                    d_fname:$("#d_fname").val(),
                    car_num: $("#car_num").val(),
                },
                success: function (response) {
                    location.href = 'home.php';
                },
                error: function (response) {
                    location.href = 'home.php';
                }
            })
}
</script>
<style>
html{
  overflow-x: hidden;
}
body{
  background-color:#fff;
  font-family: 'Kanit', sans-serif;
  font-size:1.5rem;
  color: #fff;
  overflow-x: hidden;
}
a{
    color: #fff;
}
.btn-green {
  color: #fff;
  background-color: #047857;
}
.bg-green {
  color: #fff;
  background-color: #047857;
}
.bg-green:visited {
  color: #fff;
  background-color: #047857;
}
.navbar{
    height:100px;

}
#ic:hover{
  cursor: pointer;
}
}
.lside{
  background-color: #f4f4f4;
}
.rside{
  background-color: #fff;
  height: 100%;
}
.table{
  color:#000;
  font-size:0.8rem;
}
h4{
  color:black;
  text-decoration: underline;
}
.card{
  color: #fff;
  background-color: #047857;
}
label{
  color:black;
  font-size:0.95rem;
}
center{
  color:black;
  font-size:0.9rem;
}
#lside{
  height: 45vw;
  background-color: #d0d0d0;
}
</style>