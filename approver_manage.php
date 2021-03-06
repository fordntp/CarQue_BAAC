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
    <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">

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
    <button id="report" onclick="window.location.href='approver_home.php'" class="btn btn-block btn-green">รายงานการจอง</button>
        <button id="approve" onclick="window.location.href='approver_manage.php'" class="btn btn-block btn-green">การอนุมัติ</button>
      </div>
      <div class="col-10 p-5 row-height rside text-center">
      <h4 class="pb-4" style="color:black;">อนุมัติการจอง</h4>
      <table id="myTable" class="table table-bordered">
          <thead>
            <tr>
              <th>วัน</th>
              <th>เวลา</th>
              <th>สถานที่</th>
              <th>ปฏิบัติงาน</th>
              <th>ทะเบียนรถ</th>
              <th>ผู้ขับ</th>
              <th>ผู้จอง</th>
              <th>สถานะ</th>
            </tr>
          </thead>
          <?php
            $sql = "SELECT * FROM form_table";
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
              <td><?php echo $row["u_fname"];?></td>
              <td ><select  class="form-select 
              <?php if ($row["q_status"] === "อนุมัติ") {
                              if ($row["due_date"] < date("Y-m-d")){
                                echo "btn btn-success p-0 dropdown-toggle";
                              }
                              elseif($row["due_date"] === date("Y-m-d")){
                                if($row["time_end"] < date("H:I"))
                                  {
                                    echo "btn btn-success p-0 dropdown-toggle";
                                  }
                                elseif(date("H:I") >= $row["time_start"] and date("H:I") <= $row["time_end"]){
                                  echo "btn btn-secondary p-0 dropdown-toggle";
                                  }
                                else{
                                  echo "btn btn-primary p-0 dropdown-toggle";
                                  }
                              }
                              else{
                                echo "btn btn-primary p-0 dropdown-toggle";
                              }
                            } elseif ($row["q_status"] === "รออนุมัติ") {
                              echo "btn btn-warning p-0 dropdown-toggle";}
                              elseif ($row["q_status"] === "ไม่อนุมัติ") {
                                echo "btn btn-danger p-0 dropdown-toggle";}
                            ?>
              " aria-label="Default select example"  id="q_status<?php echo $row["form_id"];?>" name="q_status" <?php 
                      if ($row["q_status"] === "อนุมัติ") {
                        if ($row["due_date"] < date("Y-m-d")){
                          echo "disabled";
                        }
                        elseif($row["due_date"] === date("Y-m-d")){
                          if($row["time_end"] < date("H:I"))
                            {
                              echo "disabled";
                            }
                          elseif(date("H:I") >= $row["time_start"] and date("H:I") <= $row["time_end"]){
                            echo "disabled";
                            }
                          else{
                            echo "";
                            }
                        }
                        else{
                          echo "";
                        }
                      } else{
                        echo "";}
              ?>>
                  <option value="รอการอนุมัติ" selected>
                    <?php if ($row["q_status"] === "อนุมัติ") {
                              if ($row["due_date"] < date("Y-m-d")){
                                echo "<p style='color:green;'>เสร็จสิ้น </p>";
                              }
                              elseif($row["due_date"] === date("Y-m-d")){
                                if($row["time_end"] < date("H:I"))
                                  {
                                    echo "<p style='color:green;'>เสร็จสิ้น </p>";
                                  }
                                elseif(date("H:I") >= $row["time_start"] and date("H:I") <= $row["time_end"]){
                                  echo "กำลังดำเนินการ";
                                  }
                                else{
                                    echo $row["q_status"];
                                  }
                              }
                              else{
                                echo $row["q_status"];
                              }
                            } else {
                              echo $row["q_status"];
              }?></option>
                  <option  value="อนุมัติ">อนุมัติ</option>
                  <option value="ไม่อนุมัติ">ไม่อนุมัติ</option>
                  </select>
                </td>
            </tr>
            <?php } ?>
          </tbody>
      </table>
      <div class="modal-footer">
      <button class="btn btn-sm btn-success btn-block mt-4" onclick="return con_update()">บันทึก</button>
      </div>
      </div>
    </div>
