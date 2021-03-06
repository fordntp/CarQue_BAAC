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
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@200&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/css/bootstrap-datepicker.min.css" rel="stylesheet"/>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
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
        <button id="contact" onclick="window.location.href='car_for_user.php'" class="btn btn-block pt-4 pb-4 btn-green mb-4">ข้อมูลรถ</button>
      </div>
      <div class="col-10 p-5 row-height rside">
    <div class="row">
      <div class="col-12 text-center">
        <h4>สร้างคำขอ</h4>
      </div>
    </div>
    <div class="form-row">
    <div class="form-group col-md-6">
      <label for=u_fname>ชื่อผู้ขออนุญาต</label>
      <?php
         $emsql = "SELECT * FROM `emp_table`" ;
        $emresult = $conn->query($emsql);
       ?>
      <input class="form-select form-control" aria-label="Default select example" placeholder="ชื่อ นามสกุล" list="select"  id="u_fname">  
      <datalist  id="select">       
        <?php 
        $i = 0;
          while($emrow = $emresult->fetch_assoc()){
            $i++;?>
          <option  value="<?php echo $emrow["emp_fname"], " ", $emrow["emp_lname"];?>" >
          </option> 
                <?php } ?>
          </datalist>
          </input>
    </div>

    <form name="form" action="" method="POST">
      <div class="form-group col-md-6">
        <label for="datepicker">วันที่ขออนุญาต</label>
        <input class="form-control" data-date-format="yyyy-mm-dd"  id="datepicker" style="width:500px;">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/js/bootstrap-datepicker.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script><script type="text/javascript">
            $('#datepicker').datepicker({
                weekStart: 1,
                daysOfWeekHighlighted: "6,0",
                autoclose: true,
                todayHighlight: true,
                startDate: "today"
            });
            $('#datepicker').datepicker("setDate", new Date());
            
        </script>
      </div>
    </form>
    <div class="form-group col-md-6">
      <label for=u_tel>เบอร์โทรผู้ขออนุญาต</label>
      <input type="text" class="form-control" id="u_tel" placeholder="09xxxxxxx">
    </div>
      <div class="form-group col-md-6">
      <form name="form" action="" method="POST">
        <label for=time_start>เวลา ออกเดินทาง</label>
        <select class="form-select form-control" aria-label="Default select example"  id="time_start" name="time_start" onchange="return time_select()">
          <option value="00:00" selected>00:00</option>
          <option value="03:00">00:30</option>
          <option value="01:00">01:00</option>
          <option value="01:00">01:30</option>
          <option value="02:00">02:00</option>
          <option value="01:00">02:30</option>
          <option value="03:00">03:00</option>
          <option value="03:00">03:30</option>
          <option value="04:00">04:00</option>
          <option value="03:00">04:30</option>
          <option value="05:00">05:00</option>
          <option value="03:00">05:30</option>
          <option value="06:00">06:00</option>
          <option value="03:00">06:30</option>
          <option value="07:00">07:00</option>
          <option value="03:00">07:30</option>
          <option value="08:00">08:00</option>
          <option value="03:00">08:30</option>
          <option value="09:00">09:00</option>
          <option value="03:00">09:30</option>
          <option value="10:00">10:00</option>
          <option value="03:00">10:30</option>
          <option value="11:00">11:00</option>
          <option value="03:00">11:30</option>
          <option value="12:00">12:00</option>
          <option value="03:00">12:30</option>
          <option value="13:00">13:00</option>
          <option value="03:00">13:30</option>
          <option value="14:00">14:00</option>
          <option value="03:00">14:30</option>
          <option value="15:00">15:00</option>
          <option value="03:00">15:30</option>
          <option value="16:00">16:00</option>
          <option value="03:00">16:30</option>
          <option value="17:00">17:00</option>
          <option value="03:00">17:30</option>
          <option value="18:00">18:00</option>
          <option value="03:00">18:30</option>
          <option value="19:00">19:00</option>
          <option value="03:00">19:30</option>
          <option value="20:00">20:00</option>
          <option value="03:00">20:30</option>
          <option value="21:00">21:00</option>
          <option value="03:00">21:30</option>
          <option value="22:00">22:00</option>
          <option value="03:00">22:30</option>
          <option value="23:00">23:00</option>
          <option value="03:00">23:30</option>
        </select>
        </form>
    </div>
    <div class="form-group col-md-6">
      <label for=time_end>เวลา กลับเดินทาง</label>
      <select class="form-select form-control" aria-label="Default select example"  id="time_end" name="time_end">
      <option value="00:00" selected>00:00</option>
          <option value="03:00">00:30</option>
          <option value="01:00">01:00</option>
          <option value="01:00">01:30</option>
          <option value="02:00">02:00</option>
          <option value="01:00">02:30</option>
          <option value="03:00">03:00</option>
          <option value="03:00">03:30</option>
          <option value="04:00">04:00</option>
          <option value="03:00">04:30</option>
          <option value="05:00">05:00</option>
          <option value="03:00">05:30</option>
          <option value="06:00">06:00</option>
          <option value="03:00">06:30</option>
          <option value="07:00">07:00</option>
          <option value="03:00">07:30</option>
          <option value="08:00">08:00</option>
          <option value="03:00">08:30</option>
          <option value="09:00">09:00</option>
          <option value="03:00">09:30</option>
          <option value="10:00">10:00</option>
          <option value="03:00">10:30</option>
          <option value="11:00">11:00</option>
          <option value="03:00">11:30</option>
          <option value="12:00">12:00</option>
          <option value="03:00">12:30</option>
          <option value="13:00">13:00</option>
          <option value="03:00">13:30</option>
          <option value="14:00">14:00</option>
          <option value="03:00">14:30</option>
          <option value="15:00">15:00</option>
          <option value="03:00">15:30</option>
          <option value="16:00">16:00</option>
          <option value="03:00">16:30</option>
          <option value="17:00">17:00</option>
          <option value="03:00">17:30</option>
          <option value="18:00">18:00</option>
          <option value="03:00">18:30</option>
          <option value="19:00">19:00</option>
          <option value="03:00">19:30</option>
          <option value="20:00">20:00</option>
          <option value="03:00">20:30</option>
          <option value="21:00">21:00</option>
          <option value="03:00">21:30</option>
          <option value="22:00">22:00</option>
          <option value="03:00">22:30</option>
          <option value="23:00">23:00</option>
          <option value="03:00">23:30</option>
      </select>
    </div>
    <div class="form-group col-md-6">
      <label for=work_title>ปฏิบัติงานเรื่อง</label>
      <input type="text" class="form-control" id="work_title" placeholder="ติดตามหนี้...">
    </div>
    <div class="form-group col-md-6">
      <label for=workplace>สถานที่ปฏิบัติงาน</label>
      <input class="form-select form-control" aria-label="Default select example" list="selectp" id="workplace" placeholder="สาขาพนม...">  
      <datalist  id="selectp">       
          <option  value="สำนักงาน ธ.ก.ส.จังหวัด" ></option> 
          <option  value="สาขาบ้านเสด็จ" ></option> 
          <option  value="สาขาทุ่งเตา" ></option> 
          <option  value="สาขากรูด" ></option> 
          <option  value="สาขาท่าโรงช้าง " ></option> 
          <option  value="สาขาวิภาวดี" ></option> 
          <option  value="สาขาบางสวรรค์" ></option> 
          <option  value="สาขาเกาะพะงัน" ></option>
          <option  value="สาขาชัยบุรี" ></option>
          <option  value="สาขาพนม" ></option>
          <option  value="สาขาย่อยควนสามัคคี" ></option> 
          <option  value="สาขาเคียนซา" ></option> 
          <option  value="สาขาท่าฉาง" ></option> 
          <option  value="สาขาพระแสง" ></option> 
          <option  value="สาขาเกาะสมุย" ></option> 
          <option  value="สาขาเวียงสระ " ></option> 
          <option  value="สาขาบ้านนาสาร" ></option> 
          <option  value="สาขาบ้านนาเดิม" ></option>
          <option  value="สาขาพุนพิน" ></option>
          <option  value="สาขาย่อยบ้านใน" ></option>
          <option  value="สาขาดอนสัก " ></option> 
          <option  value="สาขาย่อยตลาดหนองหวาย" ></option> 
          <option  value="สาขาท่าชนะ" ></option> 
          <option  value="สาขาบ้านตาขุน" ></option> 
          <option  value="สาขาย่อยโมถ่าย" ></option> 
          <option  value="สาขาไชยา" ></option>
          <option  value="สาขากาญจนดิษฐ์" ></option>
          <option  value="สาขาย่อยบ้านทำเนียบ" ></option>
          <option  value="สาขาคีรีรัฐนิคม" ></option>
          <option  value="สาขาย่อยขุนทะเล" ></option> 
          


 
        </datalist>
          </input>
    </div>
    <div class="form-group col-md-6">
      <label for=num_worker>จำนวนผู้เดินทาง</label>
      <select class="form-select form-control" aria-label="Default select example"  id="num_worker" name="num_worker" >
        <option value="1" selected>1 คน</option>
        <option value="2">2 คน</option>
        <option value="3">3 คน</option>
        <option value="4">4 คน</option>
        <option value="5">5 คน</option>
        <option value="6">6 คน</option>
        <option value="7">7 คน</option>
        <option value="8">8 คน</option>
        <option value="9">9 คน</option>
        <option value="10">10 คน</option>
      </select>
    </div>
  </div>
  <input id="u_name" value="<?php echo $_SESSION["u_name"]?>" hidden>
  <input id="t_car" value="รถเก๋ง" hidden>
  <div class="col-12 text-center">
  <div class="form-label">
        <center ><input class="mr-3" id="check_login" type="checkbox">ยืนยันข้อมูล</center>
    </div>
  <button class="btn btn-green pl-5 pr-5 mt-2"type="submit" name="submit" value="login" onclick="return checkform()">ถัดไป</button>

  </div>
      </div>

    </div>
</body>
</html>
<script>


function checkform(){
  if($("#check_login:checked").val() == "on"){
            $.ajax({
                url: "form_request_back.php",
                type: "POST",
                dataType: "json",
                data: {
                    user: "insertt",
                    u_fname: $("#u_fname").val(),
                    u_tel: $("#u_tel").val(),
                    datepicker: $("#datepicker").val(),
                    time_start: $("#time_start").val(),
                    time_end: $("#time_end").val(),
                    work_title: $("#work_title").val(),
                    workplace: $("#workplace").val(),
                    num_worker: $("#num_worker").val(),
                    u_name: $("#u_name").val(),
                    t_car: $("#t_car").val(),
                },
                success: function (response) {
                    location.href = 'select_car.php';
                },
                error: function (response) {
                    location.href = 'select_car.php';
                }
            })
        }
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
  height:45vw;
  background-color: #d0d0d0;
}
</style>