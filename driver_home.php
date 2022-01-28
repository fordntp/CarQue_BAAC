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
            <h5 class="p-3">ระบบจองยานพาหนะ<br> สำนักงาน ธ.ก.ส.จังหวัดสุราษฎร์ธานี</h5>
            </ul>
            <ul class="nav navbar-nav navbar-right">
            <li id="ic" onclick="window.location.href='report.php'" ><img src="img/house-fill.svg" width="50px" height="50px"/></li>
                <li id="ic" onclick="window.location.href=href='check_logout.php?user_logout'"  class="pl-4"><img src="img/box-arrow-right.svg" width="50px" height="50px"/></li>
            </ul>
    </nav>
    <!--Navbar End-->
    <div class="row row-height">
      <div class="col-12 p-5 row-height rside text-center">
      <h4 class="pb-4" style="color:black;">ตารางการขับรถของ <?php echo $_SESSION["u_fname"]?></h4>
      <table id="myTable" class="table table-bordered">
          <thead>
            <tr>
              <th>วัน</th>
              <th>เวลา</th>
              <th>สถานที่</th>
              <th>ปฏิบัติงาน</th>
              <th>ทะเบียนรถ</th>
              <th>ผู้จอง</th>
              <th>เบอร์โทรผู้จอง</th>
              <th>สถานะ</th>

            </tr>
          </thead>
          <?php
            $sql = "SELECT * FROM form_table where d_fname = '$_SESSION[u_fname]' and q_status = 'อนุมัติ'";
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
              <td><?php echo $row["u_fname"];?></td>
              <td><?php echo $row["u_tel"];?></td>
              <td><?php
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