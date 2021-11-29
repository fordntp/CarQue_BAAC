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
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

  </head>
<body>
<nav class="navbar navbar-expand  sticky-top bg-green">
        <a class="mll mt-1 mb-1" href="#">
            <img src="img/tks.png" width="60vw" height="60vw"/>
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
            <strong class="navbar-toggler-icon"></strong>
          </button>
          <div class="collapse navbar-collapse" id="navbarText">
            <ul class="navbar-nav mr-auto" >
            <h5 class="p-3">ระบบจองยานพาหนะ <br> สำนักงาน ธ.ก.ส.จังหวัดสุราษฎร์ธานี</h5>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li id="ic" onclick="window.location.href='report.php'" ><img src="img/house-fill.svg" width="50px" height="50px"/></li>
                <li id="ic" onclick="window.location.href=href='check_logout.php?user_logout'" class="pl-4"><img src="img/box-arrow-right.svg" width="50px" height="50px"/></li>
            </ul>
    </nav>
    <!--Navbar End-->
    <div class="row row-height">
      <div id="lside" class="col-2 p-4 col-auto row-height d-flex justify-content-between flex-column  lside">
        <button id="car_info" onclick="window.location.href='car_info.php'" class="btn btn-block btn-green">ข้อมูลรถยนต์</button>
        <button id="driver_info" onclick="window.location.href='driver_info.php'" class="btn btn-block btn-green">ข้อมูลพนักงาน</button>
        <button id="report" onclick="window.location.href='report.php'" class="btn btn-block btn-green">รายงานการจอง</button>
        <button id="approve" onclick="window.location.href='ap_manage.php'" class="btn btn-block btn-green">ผู้อนุมัติ</button>
      </div>
      <div class="col-10 p-5 row-height rside">
      <div class="dec text-center">
      <h4 class="mb-4">ข้อมูลรถยนต์</h4>
      </div>
      <div class="row" id="infocar">
      <?php
            $sql = "SELECT * FROM car_table";
            $result = $conn->query($sql);
        ?>
                <?php 
            $i = 0;
            while($row = $result->fetch_assoc()){
                $i++;
            ?>
        <div class="col-4">
          <div class="card mt-3">
            <div class="card-body text-center">
            <?php echo $row["car_brand"];?><br>
            <?php echo 'ทะเบียน ', $row["car_num"];?><br>
            <?php echo 'จำนวน ', $row["car_val"], ' ที่นั่ง';?> 
            </div>
          </div>
        </div><?php } ?>
      </div>
      <div class="editcar p-5 float-right">
        <button name="toaddcar" id="toaddcar" class="btn btn-success" href="#" type="button" data-toggle="modal" data-target=".add" >เพิ่มข้อมูลรถ</button>
        <button name="toremovecar" id="toremovecar" class="btn btn-danger" href="#" type="button" data-toggle="modal" data-target=".remove">ลบข้อมูล</button>
      </div>      
      <div class="modal fade add" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">เพิ่มข้อมูลรถ</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form>
              <div class="form-group">
                <label for="car_brand" class="col-form-label">ยี่ห้อรถ</label>
                <input type="text" class="form-control" id="car_brand">
                <label for="car_num" class="col-form-label">ทะเบียนรถ</label>
                <input type="text" class="form-control" id="car_num">
                <label for="car_val" class="col-form-label">จำนวนที่นั่ง</label>
                <input type="text" class="form-control" id="car_val">
              </div>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" name="addcar" id="addcar" class="btn btn-success" onclick="return addcar()">เพิ่มข้อมูล</button>
          </div>
        </div>
      </div>  
  </div>
  <div class="modal fade remove" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">ลบข้อมูลรถ</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
          <?php
            $sql = "SELECT * FROM car_table";
            $result = $conn->query($sql);
        ?>
        
            <form>
              <div class="form-group">
              <select class="form-select form-control" aria-label="Default select example"  id="car_num2" name="car_num2" >
              <?php 
                        $i = 0;
                        while($row = $result->fetch_assoc()){
                            $i++;
                        ?>
                    <option  value="<?php echo $row["car_num"];?>" selected>
                        <?php echo $row["car_num"];?>
                    </option> 
                    <?php } ?>

              </select>
              </div>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" name="removecar" id="removecar" class="btn btn-danger" onclick="return removecar()">ลบข้อมูล</button>
          </div>
        </div>
      </div>
      </div>
</div>
    </div>
</body>
</html>
<script>
  $("#alert_login").hide();

function addcar(){
  $("#alert_login").hide();
            $.ajax({
                url: "Addcar.php",
                type: "POST",
                dataType: "json",
                data: {
                    user: "insert",
                    car_brand: $("#car_brand").val(),
                    car_num: $("#car_num").val(),
                    car_val: $("#car_val").val(),
                },
                success: function (response) {
                    alert("เพิ่มรถสำเร็จ!");
                    location.href = 'car_info.php';
                }
            });
    }
  
    function removecar(){
  $("#alert_login").hide();
            $.ajax({
                url: "Removecar.php",
                type: "POST",
                dataType: "json",
                data: {
                    user: "insert",
                    car_num2: $("#car_num2").val(),
                },
                success: function (response) {
                    alert("ลบรถสำเร็จ!");
                    location.href = 'car_info.php';
                }
            });
    }
</script>
<style>
html{
  overflow-x: hidden;
}
body{
  background-color:#fff;
  font-family: 'Kanit', sans-serif;
  font-size:1vw;
  color: #fff;
  overflow-x: hidden;
}
.modal{
  color:#000;
}
a{
    color: #fff;
}
.btn-green {
  padding-top:4vw;
  padding-bottom:4vw;
  color: #fff;
  background-color: #047857;
}
.bg-green{
  color: #fff;
  background-color: #047857;
}
.card{
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
  height:720px;
}
.rside{
  background-color: #fff;
  height: 100%;
}
.table{
  color:#000;
  font-size:1vw;
}
h4{
  color:black;
  text-decoration: underline;
}
#lside{
  background-color: #d0d0d0;
}
</style>