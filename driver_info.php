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
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@200&display=swap" rel="stylesheet">
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
                <li id="ic" onclick="window.location.href=href='check_logout.php?user_logout'"  class="pl-4"><img src="img/box-arrow-right.svg" width="50px" height="50px"/></li>
            </ul>
    </nav>
    <!--Navbar End-->
    <div class="row row-height">
    <div id="lside" class="col-2 p-4 col-auto row-height d-flex justify-content-start flex-column  lside">
      <button id="car_info" onclick="window.location.href='employees.php'" class="btn btn-block btn-green">ข้อมูลพนักงานทั้งหมด</button>
        <button id="car_info" onclick="window.location.href='car_info.php'" class="btn btn-block btn-green">ข้อมูลรถยนต์</button>
        <button id="driver_info" onclick="window.location.href='driver_info.php'" class="btn btn-block btn-green">ข้อมูลพนักงานขับรถ</button>
        <button id="report" onclick="window.location.href='report.php'" class="btn btn-block btn-green">รายงานการจอง</button>
        <button id="approve" onclick="window.location.href='ap_manage.php'" class="btn btn-block btn-green">ผู้อนุมัติ</button>
      </div>
      <div class="col-10 p-5 row-height rside">
      <div class="dec text-center">
      <h4 class="mb-4">ข้อมูลพนักงานขับรถ</h4>
      </div>
        <div class="row">
        <?php
            $sql = "SELECT * FROM driver_table WHERE d_id != '1'";
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
            <?php echo $row["d_fname"], $row["d_lname"];?><br>
            <?php echo 'เบอร์โทร', $row["d_tel"];?><br>
            <?php echo 'สถานภาพ', ' : ' ,$row["d_status"];?> 
            </div>
          </div>
        </div><?php } ?>
        </div>
        <div class="editcar p-5 float-right">
        <button name="toadddriver" id="toadddriver" class="btn btn-success" href="#" type="button" data-toggle="modal" data-target=".add_drive" >เพิ่มข้อมูลพนักงาน</button>
        <button name="toeditcar" id="toeditcar" class="btn btn-warning" href="#" type="button" data-toggle="modal" data-target=".edit" onclick="return select()" >แก้ไขข้อมูล</button>
        <button name="toremovedriver" id="toremovedriver" class="btn btn-danger" href="#" type="button" data-toggle="modal" data-target=".remove_drive">ลบข้อมูล</button>
      </div>      
      <div class="modal fade add_drive" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                <label for="d_fname" class="col-form-label">ชื่อพนักงาน</label>
                <input type="text" class="form-control" id="d_fname">
                <label for="d_lname" class="col-form-label">นามสกุลพนักงาน</label>
                <input type="text" class="form-control" id="d_lname">
                <label for="d_tel" class="col-form-label">เบอร์โทรพนักงาน</label>
                <input type="text" class="form-control" id="d_tel">
                <select class="form-select btn-block text-center" aria-label="Default select example"  id="d_status" name="d_status">
                    <option  value="ทำงาน" selected>ทำงาน
                    </option> 
                    <option  value="พ้นสภาพ" selected>พ้นสภาพ
                    </option> 
                  </select>
              </div>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" name="add_drive" id="add_drive" class="btn btn-success" onclick="return add_drive()">เพิ่มข้อมูล</button>
          </div>
        </div>
      </div>  
  </div>
  <div class="modal fade remove_drive" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
            $sql = "SELECT * FROM driver_table";
            $result = $conn->query($sql);
        ?>
        
            <form>
              <div class="form-group">
              <label for="del_dri" class="col-form-label float-left">เลือกรายชื่อที่ต้องการลบ</label>
              <select class="form-select form-control" aria-label="Default select example"  id="d_fname2" name="d_fname2" >
              <?php 
                        $i = 0;
                        while($row = $result->fetch_assoc()){
                            $i++;
                        ?>
                    <option  value="<?php echo $row["d_id"];?>" selected>
                    <?php echo $row["d_fname"], " ", $row["d_lname"];?>
                    </option> 
                    <?php } ?>

              </select>
              </div>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" name="remove_drive" id="remove_drive" class="btn btn-danger" onclick="return remove_drive()">ลบข้อมูล</button>
          </div>
        </div>
      </div>
      </div>
      <div class="modal fade edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">แก้ไขข้อมูลพนักงานขับรถ</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
          <?php
            $sql = "SELECT * FROM driver_table";
            $result = $conn->query($sql);
        ?>
            <form>
              <div class="form-group">
              <label for="sel_dri" class="col-form-label float-left">เลือกรายชื่อที่ต้องการแก้ไข</label>
              <select class="form-select form-control" aria-label="Default select example"  id="d_id1" name="d_id1" onchange="return select()">
              <?php 
                        $i = 0;
                        while($row = $result->fetch_assoc()){
                            $i++;
                        ?>
                    <option   value="<?php echo $row["d_id"];?>" selected>
                        <?php echo $row["d_fname"];?>
                    </option> 
                    <?php } ?>
              </select>
              <label for="d_fname" class="col-form-label">ชื่อ</label>
                <input type="text" class="form-control" id="ed_fname" val="">
                <label for="d_lname" class="col-form-label">นามสกุล</label>
                <input type="text" class="form-control" id="ed_lname" val="">
                <label for="d_tel" class="col-form-label">เบอร์โทร</label>
                <input type="text" class="form-control" id="ed_tel" val="">
                <label for="d_status" class="col-form-label">สถานภาพ</label>
                <select class="form-select btn-block text-center" aria-label="Default select example"  id="ed_status" name="d_status">
                    <option  value="ทำงาน" selected>ทำงาน
                    </option> 
                    <option  value="พ้นสภาพ" selected>พ้นสภาพ
                    </option> 
                  </select>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" name="editcar" id="editcar" class="btn btn-warning" onclick="return editdriver()">แก้ไขข้อมูล</button>
          </div>
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