</body>
</html>
  <script>
    function del() {
                            var r = confirm("คุณยืนยันจะลบข้อมูลหรือไม่ ?");
                            if(r == false){
                                return false;
                            }
                        }
    $(document).ready( function () {
    $('#myTable').DataTable();
} );
  for (let i = 1; i < 4; i++){
      let qs = "#q_status";
      let qs2 = qs.concat(1);
  function con_update() {
    alert("บันทึกสำเร็จ");
    $.ajax({
      url: "ap_manage_back.php",
      type: "POST",
      dataType: "json",
      data: {
            user: "edit",
            q_status1: $(qs2).val(),
            q_status2: $("#q_status2").val(),
            q_status3: $("#q_status3").val(),
            q_status4: $("#q_status4").val(),
            q_status5: $("#q_status5").val(),
            q_status6: $("#q_status6").val(),
            q_status7: $("#q_status7").val(),
            q_status8: $("#q_status8").val(),
            q_status9: $("#q_status9").val(),
            q_status10: $("#q_status10").val(),
            q_status11: $("#q_status11").val(),
            q_status12: $("#q_status12").val(),
            q_status13: $("#q_status13").val(),
            q_status14: $("#q_status14").val(),
            q_status15: $("#q_status15").val(),
            q_status16: $("#q_status16").val(),
            q_status17: $("#q_status17").val(),
            q_status18: $("#q_status18").val(),
            q_status19: $("#q_status19").val(),
            q_status20: $("#q_status20").val(),
            q_status21: $("#q_status21").val(),
            q_status22: $("#q_status22").val(),
            q_status23: $("#q_status23").val(),
            q_status24: $("#q_status24").val(),
            q_status25: $("#q_status25").val(),
            q_status26: $("#q_status26").val(),
            q_status27: $("#q_status27").val(),
            q_status28: $("#q_status28").val(),
            q_status29: $("#q_status29").val(),
            q_status30: $("#q_status30").val(),
            q_status31: $("#q_status31").val(),
            q_status32: $("#q_status32").val(),
            q_status33: $("#q_status33").val(),
            q_status34: $("#q_status34").val(),
            q_status35: $("#q_status35").val(),
            q_status36: $("#q_status36").val(),
            q_status37: $("#q_status37").val(),
            q_status38: $("#q_status38").val(),
            q_status39: $("#q_status39").val(),
            q_status40: $("#q_status40").val(),
            q_status41: $("#q_status41").val(),
            q_status42: $("#q_status42").val(),
            q_status43: $("#q_status43").val(),
            q_status44: $("#q_status44").val(),
            q_status45: $("#q_status45").val(),
            q_status46: $("#q_status46").val(),
            q_status47: $("#q_status47").val(),
            q_status48: $("#q_status48").val(),
            q_status49: $("#q_status49").val(),
            q_status50: $("#q_status50").val(),
            q_status51: $("#q_status51").val(),
            q_status52: $("#q_status52").val(),
            q_status53: $("#q_status53").val(),
            q_status54: $("#q_status54").val(),
            q_status55: $("#q_status55").val(),
            q_status56: $("#q_status56").val(),
            q_status57: $("#q_status57").val(),
            q_status58: $("#q_status58").val(),
            q_status59: $("#q_status59").val(),
            q_status60: $("#q_status60").val(),
            q_status61: $("#q_status61").val(),
            q_status62: $("#q_status62").val(),
            q_status63: $("#q_status63").val(),
            q_status64: $("#q_status64").val(),
            q_status65: $("#q_status65").val(),
            q_status66: $("#q_status66").val(),
            q_status67: $("#q_status67").val(),
            q_status68: $("#q_status68").val(),
            q_status69: $("#q_status69").val(),
            q_status70: $("#q_status70").val(),
            q_status71: $("#q_status71").val(),
            q_status72: $("#q_status72").val(),
            q_status73: $("#q_status73").val(),
            q_status74: $("#q_status74").val(),
            q_status75: $("#q_status75").val(),
            q_status76: $("#q_status76").val(),
            q_status77: $("#q_status77").val(),
            q_status78: $("#q_status78").val(),
            q_status79: $("#q_status79").val(),
            q_status80: $("#q_status80").val(),
            q_status81: $("#q_status81").val(),
            q_status82: $("#q_status82").val(),
            q_status83: $("#q_status83").val(),
            q_status84: $("#q_status84").val(),
            q_status85: $("#q_status85").val(),
            q_status86: $("#q_status86").val(),
            q_status87: $("#q_status87").val(),
            q_status88: $("#q_status88").val(),
            q_status89: $("#q_status89").val(),
            q_status90: $("#q_status90").val(),
            q_status91: $("#q_status91").val(),
            q_status92: $("#q_status92").val(),
            q_status93: $("#q_status93").val(),
            q_status94: $("#q_status94").val(),
            q_status95: $("#q_status95").val(),
            q_status96: $("#q_status96").val(),
            q_status97: $("#q_status97").val(),
            q_status98: $("#q_status98").val(),
            q_status99: $("#q_status99").val(),
            q_status100: $("#q_status100").val(),
            q_status101: $("#q_status101").val(),
            q_status102: $("#q_status102").val(),
            q_status103: $("#q_status103").val(),
            q_status104: $("#q_status104").val(),
            q_status105: $("#q_status105").val(),
            q_status106: $("#q_status106").val(),
            q_status107: $("#q_status107").val(),
            q_status108: $("#q_status108").val(),
            q_status109: $("#q_status109").val(),
            q_status110: $("#q_status110").val(),
            q_status111: $("#q_status111").val(),
            q_status112: $("#q_status112").val(),
            q_status113: $("#q_status113").val(),
            q_status114: $("#q_status114").val(),
            q_status115: $("#q_status115").val(),
            q_status116: $("#q_status116").val(),
            q_status117: $("#q_status117").val(),
            q_status118: $("#q_status118").val(),
            q_status119: $("#q_status119").val(),
            q_status120: $("#q_status120").val(),
            q_status121: $("#q_status121").val(),
            q_status122: $("#q_status122").val(),
            q_status123: $("#q_status123").val(),
            q_status124: $("#q_status124").val(),
            q_status125: $("#q_status125").val(),
            q_status126: $("#q_status126").val(),
            q_status127: $("#q_status127").val(),
            q_status128: $("#q_status128").val(),
            q_status129: $("#q_status129").val(),
            q_status130: $("#q_status130").val(),
            q_status131: $("#q_status131").val(),
            q_status132: $("#q_status132").val(),
            q_status133: $("#q_status133").val(),
            q_status134: $("#q_status134").val(),
            q_status135: $("#q_status135").val(),
            q_status136: $("#q_status136").val(),
            q_status137: $("#q_status137").val(),
            q_status138: $("#q_status138").val(),
            q_status139: $("#q_status139").val(),
            q_status140: $("#q_status140").val(),
            q_status141: $("#q_status141").val(),
            q_status142: $("#q_status142").val(),
            q_status143: $("#q_status143").val(),
            q_status144: $("#q_status144").val(),
            q_status145: $("#q_status145").val(),
            q_status146: $("#q_status146").val(),
            q_status147: $("#q_status147").val(),
            q_status148: $("#q_status148").val(),
            q_status149: $("#q_status149").val(),
            q_status150: $("#q_status150").val(),
            q_status151: $("#q_status151").val(),
            q_status152: $("#q_status152").val(),
            q_status153: $("#q_status153").val(),
            q_status154: $("#q_status154").val(),
            q_status155: $("#q_status155").val(),
            q_status156: $("#q_status156").val(),
            q_status157: $("#q_status157").val(),
            q_status158: $("#q_status158").val(),
            q_status159: $("#q_status159").val(),
            q_status160: $("#q_status160").val(),
            q_status161: $("#q_status161").val(),
            q_status162: $("#q_status162").val(),
            q_status163: $("#q_status163").val(),
            q_status164: $("#q_status164").val(),
            q_status165: $("#q_status165").val(),
            q_status166: $("#q_status166").val(),
            q_status167: $("#q_status167").val(),
            q_status168: $("#q_status168").val(),
            q_status169: $("#q_status169").val(),
            q_status170: $("#q_status170").val(),
            q_status171: $("#q_status171").val(),
            q_status172: $("#q_status172").val(),
            q_status173: $("#q_status173").val(),
            q_status174: $("#q_status174").val(),
            q_status175: $("#q_status175").val(),
            q_status176: $("#q_status176").val(),
            q_status177: $("#q_status177").val(),
            q_status178: $("#q_status178").val(),
            q_status179: $("#q_status179").val(),
            q_status180: $("#q_status180").val(),
            q_status181: $("#q_status181").val(),
            q_status182: $("#q_status182").val(),
            q_status183: $("#q_status183").val(),
            q_status184: $("#q_status184").val(),
            q_status185: $("#q_status185").val(),
            q_status186: $("#q_status186").val(),
            q_status187: $("#q_status187").val(),
            q_status188: $("#q_status188").val(),
            q_status189: $("#q_status189").val(),
            q_status190: $("#q_status190").val(),
            q_status191: $("#q_status191").val(),
            q_status192: $("#q_status192").val(),
            q_status193: $("#q_status193").val(),
            q_status194: $("#q_status194").val(),
            q_status195: $("#q_status195").val(),
            q_status196: $("#q_status196").val(),
            q_status197: $("#q_status197").val(),
            q_status198: $("#q_status198").val(),
            q_status199: $("#q_status199").val(),
            q_status200: $("#q_status200").val(),
            q_status201: $("#q_status201").val(),
            q_status202: $("#q_status202").val(),
            q_status203: $("#q_status203").val(),
            q_status204: $("#q_status204").val(),
            q_status205: $("#q_status205").val(),
            q_status206: $("#q_status206").val(),
            q_status207: $("#q_status207").val(),
            q_status208: $("#q_status208").val(),
            q_status209: $("#q_status209").val(),
            q_status210: $("#q_status210").val(),
            q_status211: $("#q_status211").val(),
            q_status212: $("#q_status212").val(),
            q_status213: $("#q_status213").val(),
            q_status214: $("#q_status214").val(),
            q_status215: $("#q_status215").val(),
            q_status216: $("#q_status216").val(),
            q_status217: $("#q_status217").val(),
            q_status218: $("#q_status218").val(),
            q_status219: $("#q_status219").val(),
            q_status220: $("#q_status220").val(),
            q_status221: $("#q_status221").val(),
            q_status222: $("#q_status222").val(),
            q_status223: $("#q_status223").val(),
            q_status224: $("#q_status224").val(),
            q_status225: $("#q_status225").val(),
            q_status226: $("#q_status226").val(),
            q_status227: $("#q_status227").val(),
            q_status228: $("#q_status228").val(),
            q_status229: $("#q_status229").val(),
            q_status230: $("#q_status230").val(),
            q_status231: $("#q_status231").val(),
            q_status232: $("#q_status232").val(),
            q_status233: $("#q_status233").val(),
            q_status234: $("#q_status234").val(),
            q_status235: $("#q_status235").val(),
            q_status236: $("#q_status236").val(),
            q_status237: $("#q_status237").val(),
            q_status238: $("#q_status238").val(),
            q_status239: $("#q_status239").val(),
            q_status240: $("#q_status240").val(),
            q_status241: $("#q_status241").val(),
            q_status242: $("#q_status242").val(),
            q_status243: $("#q_status243").val(),
            q_status244: $("#q_status244").val(),
            q_status245: $("#q_status245").val(),
            q_status246: $("#q_status246").val(),
            q_status247: $("#q_status247").val(),
            q_status248: $("#q_status248").val(),
            q_status249: $("#q_status249").val(),
            q_status250: $("#q_status250").val(),
            q_status251: $("#q_status251").val(),
            q_status252: $("#q_status252").val(),
            q_status253: $("#q_status253").val(),
            q_status254: $("#q_status254").val(),
            q_status255: $("#q_status255").val(),
            q_status256: $("#q_status256").val(),
            q_status257: $("#q_status257").val(),
            q_status258: $("#q_status258").val(),
            q_status259: $("#q_status259").val(),
            q_status260: $("#q_status260").val(),
            q_status261: $("#q_status261").val(),
            q_status262: $("#q_status262").val(),
            q_status263: $("#q_status263").val(),
            q_status264: $("#q_status264").val(),
            q_status265: $("#q_status265").val(),
            q_status266: $("#q_status266").val(),
            q_status267: $("#q_status267").val(),
            q_status268: $("#q_status268").val(),
            q_status269: $("#q_status269").val(),
            q_status270: $("#q_status270").val(),
            q_status271: $("#q_status271").val(),
            q_status272: $("#q_status272").val(),
            q_status273: $("#q_status273").val(),
            q_status274: $("#q_status274").val(),
            q_status275: $("#q_status275").val(),
            q_status276: $("#q_status276").val(),
            q_status277: $("#q_status277").val(),
            q_status278: $("#q_status278").val(),
            q_status279: $("#q_status279").val(),
            q_status280: $("#q_status280").val(),
            q_status281: $("#q_status281").val(),
            q_status282: $("#q_status282").val(),
            q_status283: $("#q_status283").val(),
            q_status284: $("#q_status284").val(),
            q_status285: $("#q_status285").val(),
            q_status286: $("#q_status286").val(),
            q_status287: $("#q_status287").val(),
            q_status288: $("#q_status288").val(),
            q_status289: $("#q_status289").val(),
            q_status290: $("#q_status290").val(),
            q_status291: $("#q_status291").val(),
            q_status292: $("#q_status292").val(),
            q_status293: $("#q_status293").val(),
            q_status294: $("#q_status294").val(),
            q_status295: $("#q_status295").val(),
            q_status296: $("#q_status296").val(),
            q_status297: $("#q_status297").val(),
            q_status298: $("#q_status298").val(),
            q_status299: $("#q_status299").val(),
            q_status300: $("#q_status300").val(),
            q_status301: $("#q_status301").val(),
            q_status302: $("#q_status302").val(),
            q_status303: $("#q_status303").val(),
            q_status304: $("#q_status304").val(),
            q_status305: $("#q_status305").val(),
            q_status306: $("#q_status306").val(),
            q_status307: $("#q_status307").val(),
            q_status308: $("#q_status308").val(),
            q_status309: $("#q_status309").val(),
            q_status310: $("#q_status310").val(),
            q_status311: $("#q_status311").val(),
            q_status312: $("#q_status312").val(),
            q_status313: $("#q_status313").val(),
            q_status314: $("#q_status314").val(),
            q_status315: $("#q_status315").val(),
            q_status316: $("#q_status316").val(),
            q_status317: $("#q_status317").val(),
            q_status318: $("#q_status318").val(),
            q_status319: $("#q_status319").val(),
            q_status320: $("#q_status320").val(),
            q_status321: $("#q_status321").val(),
            q_status322: $("#q_status322").val(),
            q_status323: $("#q_status323").val(),
            q_status324: $("#q_status324").val(),
            q_status325: $("#q_status325").val(),
            q_status326: $("#q_status326").val(),
            q_status327: $("#q_status327").val(),
            q_status328: $("#q_status328").val(),
            q_status329: $("#q_status329").val(),
            q_status330: $("#q_status330").val(),
            q_status331: $("#q_status331").val(),
            q_status332: $("#q_status332").val(),
            q_status333: $("#q_status333").val(),
            q_status334: $("#q_status334").val(),
            q_status335: $("#q_status335").val(),
            q_status336: $("#q_status336").val(),
            q_status337: $("#q_status337").val(),
            q_status338: $("#q_status338").val(),
            q_status339: $("#q_status339").val(),
            q_status340: $("#q_status340").val(),
            q_status341: $("#q_status341").val(),
            q_status342: $("#q_status342").val(),
            q_status343: $("#q_status343").val(),
            q_status344: $("#q_status344").val(),
            q_status345: $("#q_status345").val(),
            q_status346: $("#q_status346").val(),
            q_status347: $("#q_status347").val(),
            q_status348: $("#q_status348").val(),
            q_status349: $("#q_status349").val(),
            q_status350: $("#q_status350").val(),
            q_status351: $("#q_status351").val(),
            q_status352: $("#q_status352").val(),
            q_status353: $("#q_status353").val(),
            q_status354: $("#q_status354").val(),
            q_status355: $("#q_status355").val(),
            q_status356: $("#q_status356").val(),
            q_status357: $("#q_status357").val(),
            q_status358: $("#q_status358").val(),
            q_status359: $("#q_status359").val(),
            q_status360: $("#q_status360").val(),
            q_status361: $("#q_status361").val(),
            q_status362: $("#q_status362").val(),
            q_status363: $("#q_status363").val(),
            q_status364: $("#q_status364").val(),
            q_status365: $("#q_status365").val(),
            q_status366: $("#q_status366").val(),
            q_status367: $("#q_status367").val(),
            q_status368: $("#q_status368").val(),
            q_status369: $("#q_status369").val(),
            q_status370: $("#q_status370").val(),
            q_status371: $("#q_status371").val(),
            q_status372: $("#q_status372").val(),
            q_status373: $("#q_status373").val(),
            q_status374: $("#q_status374").val(),
            q_status375: $("#q_status375").val(),
            q_status376: $("#q_status376").val(),
            q_status377: $("#q_status377").val(),
            q_status378: $("#q_status378").val(),
            q_status379: $("#q_status379").val(),
            q_status380: $("#q_status380").val(),
            q_status381: $("#q_status381").val(),
            q_status382: $("#q_status382").val(),
            q_status383: $("#q_status383").val(),
            q_status384: $("#q_status384").val(),
            q_status385: $("#q_status385").val(),
            q_status386: $("#q_status386").val(),
            q_status387: $("#q_status387").val(),
            q_status388: $("#q_status388").val(),
            q_status389: $("#q_status389").val(),
            q_status390: $("#q_status390").val(),
            q_status391: $("#q_status391").val(),
            q_status392: $("#q_status392").val(),
            q_status393: $("#q_status393").val(),
            q_status394: $("#q_status394").val(),
            q_status395: $("#q_status395").val(),
            q_status396: $("#q_status396").val(),
            q_status397: $("#q_status397").val(),
            q_status398: $("#q_status398").val(),
            q_status399: $("#q_status399").val(),
            q_status400: $("#q_status400").val(),
            q_status401: $("#q_status401").val(),
            q_status402: $("#q_status402").val(),
            q_status403: $("#q_status403").val(),
            q_status404: $("#q_status404").val(),
            q_status405: $("#q_status405").val(),
            q_status406: $("#q_status406").val(),
            q_status407: $("#q_status407").val(),
            q_status408: $("#q_status408").val(),
            q_status409: $("#q_status409").val(),
            q_status410: $("#q_status410").val(),
            q_status411: $("#q_status411").val(),
            q_status412: $("#q_status412").val(),
            q_status413: $("#q_status413").val(),
            q_status414: $("#q_status414").val(),
            q_status415: $("#q_status415").val(),
            q_status416: $("#q_status416").val(),
            q_status417: $("#q_status417").val(),
            q_status418: $("#q_status418").val(),
            q_status419: $("#q_status419").val(),
            q_status420: $("#q_status420").val(),
            q_status421: $("#q_status421").val(),
            q_status422: $("#q_status422").val(),
            q_status423: $("#q_status423").val(),
            q_status424: $("#q_status424").val(),
            q_status425: $("#q_status425").val(),
            q_status426: $("#q_status426").val(),
            q_status427: $("#q_status427").val(),
            q_status428: $("#q_status428").val(),
            q_status429: $("#q_status429").val(),
            q_status430: $("#q_status430").val(),
            q_status431: $("#q_status431").val(),
            q_status432: $("#q_status432").val(),
            q_status433: $("#q_status433").val(),
            q_status434: $("#q_status434").val(),
            q_status435: $("#q_status435").val(),
            q_status436: $("#q_status436").val(),
            q_status437: $("#q_status437").val(),
            q_status438: $("#q_status438").val(),
            q_status439: $("#q_status439").val(),
            q_status440: $("#q_status440").val(),
            q_status441: $("#q_status441").val(),
            q_status442: $("#q_status442").val(),
            q_status443: $("#q_status443").val(),
            q_status444: $("#q_status444").val(),
            q_status445: $("#q_status445").val(),
            q_status446: $("#q_status446").val(),
            q_status447: $("#q_status447").val(),
            q_status448: $("#q_status448").val(),
            q_status449: $("#q_status449").val(),
            q_status450: $("#q_status450").val(),
            q_status451: $("#q_status451").val(),
            q_status452: $("#q_status452").val(),
            q_status453: $("#q_status453").val(),
            q_status454: $("#q_status454").val(),
            q_status455: $("#q_status455").val(),
            q_status456: $("#q_status456").val(),
            q_status457: $("#q_status457").val(),
            q_status458: $("#q_status458").val(),
            q_status459: $("#q_status459").val(),
            q_status460: $("#q_status460").val(),
            q_status461: $("#q_status461").val(),
            q_status462: $("#q_status462").val(),
            q_status463: $("#q_status463").val(),
            q_status464: $("#q_status464").val(),
            q_status465: $("#q_status465").val(),
            q_status466: $("#q_status466").val(),
            q_status467: $("#q_status467").val(),
            q_status468: $("#q_status468").val(),
            q_status469: $("#q_status469").val(),
            q_status470: $("#q_status470").val(),
            q_status471: $("#q_status471").val(),
            q_status472: $("#q_status472").val(),
            q_status473: $("#q_status473").val(),
            q_status474: $("#q_status474").val(),
            q_status475: $("#q_status475").val(),
            q_status476: $("#q_status476").val(),
            q_status477: $("#q_status477").val(),
            q_status478: $("#q_status478").val(),
            q_status479: $("#q_status479").val(),
            q_status480: $("#q_status480").val(),
            q_status481: $("#q_status481").val(),
            q_status482: $("#q_status482").val(),
            q_status483: $("#q_status483").val(),
            q_status484: $("#q_status484").val(),
            q_status485: $("#q_status485").val(),
            q_status486: $("#q_status486").val(),
            q_status487: $("#q_status487").val(),
            q_status488: $("#q_status488").val(),
            q_status489: $("#q_status489").val(),
            q_status490: $("#q_status490").val(),
            q_status491: $("#q_status491").val(),
            q_status492: $("#q_status492").val(),
            q_status493: $("#q_status493").val(),
            q_status494: $("#q_status494").val(),
            q_status495: $("#q_status495").val(),
            q_status496: $("#q_status496").val(),
            q_status497: $("#q_status497").val(),
            q_status498: $("#q_status498").val(),
            q_status499: $("#q_status499").val(),
            q_status500: $("#q_status500").val(),
            q_status501: $("#q_status501").val(),
            q_status502: $("#q_status502").val(),
            q_status503: $("#q_status503").val(),
            q_status504: $("#q_status504").val(),
            q_status505: $("#q_status505").val(),
            q_status506: $("#q_status506").val(),
            q_status507: $("#q_status507").val(),
            q_status508: $("#q_status508").val(),
            q_status509: $("#q_status509").val(),
            q_status510: $("#q_status510").val(),
            q_status511: $("#q_status511").val(),
            q_status512: $("#q_status512").val(),
            q_status513: $("#q_status513").val(),
            q_status514: $("#q_status514").val(),
            q_status515: $("#q_status515").val(),
            q_status516: $("#q_status516").val(),
            q_status517: $("#q_status517").val(),
            q_status518: $("#q_status518").val(),
            q_status519: $("#q_status519").val(),
            q_status520: $("#q_status520").val(),
            q_status521: $("#q_status521").val(),
            q_status522: $("#q_status522").val(),
            q_status523: $("#q_status523").val(),
            q_status524: $("#q_status524").val(),
            q_status525: $("#q_status525").val(),
            q_status526: $("#q_status526").val(),
            q_status527: $("#q_status527").val(),
            q_status528: $("#q_status528").val(),
            q_status529: $("#q_status529").val(),
            q_status530: $("#q_status530").val(),
            q_status531: $("#q_status531").val(),
            q_status532: $("#q_status532").val(),
            q_status533: $("#q_status533").val(),
            q_status534: $("#q_status534").val(),
            q_status535: $("#q_status535").val(),
            q_status536: $("#q_status536").val(),
            q_status537: $("#q_status537").val(),
            q_status538: $("#q_status538").val(),
            q_status539: $("#q_status539").val(),
            q_status540: $("#q_status540").val(),
            q_status541: $("#q_status541").val(),
            q_status542: $("#q_status542").val(),
            q_status543: $("#q_status543").val(),
            q_status544: $("#q_status544").val(),
            q_status545: $("#q_status545").val(),
            q_status546: $("#q_status546").val(),
            q_status547: $("#q_status547").val(),
            q_status548: $("#q_status548").val(),
            q_status549: $("#q_status549").val(),
            q_status550: $("#q_status550").val(),
            q_status551: $("#q_status551").val(),
            q_status552: $("#q_status552").val(),
            q_status553: $("#q_status553").val(),
            q_status554: $("#q_status554").val(),
            q_status555: $("#q_status555").val(),
            q_status556: $("#q_status556").val(),
            q_status557: $("#q_status557").val(),
            q_status558: $("#q_status558").val(),
            q_status559: $("#q_status559").val(),
            q_status560: $("#q_status560").val(),
            q_status561: $("#q_status561").val(),
            q_status562: $("#q_status562").val(),
            q_status563: $("#q_status563").val(),
            q_status564: $("#q_status564").val(),
            q_status565: $("#q_status565").val(),
            q_status566: $("#q_status566").val(),
            q_status567: $("#q_status567").val(),
            q_status568: $("#q_status568").val(),
            q_status569: $("#q_status569").val(),
            q_status570: $("#q_status570").val(),
            q_status571: $("#q_status571").val(),
            q_status572: $("#q_status572").val(),
            q_status573: $("#q_status573").val(),
            q_status574: $("#q_status574").val(),
            q_status575: $("#q_status575").val(),
            q_status576: $("#q_status576").val(),
            q_status577: $("#q_status577").val(),
            q_status578: $("#q_status578").val(),
            q_status579: $("#q_status579").val(),
            q_status580: $("#q_status580").val(),
            q_status581: $("#q_status581").val(),
            q_status582: $("#q_status582").val(),
            q_status583: $("#q_status583").val(),
            q_status584: $("#q_status584").val(),
            q_status585: $("#q_status585").val(),
            q_status586: $("#q_status586").val(),
            q_status587: $("#q_status587").val(),
            q_status588: $("#q_status588").val(),
            q_status589: $("#q_status589").val(),
            q_status590: $("#q_status590").val(),
            q_status591: $("#q_status591").val(),
            q_status592: $("#q_status592").val(),
            q_status593: $("#q_status593").val(),
            q_status594: $("#q_status594").val(),
            q_status595: $("#q_status595").val(),
            q_status596: $("#q_status596").val(),
            q_status597: $("#q_status597").val(),
            q_status598: $("#q_status598").val(),
            q_status599: $("#q_status599").val(),
            q_status600: $("#q_status600").val(),
            q_status601: $("#q_status601").val(),
            q_status602: $("#q_status602").val(),
            q_status603: $("#q_status603").val(),
            q_status604: $("#q_status604").val(),
            q_status605: $("#q_status605").val(),
            q_status606: $("#q_status606").val(),
            q_status607: $("#q_status607").val(),
            q_status608: $("#q_status608").val(),
            q_status609: $("#q_status609").val(),
            q_status610: $("#q_status610").val(),
            q_status611: $("#q_status611").val(),
            q_status612: $("#q_status612").val(),
            q_status613: $("#q_status613").val(),
            q_status614: $("#q_status614").val(),
            q_status615: $("#q_status615").val(),
            q_status616: $("#q_status616").val(),
            q_status617: $("#q_status617").val(),
            q_status618: $("#q_status618").val(),
            q_status619: $("#q_status619").val(),
            q_status620: $("#q_status620").val(),
            q_status621: $("#q_status621").val(),
            q_status622: $("#q_status622").val(),
            q_status623: $("#q_status623").val(),
            q_status624: $("#q_status624").val(),
            q_status625: $("#q_status625").val(),
            q_status626: $("#q_status626").val(),
            q_status627: $("#q_status627").val(),
            q_status628: $("#q_status628").val(),
            q_status629: $("#q_status629").val(),
            q_status630: $("#q_status630").val(),
            q_status631: $("#q_status631").val(),
            q_status632: $("#q_status632").val(),
            q_status633: $("#q_status633").val(),
            q_status634: $("#q_status634").val(),
            q_status635: $("#q_status635").val(),
            q_status636: $("#q_status636").val(),
            q_status637: $("#q_status637").val(),
            q_status638: $("#q_status638").val(),
            q_status639: $("#q_status639").val(),
            q_status640: $("#q_status640").val(),
            q_status641: $("#q_status641").val(),
            q_status642: $("#q_status642").val(),
            q_status643: $("#q_status643").val(),
            q_status644: $("#q_status644").val(),
            q_status645: $("#q_status645").val(),
            q_status646: $("#q_status646").val(),
            q_status647: $("#q_status647").val(),
            q_status648: $("#q_status648").val(),
            q_status649: $("#q_status649").val(),
            q_status650: $("#q_status650").val(),
            q_status651: $("#q_status651").val(),
            q_status652: $("#q_status652").val(),
            q_status653: $("#q_status653").val(),
            q_status654: $("#q_status654").val(),
            q_status655: $("#q_status655").val(),
            q_status656: $("#q_status656").val(),
            q_status657: $("#q_status657").val(),
            q_status658: $("#q_status658").val(),
            q_status659: $("#q_status659").val(),
            q_status660: $("#q_status660").val(),
            q_status661: $("#q_status661").val(),
            q_status662: $("#q_status662").val(),
            q_status663: $("#q_status663").val(),
            q_status664: $("#q_status664").val(),
            q_status665: $("#q_status665").val(),
            q_status666: $("#q_status666").val(),
            q_status667: $("#q_status667").val(),
            q_status668: $("#q_status668").val(),
            q_status669: $("#q_status669").val(),
            q_status670: $("#q_status670").val(),
            q_status671: $("#q_status671").val(),
            q_status672: $("#q_status672").val(),
            q_status673: $("#q_status673").val(),
            q_status674: $("#q_status674").val(),
            q_status675: $("#q_status675").val(),
            q_status676: $("#q_status676").val(),
            q_status677: $("#q_status677").val(),
            q_status678: $("#q_status678").val(),
            q_status679: $("#q_status679").val(),
            q_status680: $("#q_status680").val(),
            q_status681: $("#q_status681").val(),
            q_status682: $("#q_status682").val(),
            q_status683: $("#q_status683").val(),
            q_status684: $("#q_status684").val(),
            q_status685: $("#q_status685").val(),
            q_status686: $("#q_status686").val(),
            q_status687: $("#q_status687").val(),
            q_status688: $("#q_status688").val(),
            q_status689: $("#q_status689").val(),
            q_status690: $("#q_status690").val(),
            q_status691: $("#q_status691").val(),
            q_status692: $("#q_status692").val(),
            q_status693: $("#q_status693").val(),
            q_status694: $("#q_status694").val(),
            q_status695: $("#q_status695").val(),
            q_status696: $("#q_status696").val(),
            q_status697: $("#q_status697").val(),
            q_status698: $("#q_status698").val(),
            q_status699: $("#q_status699").val(),
            q_status700: $("#q_status700").val(),
            q_status701: $("#q_status701").val(),
            q_status702: $("#q_status702").val(),
            q_status703: $("#q_status703").val(),
            q_status704: $("#q_status704").val(),
            q_status705: $("#q_status705").val(),
            q_status706: $("#q_status706").val(),
            q_status707: $("#q_status707").val(),
            q_status708: $("#q_status708").val(),
            q_status709: $("#q_status709").val(),
            q_status710: $("#q_status710").val(),
            q_status711: $("#q_status711").val(),
            q_status712: $("#q_status712").val(),
            q_status713: $("#q_status713").val(),
            q_status714: $("#q_status714").val(),
            q_status715: $("#q_status715").val(),
            q_status716: $("#q_status716").val(),
            q_status717: $("#q_status717").val(),
            q_status718: $("#q_status718").val(),
            q_status719: $("#q_status719").val(),
            q_status720: $("#q_status720").val(),
            q_status721: $("#q_status721").val(),
            q_status722: $("#q_status722").val(),
            q_status723: $("#q_status723").val(),
            q_status724: $("#q_status724").val(),
            q_status725: $("#q_status725").val(),
            q_status726: $("#q_status726").val(),
            q_status727: $("#q_status727").val(),
            q_status728: $("#q_status728").val(),
            q_status729: $("#q_status729").val(),
            q_status730: $("#q_status730").val(),
            q_status731: $("#q_status731").val(),
            q_status732: $("#q_status732").val(),
            q_status733: $("#q_status733").val(),
            q_status734: $("#q_status734").val(),
            q_status735: $("#q_status735").val(),
            q_status736: $("#q_status736").val(),
            q_status737: $("#q_status737").val(),
            q_status738: $("#q_status738").val(),
            q_status739: $("#q_status739").val(),
            q_status740: $("#q_status740").val(),
            q_status741: $("#q_status741").val(),
            q_status742: $("#q_status742").val(),
            q_status743: $("#q_status743").val(),
            q_status744: $("#q_status744").val(),
            q_status745: $("#q_status745").val(),
            q_status746: $("#q_status746").val(),
            q_status747: $("#q_status747").val(),
            q_status748: $("#q_status748").val(),
            q_status749: $("#q_status749").val(),
            q_status750: $("#q_status750").val(),
            q_status751: $("#q_status751").val(),
            q_status752: $("#q_status752").val(),
            q_status753: $("#q_status753").val(),
            q_status754: $("#q_status754").val(),
            q_status755: $("#q_status755").val(),
            q_status756: $("#q_status756").val(),
            q_status757: $("#q_status757").val(),
            q_status758: $("#q_status758").val(),
            q_status759: $("#q_status759").val(),
            q_status760: $("#q_status760").val(),
            q_status761: $("#q_status761").val(),
            q_status762: $("#q_status762").val(),
            q_status763: $("#q_status763").val(),
            q_status764: $("#q_status764").val(),
            q_status765: $("#q_status765").val(),
            q_status766: $("#q_status766").val(),
            q_status767: $("#q_status767").val(),
            q_status768: $("#q_status768").val(),
            q_status769: $("#q_status769").val(),
            q_status770: $("#q_status770").val(),
            q_status771: $("#q_status771").val(),
            q_status772: $("#q_status772").val(),
            q_status773: $("#q_status773").val(),
            q_status774: $("#q_status774").val(),
            q_status775: $("#q_status775").val(),
            q_status776: $("#q_status776").val(),
            q_status777: $("#q_status777").val(),
            q_status778: $("#q_status778").val(),
            q_status779: $("#q_status779").val(),
            q_status780: $("#q_status780").val(),
            q_status781: $("#q_status781").val(),
            q_status782: $("#q_status782").val(),
            q_status783: $("#q_status783").val(),
            q_status784: $("#q_status784").val(),
            q_status785: $("#q_status785").val(),
            q_status786: $("#q_status786").val(),
            q_status787: $("#q_status787").val(),
            q_status788: $("#q_status788").val(),
            q_status789: $("#q_status789").val(),
            q_status790: $("#q_status790").val(),
            q_status791: $("#q_status791").val(),
            q_status792: $("#q_status792").val(),
            q_status793: $("#q_status793").val(),
            q_status794: $("#q_status794").val(),
            q_status795: $("#q_status795").val(),
            q_status796: $("#q_status796").val(),
            q_status797: $("#q_status797").val(),
            q_status798: $("#q_status798").val(),
            q_status799: $("#q_status799").val(),
            q_status800: $("#q_status800").val(),
            q_status801: $("#q_status801").val(),
            q_status802: $("#q_status802").val(),
            q_status803: $("#q_status803").val(),
            q_status804: $("#q_status804").val(),
            q_status805: $("#q_status805").val(),
            q_status806: $("#q_status806").val(),
            q_status807: $("#q_status807").val(),
            q_status808: $("#q_status808").val(),
            q_status809: $("#q_status809").val(),
            q_status810: $("#q_status810").val(),
            q_status811: $("#q_status811").val(),
            q_status812: $("#q_status812").val(),
            q_status813: $("#q_status813").val(),
            q_status814: $("#q_status814").val(),
            q_status815: $("#q_status815").val(),
            q_status816: $("#q_status816").val(),
            q_status817: $("#q_status817").val(),
            q_status818: $("#q_status818").val(),
            q_status819: $("#q_status819").val(),
            q_status820: $("#q_status820").val(),
            q_status821: $("#q_status821").val(),
            q_status822: $("#q_status822").val(),
            q_status823: $("#q_status823").val(),
            q_status824: $("#q_status824").val(),
            q_status825: $("#q_status825").val(),
            q_status826: $("#q_status826").val(),
            q_status827: $("#q_status827").val(),
            q_status828: $("#q_status828").val(),
            q_status829: $("#q_status829").val(),
            q_status830: $("#q_status830").val(),
            q_status831: $("#q_status831").val(),
            q_status832: $("#q_status832").val(),
            q_status833: $("#q_status833").val(),
            q_status834: $("#q_status834").val(),
            q_status835: $("#q_status835").val(),
            q_status836: $("#q_status836").val(),
            q_status837: $("#q_status837").val(),
            q_status838: $("#q_status838").val(),
            q_status839: $("#q_status839").val(),
            q_status840: $("#q_status840").val(),
            q_status841: $("#q_status841").val(),
            q_status842: $("#q_status842").val(),
            q_status843: $("#q_status843").val(),
            q_status844: $("#q_status844").val(),
            q_status845: $("#q_status845").val(),
            q_status846: $("#q_status846").val(),
            q_status847: $("#q_status847").val(),
            q_status848: $("#q_status848").val(),
            q_status849: $("#q_status849").val(),
            q_status850: $("#q_status850").val(),
            q_status851: $("#q_status851").val(),
            q_status852: $("#q_status852").val(),
            q_status853: $("#q_status853").val(),
            q_status854: $("#q_status854").val(),
            q_status855: $("#q_status855").val(),
            q_status856: $("#q_status856").val(),
            q_status857: $("#q_status857").val(),
            q_status858: $("#q_status858").val(),
            q_status859: $("#q_status859").val(),
            q_status860: $("#q_status860").val(),
            q_status861: $("#q_status861").val(),
            q_status862: $("#q_status862").val(),
            q_status863: $("#q_status863").val(),
            q_status864: $("#q_status864").val(),
            q_status865: $("#q_status865").val(),
            q_status866: $("#q_status866").val(),
            q_status867: $("#q_status867").val(),
            q_status868: $("#q_status868").val(),
            q_status869: $("#q_status869").val(),
            q_status870: $("#q_status870").val(),
            q_status871: $("#q_status871").val(),
            q_status872: $("#q_status872").val(),
            q_status873: $("#q_status873").val(),
            q_status874: $("#q_status874").val(),
            q_status875: $("#q_status875").val(),
            q_status876: $("#q_status876").val(),
            q_status877: $("#q_status877").val(),
            q_status878: $("#q_status878").val(),
            q_status879: $("#q_status879").val(),
            q_status880: $("#q_status880").val(),
            q_status881: $("#q_status881").val(),
            q_status882: $("#q_status882").val(),
            q_status883: $("#q_status883").val(),
            q_status884: $("#q_status884").val(),
            q_status885: $("#q_status885").val(),
            q_status886: $("#q_status886").val(),
            q_status887: $("#q_status887").val(),
            q_status888: $("#q_status888").val(),
            q_status889: $("#q_status889").val(),
            q_status890: $("#q_status890").val(),
            q_status891: $("#q_status891").val(),
            q_status892: $("#q_status892").val(),
            q_status893: $("#q_status893").val(),
            q_status894: $("#q_status894").val(),
            q_status895: $("#q_status895").val(),
            q_status896: $("#q_status896").val(),
            q_status897: $("#q_status897").val(),
            q_status898: $("#q_status898").val(),
            q_status899: $("#q_status899").val(),
            q_status900: $("#q_status900").val(),
            q_status901: $("#q_status901").val(),
            q_status902: $("#q_status902").val(),
            q_status903: $("#q_status903").val(),
            q_status904: $("#q_status904").val(),
            q_status905: $("#q_status905").val(),
            q_status906: $("#q_status906").val(),
            q_status907: $("#q_status907").val(),
            q_status908: $("#q_status908").val(),
            q_status909: $("#q_status909").val(),
            q_status910: $("#q_status910").val(),
            q_status911: $("#q_status911").val(),
            q_status912: $("#q_status912").val(),
            q_status913: $("#q_status913").val(),
            q_status914: $("#q_status914").val(),
            q_status915: $("#q_status915").val(),
            q_status916: $("#q_status916").val(),
            q_status917: $("#q_status917").val(),
            q_status918: $("#q_status918").val(),
            q_status919: $("#q_status919").val(),
            q_status920: $("#q_status920").val(),
            q_status921: $("#q_status921").val(),
            q_status922: $("#q_status922").val(),
            q_status923: $("#q_status923").val(),
            q_status924: $("#q_status924").val(),
            q_status925: $("#q_status925").val(),
            q_status926: $("#q_status926").val(),
            q_status927: $("#q_status927").val(),
            q_status928: $("#q_status928").val(),
            q_status929: $("#q_status929").val(),
            q_status930: $("#q_status930").val(),
            q_status931: $("#q_status931").val(),
            q_status932: $("#q_status932").val(),
            q_status933: $("#q_status933").val(),
            q_status934: $("#q_status934").val(),
            q_status935: $("#q_status935").val(),
            q_status936: $("#q_status936").val(),
            q_status937: $("#q_status937").val(),
            q_status938: $("#q_status938").val(),
            q_status939: $("#q_status939").val(),
            q_status940: $("#q_status940").val(),
            q_status941: $("#q_status941").val(),
            q_status942: $("#q_status942").val(),
            q_status943: $("#q_status943").val(),
            q_status944: $("#q_status944").val(),
            q_status945: $("#q_status945").val(),
            q_status946: $("#q_status946").val(),
            q_status947: $("#q_status947").val(),
            q_status948: $("#q_status948").val(),
            q_status949: $("#q_status949").val(),
            q_status950: $("#q_status950").val(),
            q_status951: $("#q_status951").val(),
            q_status952: $("#q_status952").val(),
            q_status953: $("#q_status953").val(),
            q_status954: $("#q_status954").val(),
            q_status955: $("#q_status955").val(),
            q_status956: $("#q_status956").val(),
            q_status957: $("#q_status957").val(),
            q_status958: $("#q_status958").val(),
            q_status959: $("#q_status959").val(),
            q_status960: $("#q_status960").val(),
            q_status961: $("#q_status961").val(),
            q_status962: $("#q_status962").val(),
            q_status963: $("#q_status963").val(),
            q_status964: $("#q_status964").val(),
            q_status965: $("#q_status965").val(),
            q_status966: $("#q_status966").val(),
            q_status967: $("#q_status967").val(),
            q_status968: $("#q_status968").val(),
            q_status969: $("#q_status969").val(),
            q_status970: $("#q_status970").val(),
            q_status971: $("#q_status971").val(),
            q_status972: $("#q_status972").val(),
            q_status973: $("#q_status973").val(),
            q_status974: $("#q_status974").val(),
            q_status975: $("#q_status975").val(),
            q_status976: $("#q_status976").val(),
            q_status977: $("#q_status977").val(),
            q_status978: $("#q_status978").val(),
            q_status979: $("#q_status979").val(),
            q_status980: $("#q_status980").val(),
            q_status981: $("#q_status981").val(),
            q_status982: $("#q_status982").val(),
            q_status983: $("#q_status983").val(),
            q_status984: $("#q_status984").val(),
            q_status985: $("#q_status985").val(),
            q_status986: $("#q_status986").val(),
            q_status987: $("#q_status987").val(),
            q_status988: $("#q_status988").val(),
            q_status989: $("#q_status989").val(),
            q_status990: $("#q_status990").val(),
            q_status991: $("#q_status991").val(),
            q_status992: $("#q_status992").val(),
            q_status993: $("#q_status993").val(),
            q_status994: $("#q_status994").val(),
            q_status995: $("#q_status995").val(),
            q_status996: $("#q_status996").val(),
            q_status997: $("#q_status997").val(),
            q_status998: $("#q_status998").val(),
            q_status999: $("#q_status999").val(),
            form_id: $("#form_id").val(),
      },error: function (response) {
                    location.href = 'approver_manage.php';
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
.table{
  color:#000;
  font-size:0.8rem;
}
#lside{
  height: 120vh;
  background-color: #d0d0d0;
}
#as1{
  background-color:green;}
</style>