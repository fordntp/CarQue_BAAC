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
      <div class="col-10 p-5 row-height rside text-center">
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
              <td><?php echo $row["work_title"];?></td>
              <td><?php echo $row["car_num"];?></td>
              <td><?php echo $row["d_fname"];?></td>
              <td id="st"><?php echo $row["q_status"];?></td>
            </tr>
            <?php } ?>
          </tbody>
      </table>
      </div>
    </div>
</body>
</html>
<script>
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
  font-size:1.5rem;
  color: #fff;
  overflow-y: hidden;
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
#lside{
  height: 100vh;
  background-color: #d0d0d0;
}

</style>