function add_drive(){
  $("#alert_login").hide();
            $.ajax({
                url: "Adddriver.php",
                type: "POST",
                dataType: "json",
                data: {
                    user: "insert",
                    d_fname: $("#d_fname").val(),
                    d_lname: $("#d_lname").val(),
                    d_tel: $("#d_tel").val(),
                    d_status: $("#d_status").val(),
                },
                success: function (response) {
                    alert("เพิ่มรถสำเร็จ!");
                    location.href = 'driver_info.php';
                }
            });
    }
  
  function remove_drive(){
  $("#alert_login").hide();
            $.ajax({
                url: "Removedriver.php",
                type: "POST",
                dataType: "json",
                data: {
                    user: "insert",
                    d_fname2: $("#d_fname2").val(),
                },
                success: function (response) {
                    alert("ลบรถสำเร็จ!");
                    location.href = 'driver_info.php';
                }
            });
    }
    function select(){
    $("#alert_login").hide();
            $.ajax({
                url: "editdriver_back.php",
                type: "GET",
                dataType: "json",
                data: { 
                    user: "select_driver",
                    d_id: $("#d_id1").val(),
                },
                success: function(response){
                console.log(response)
                $("#ed_fname").val(response.d_fname);
                $("#ed_lname").val(response.d_lname);
                $("#ed_tel").val(response.d_tel);
                $("#ed_status").val(response.d_status);
                }
            });
    }
    function editdriver(){
  $("#alert_login").hide();
            $.ajax({
                url: "editdriver_back.php",
                type: "POST",
                dataType: "json",
                data: {
                    user: "editdriver",
                    d_id: $("#d_id1").val(),
                    d_fname: $("#ed_fname").val(),
                    d_lname: $("#ed_lname").val(),
                    d_tel: $("#ed_tel").val(),
                    d_status: $("#ed_status").val(),
                },
                success: function (response) {
                    alert("แก้ไขสำเร็จ!");
                    location.href = 'driver_info.php';
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
  padding-top:2vw;
  padding-bottom:2vw;
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
  height:90vh;
}
</style>