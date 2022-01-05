<?php
include ('connect.php');
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
    <script src="http://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js" ></script>
    <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@200&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.17/css/bootstrap-select.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.17/js/bootstrap-select.min.js"></script>  
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  </head>
<body>
<nav class="navbar navbar-expand m-0 sticky-top bg-green">
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
            <ul class="nav navbar-nav navbar-right mt-3">
            <li id="ic" onclick="window.location.href='report.php'" ><img src="img/house-fill.svg" width="50px" height="50px"/></li>
                <li id="ic" onclick="window.location.href=href='check_logout.php?user_logout'"  class="pl-4"><img src="img/box-arrow-right.svg" width="50px" height="50px"/></li>
            </ul>
    </nav>
    <!--Navbar End-->
    <div class="row row-height">
    <div id="lside" class="col-2  p-4 col-auto row-height d-flex justify-content-start flex-column lside">
      <button  id="car_info" onclick="window.location.href='employees.php'" class="btn m-2 btn-block btn-green">ข้อมูลพนักงานทั้งหมด</button>
        <button id="car_info" onclick="window.location.href='car_info.php'" class="btn m-2 btn-block btn-green">ข้อมูลรถยนต์</button>
        <button id="driver_info" onclick="window.location.href='driver_info.php'" class="btn m-2 btn-block btn-green">ข้อมูลพนักงานขับรถ</button>
        <button id="report" onclick="window.location.href='report.php'" class="btn btn-block m-2 btn-green">รายงานการจอง</button>
        <button id="approve" onclick="window.location.href='ap_manage.php'" class="btn btn-block m-2 btn-green">ผู้อนุมัติ</button>
      </div>
      <div class="col-10 p-5 row-height rside text-center">
      <h4 class="pb-4" style="color:black;">รายงานการจอง</h4>
      <table id="myTable" class="table table-bordered text-center">
          <thead>
            <tr>
              <th class="text-center">ชื่อ</th>
              <th class="text-center">ตำแหน่ง</th>
              <th class="text-center">เบอร์โทร</th>
              <th class="text-center">สถานะ</th>
            </tr>
          </thead>
          <?php
            $sql = "SELECT * FROM emp_table";
            $result = $conn->query($sql);
        ?>
          <tbody>
          <?php 
            $i = 0;
            while($row = $result->fetch_assoc()){
                $i++;
            ?>
            <tr>
              <td><?php echo $row["emp_fname"], '  ' ,$row["emp_lname"];?></td>
              <td><?php echo $row["job_title"];?></td>
              <td><?php echo $row["emp_tel"];?></td>
              <td>
              <?php echo $row["emp_po_name"];?>
              </td>
            </tr>
            <?php } ?>
          </tbody>
      </table>
      <div class="editcar p-5 float-right">
        <button name="toaddemp" id="toaddemp" class="btn btn-success" href="#" type="button" data-toggle="modal" data-target=".add" >เพิ่มข้อมูล</button>
        <button name="toeditemp" id="toeditemp" class="btn btn-warning" href="#" type="button" data-toggle="modal" data-target=".edit" onclick="return selectemp()" >แก้ไขข้อมูล</button>
        <button name="toremoveemp" id="toremoveemp" class="btn btn-danger" href="#" type="button" data-toggle="modal" data-target=".remove">ลบข้อมูล</button>
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
          <?php
            $sql = "SELECT * FROM position_table";
            $result = $conn->query($sql);
        ?>
            <form>
              <div class="form-group">
                <label for="emp_fname" class="col-form-label float-left">ชื่อ</label>
                <input type="text" class="form-control" id="emp_fname">
                <label for="emp_lname" class="col-form-label float-left">นามสกุล</label>
                <input type="text" class="form-control" id="emp_lname">
                <label for="emp_tel" class="col-form-label float-left">เบอร์โทร</label>
                <input type="text" class="form-control" id="emp_tel">
                <label for="job_title" class="col-form-label float-left">ตำแหน่ง</label>
                <input type="text" class="form-control" id="job_title">
                <label for="emp_po_name" class="col-form-label float-left">สถานะ</label><br>
                <select class="form-select btn-block text-center" aria-label="Default select example"  id="emp_po_name" name="emp_po_name">
                <?php 
                        $i = 0;
                        while($row = $result->fetch_assoc()){
                            $i++;
                        ?>
                    <option  value="<?php echo $row["po_title"];?>" selected>
                        <?php echo $row["po_title"];?>
                    </option> 
                    <?php } ?>
                  </select>
              </div>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" name="addcar" id="addcar" class="btn btn-success" onclick="return addemp()">เพิ่มข้อมูล</button>
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
            $sql = "SELECT * FROM emp_table";
            $result = $conn->query($sql);
        ?>
            <form>
              <div class="form-group">
              <label for="del_emp" class="col-form-label float-left">เลือกรายชื่อที่ต้องการลบ</label>
              <select class="selectpicker form-select form-control" aria-label="Default select example"  id="emp_select_name" name="emp_select_name" data-live-search="true" >
              
              <?php 
                        $i = 0;
                        while($row = $result->fetch_assoc()){
                            $i++;
                        ?>
                    <option value="<?php echo $row["emp_id"];?>" selected>
                        <?php echo $row["emp_fname"] , ' ' , $row["emp_lname"];?>
                    </option> 
                    <?php } ?>
              </select>
              </div>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" name="removecar" id="removecar" class="btn btn-danger" onclick="return removeemp()">ลบข้อมูล</button>
          </div>
        </div>
      </div>
      </div>
      <div class="modal fade edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">แก้ไขข้อมูลรถ</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
          <?php
            $sql = "SELECT * FROM emp_table";
            $result = $conn->query($sql);
            $sql2 = "SELECT * FROM position_table";
            $result2 = $conn->query($sql2);
        ?>
            <form>
              <div class="form-group">
              <label for="sel_emp" class="col-form-label float-left">เลือกรายชื่อที่ต้องการแก้ไข</label>
              <select class="selectpicker form-select form-control" aria-label="Default select example"  id="emp_edit" name="emp_edit" data-live-search="true" onchange="return selectemp()">
              <?php 
                        $i = 0;
                        while($row = $result->fetch_assoc()){
                            $i++;
                        ?>
                    <option   value="<?php echo $row["emp_id"];?>" selected>
                        <?php echo $row["emp_fname"] , ' ' , $row["emp_lname"];?>
                    </option> 
                    <?php } ?>
              </select>
                <label for="edemp_fname" class="col-form-label float-left">ชื่อ</label>
                <input type="text" class="form-control" id="edemp_fname">
                <label for="edemp_lname" class="col-form-label float-left">นามสกุล</label>
                <input type="text" class="form-control" id="edemp_lname">
                <label for="edemp_tel" class="col-form-label float-left">เบอร์โทร</label>
                <input type="text" class="form-control" id="edemp_tel">
                <label for="edjob_title" class="col-form-label float-left">ตำแหน่ง</label>
                <input type="text" class="form-control" id="edjob_title">
                <label for="edemp_po_name" class="col-form-label float-left">สถานะ</label><br>
                <select class="form-select btn-block text-center" aria-label="Default select example"  id="edemp_po_name" name="edemp_po_name">
                <?php 
                        $i = 0;
                        while($row2 = $result2->fetch_assoc()){
                            $i++;
                        ?>
                    <option  value="<?php echo $row2["po_title"];?>" selected>
                        <?php echo $row2["po_title"];?>
                    </option> 
                    <?php } ?>
                  </select>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" name="editcar" id="editcar" class="btn btn-warning" onclick="return editemp()">แก้ไขข้อมูล</button>
          </div>
        </div>
      </div>
      </div>
      </div>
    </div>
