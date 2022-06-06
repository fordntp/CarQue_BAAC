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
      <div class="col-10 p-5 row-height rside ">
        <h4 class="pb-4" style="color:black;">การจองของคุณ<?php echo $_SESSION["u_fname"]?></h4>
      <table id="myTable" class="table table-bordered">
          <thead>
            <tr>
              <th>วัน</th>
              <th>เวลา</th>
              <th>สถานที่</th>
              <th>ปฏิบัติงาน</th>
              <th>ทะเบียนรถ</th>
              <th>ผู้ขับ</th>
              <th>สถานะ</th>
              <th>การจัดการ</th>

            </tr>
          </thead>
          <?php
            $sql = "SELECT * FROM form_table  WHERE uc_name = '$_SESSION[u_name]'";
            $result = $conn->query($sql);
        ?>
          <tbody>
          <?php 
            $i = 0;
            while($row = $result->fetch_assoc()){
                $i++;
            ?>
            <tr>
              <td><?php echo $row["due_date"];?></td>
              <td><?php echo $row["time_start"];?></td>
              <td><?php echo $row["workplace"];?></td>
              <td ><?php echo $row["work_title"];?></td>
              <td ><?php echo $row["car_num"];?></td>
              <td ><?php echo $row["d_fname"];?></td>
              <td class="text-center" id="st"><?php
              if ($row["q_status"] === "อนุมัติ") {
                if ($row["due_date"] < date("Y-m-d")){
                  echo "<p style='color:white;background-color:#22B63B;'>เสร็จสิ้น </p>";
                }
                elseif($row["due_date"] === date("Y-m-d")){
                  if($row["time_end"] < date("H:I"))
                    {
                      echo "<p style='color:white;background-color:#22B63B;'>เสร็จสิ้น </p>";
                    }
                  elseif(date("H:I") >= $row["time_start"] and date("H:I") <= $row["time_end"]){
                    echo "<p style='color:white;background-color:gray;'>กำลังดำเนินการ </p>";
                    }
                  else{
                      echo "<p style='color:white;background-color:#3A51BB;'> $row[q_status] </p>" ;
                    }
                }
                else{
                  echo "<p style='color:white;background-color:#3A51BB;'> $row[q_status] </p>";
                }
              } elseif ($row["q_status"] === "รออนุมัติ") {
                echo "<p style='color:white;background-color:#F1C23C;'> $row[q_status] </p>"; }
                elseif ($row["q_status"] === "ไม่อนุมัติ") {
                  echo "<p style='color:white;background-color:#DB4747;'> $row[q_status] </p>";}
              ?></td>
              <td class="text-center"><a type="button" class="btn btn-warning" data-toggle="modal" data-target="#modaledit" style="<?php if ($row["q_status"] === "อนุมัติ") {
                              if ($row["due_date"] < date("Y-m-d")){
                                echo "background-color:grey;font-size:1vw;border-color:grey; pointer-events: none; ";
                              }
                              elseif($row["due_date"] === date("Y-m-d")){
                                if($row["time_end"] < date("H:I"))
                                  {
                                    echo "background-color:grey;font-size:1vw;border-color:grey; pointer-events: none; ";
                                  }
                                elseif(date("H:I") >= $row["time_start"] and date("H:I") <= $row["time_end"]){
                                  echo "background-color:grey;font-size:1vw;border-color:grey; pointer-events: none; ";
                                  }
                                else{
                                    echo "font-size:0.1vw;";
                                  }
                              }
                              else{
                                echo "font-size:1vw;";
                              }
                            } else {
                              echo "font-size:1vw;";
              }?>" onclick="select(<?php echo intval($row['form_id']);?>)">แก้ไข</a>
