
  <?php 
      include_once '../config/config.php';
      $cnf=new Config();
      $rootPath=$cnf->path;
      $roomNo=isset($_GET["roomNo"])?$_GET["roomNo"]:"";
      echo "<input type='hidden' id='link_RoomNo' value='".$roomNo."''>";
  ?>

  <section class="content-header">
     <h1>
        <b>ระบบจองห้อง</b>
        <small>>>ปฏิทินการใช้ห้อง</small>
      </h1>
      <ol class="breadcrumb">
   
        <!--<input type="button" id="btnBack"  class="btn btn-primary"  value="ย้อนกลับ">-->


      </ol>
    </section>

  <section class="content container-fluid">

  <div class="box">
  <div class="box box-primary">

  <div class="box-body no-padding">
  <div>&nbsp;</div>
  <div class="col-sm-12">

    <div class="col-sm-1"><label>ห้อง :</label> </div>
    <div class="col-sm-2">
      <select id="obj_Room" class="form-control"></select>
    </div>
    <div class="col-sm-1"><label>วันที่ :</label>
    </div>
    <div class="col-sm-2">
           <input type="date" id="obj_bDate" class="form-control" value="<?=date('Y-m-d')?>" >

    </div>
    <div class="col-sm-1">
      <a href='#' id="obj_display" class="btn btn-primary">
        <i class="fa fa-search" aria-hidden="true"></i>&nbsp;แสดงผล
      </a>
    </div>
    <div class="col-sm-5">&nbsp;
    </div>
  </div>

</div>
 </div>

<div class="box-body no-padding">

<div id="calendar" style="width:100%"></div>

</div>
</div>




<div class="modal fade" id="modal-reserve">
        <div class="modal-dialog" style="width:700px" >
           <div class="modal-content">
            <div class="box-header with-border">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">จองห้อง</h4>
           </div>
           <div class="modal-body" id="dvModalContain">
           
           </div>

         
           <div class="modal-footer">
              <input type="button" id="btnClose" value="ปิด"  data-dismiss="modal"  class="btn btn-default pull-left" >
              <input type="button" id="btnSave" value="บันทึก"  data-dismiss="modal"  class="btn btn-primary" >
            </div>
           
        </div>
     </div>
   </div>  
   </section>


<!-- AdminLTE App -->

 


<script>
    

    var flagModal=false;

    function listBuilding(){
      var url="tbuilding/listBuilding.php";
      setDDL(url,"#obj_Building");
    }

    function listRoom(building){
      var url="troom/listRoom.php?building=27";
      setDDL(url,"#obj_Room");
    }

    function listBookingRoom(building){
      var url="troom/listRoom.php?building="+building;
      setDDL(url,"#obj_bookingRoom");
    }

    function isLinkReserve(){
        $("#obj_Room").val($("#link_RoomNo").val());
         displayCalendar();
    }

    function displayCalendar(roomNo){

      var url="<?=$rootPath?>/tbooking/bookingDisplay.php?bookingRoom="+roomNo+"&bDate="+$("#obj_bDate").val();
      $("#calendar").load(url);

    }

    /* initialize the external events
     -----------------------------------------------------------------*/


    $( document ).ready(function() {
      listRoom();
      $("#obj_Room").val("27.01.01");
      displayCalendar("27.01.01");
    

      $("#obj_display").click(function(){
         displayCalendar($("#obj_Room").val());
      });
      
    });

</script>
  