</body>
</html>
<script>
  $(function() {
  $('.selectpicker').selectpicker();
});
  $(document).ready( function () {
      $('#myTable').DataTable();
  } );
  function addemp(){
  $("#alert_login").hide();
            $.ajax({
                url: "employees_back.php",
                type: "POST",
                dataType: "json",
                data: {
                    user: "addemp",
                    emp_fname: $("#emp_fname").val(),
                    emp_lname: $("#emp_lname").val(),
                    emp_tel: $("#emp_tel").val(),
                    job_title: $("#job_title").val(),
                    emp_po_name: $("#emp_po_name").val(),
                },
                success: function (response) {
                    alert("เพิ่มข้อมูลพนักงานสำเร็จ!");
                    location.href = 'employees.php';
                }
            });
    }
    function removeemp(){
  $("#alert_login").hide();
            $.ajax({
                url: "employees_back.php",
                type: "POST",
                dataType: "json",
                data: {
                    user: "removeemp",
                    emp_select_name: $("#emp_select_name").val(),
                },
                success: function (response) {
                    alert("ลบข้อมูลพนักงานสำเร็จ!");
                    location.href = 'employees.php';
                }
            });
    }
    function selectemp(){
    $("#alert_login").hide();
            $.ajax({
                url: "editemp.php",
                type: "GET",
                dataType: "json",
                data: { 
                    user: "selectemp",
                    emp_edit: $("#emp_edit").val(),
                },
                success: function(response){
                console.log(response)
                $("#edemp_fname").val(response.emp_fname);
                $("#edemp_lname").val(response.emp_lname);
                $("#edemp_tel").val(response.emp_tel);
                $("#edjob_title").val(response.job_title);
                $("#edemp_po_name").val(response.emp_po_name);
                }
            });
    }
    function editemp(){
  $("#alert_login").hide();
            $.ajax({
                url: "editemp.php",
                type: "POST",
                dataType: "json",
                data: {
                    user: "editemp",
                    emp_edit: $("#emp_edit").val(),
                    edemp_fname: $("#edemp_fname").val(),
                    edemp_lname: $("#edemp_lname").val(),
                    edemp_tel: $("#edemp_tel").val(),
                    edjob_title: $("#edjob_title").val(),
                    edemp_po_name: $("#edemp_po_name").val(),
                },
                success: function (response) {
                    alert("แก้ไขสำเร็จ!");
                    location.href = 'employees.php';
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