</td>
</tr>
            <?php } ?>
          </tbody>
      </table>
      <div class="modal-footer">
      </div>
      <div class="modal fade" id="modaledit" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 style="font-weight: bold;" class="modal-title" id="exampleModalLongTitle">แก้ไขการจอง</h5>
                <button type="button" class="close" data-dismiss="modal" id= "x-close" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <div class="modal-body">
        <div class="container-fluid">
        <div class="form-row">
    <div class="form-group col-md-6"  style="font-size:1vw; float:left;">
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
      <div class="form-group col-md-6" style="font-size:1vw; float:left;">
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
          <option value="01:00">01:00</option>
          <option value="02:00">02:00</option>
          <option value="03:00">03:00</option>
          <option value="04:00">04:00</option>
          <option value="05:00">05:00</option>
          <option value="06:00">06:00</option>
          <option value="07:00">07:00</option>
          <option value="08:00">08:00</option>
          <option value="09:00">09:00</option>
          <option value="10:00">10:00</option>
          <option value="11:00">11:00</option>
          <option value="12:00">12:00</option>
          <option value="13:00">13:00</option>
          <option value="14:00">14:00</option>
          <option value="15:00">15:00</option>
          <option value="16:00">16:00</option>
          <option value="17:00">17:00</option>
          <option value="18:00">18:00</option>
          <option value="19:00">19:00</option>
          <option value="20:00">20:00</option>
          <option value="21:00">21:00</option>
          <option value="22:00">22:00</option>
          <option value="23:00">23:00</option>
        </select>
        </form>
    </div>
    <div class="form-group col-md-6">
      <label for=time_end>เวลา กลับเดินทาง</label>
      <select class="form-select form-control" aria-label="Default select example"  id="time_end" name="time_end">
        <option value="00:00" selected>00:00</option>
        <option value="01:00">01:00</option>
        <option value="02:00">02:00</option>
        <option value="03:00">03:00</option>
        <option value="04:00">04:00</option>
        <option value="05:00">05:00</option>
        <option value="06:00">06:00</option>
        <option value="07:00">07:00</option>
        <option value="08:00">08:00</option>
        <option value="09:00">09:00</option>
        <option value="10:00">10:00</option>
        <option value="11:00">11:00</option>
        <option value="12:00">12:00</option>
        <option value="13:00">13:00</option>
        <option value="14:00">14:00</option>
        <option value="15:00">15:00</option>
        <option value="16:00">16:00</option>
        <option value="17:00">17:00</option>
        <option value="18:00">18:00</option>
        <option value="19:00">19:00</option>
        <option value="20:00">20:00</option>
        <option value="21:00">21:00</option>
        <option value="22:00">22:00</option>
        <option value="23:00">23:00</option>
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
          <option  value="สาขาเมืองสุราษฎร์" ></option> 
          <option  value="สาขาไชยา" ></option> 
          <option  value="สาขาพนม" ></option> 
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
    <input id="form_id" value="" hidden>

  </div>
        <div class="modal-footer">
        <a name="removecar" href="ap_manage_back.php?user=del&form_id=<?php echo intval($row['form_id']);?>" class="btn btn-danger" style="<?php if ($row["q_status"] === "อนุมัติ") {
                              if ($row["due_date"] < date("Y-m-d")){
                                echo "background-color:grey;font-size:0.7vw;border-color:grey; pointer-events: none; ";
                              }
                              elseif($row["due_date"] === date("Y-m-d")){
                                if($row["time_end"] < date("H:I"))
                                  {
                                    echo "background-color:grey;font-size:0.7vw;border-color:grey; pointer-events: none; ";
                                  }
                                elseif(date("H:I") >= $row["time_start"] and date("H:I") <= $row["time_end"]){
                                  echo "background-color:grey;font-size:0.7vw;border-color:grey; pointer-events: none; ";
                                  }
                                else{
                                    echo "font-size:1vw;";
                                  }
                              }
                              else{
                                echo "font-size:1vw;";
                              }
                            } else {
                              echo "font-size:1vw;";
              }?>" onclick="return del()" >ยกเลิกการจอง
</a>            <button type="submit" id="confirm_edit" onclick="confirm_edit(<?php echo intval($row['form_id']);?>)" class="btn btn-primary">บันทึก</button>
        </div>
        </div>
    </div>
</div>
      </div>
    </div>
</body>
</html>
<script>
    function confirm_edit(data){
  $("#alert_login").hide();
            $.ajax({
                url: "ap_manage_back.php",
                type: "POST",
                dataType: "json",
                data: {
                  user: "updateform1",
                    form_id: $("#form_id").val(),
                    u_fname: $("#u_fname").val(),
                    u_tel: $("#u_tel").val(),
                    datepicker: $("#datepicker").val(),
                    time_start: $("#time_start").val(),
                    time_end: $("#time_end").val(),
                    work_title: $("#work_title").val(),
                    workplace: $("#workplace").val(),
                    num_worker: $("#num_worker").val(),
                },
                success: function (response) {
                    alert("แก้ไขสำเร็จ!");
                    location.href = 'home.php';
                }
            });
    }
    function select(data) {
    $("#confirm_insert").hide();
    $.ajax({
        url: "ap_manage_back.php",
        type: "GET",
        dataType: "json",
        data: { 
            user: "select_edit1",
            form_id: data
        },
        success: function(response){
            console.log(response)
            $("#form_id").val(response.form_id);
            $("#u_fname").val(response.u_fname);
            $("#u_tel").val(response.u_tel);
            $("#datepicker").val(response.datepicker);
            $("#time_start").val(response.time_start);
            $("#time_end").val(response.time_end);
            $("#work_title").val(response.work_title);
            $("#workplace").val(response.workplace);
            $("#num_worker").val(response.num_worker);
            $("#u_name").val(response.u_name);

          }
    }) 
}
    function del() {
                            var r = confirm("คุณยืนยันจะลบข้อมูลหรือไม่ ?");
                            if(r == false){
                                return false;
                            }
                        }
  $(document).ready( function () {
      $('#myTable').DataTable();
  } );
</script>
<style>
.dataTables_info{
  font-size: 1vw;
}
.table, .dataTables_length, .dataTables_filter, .paginate_button{
  font-size:1.2vw;
}
body{
  background-color:#fff;
  font-family: 'Kanit', sans-serif;
  font-size:1vw;
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
#lside{
  height: 120vh;
  background-color: #d0d0d0;
}

</style>