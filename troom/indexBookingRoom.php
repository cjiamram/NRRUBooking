<?php
      include_once '../config/database.php';
      include_once '../config/config.php';
      $cnf=new Config();
      $rootPath=$cnf->path;

?>
<script src="<?=$rootPath?>/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?=$rootPath?>/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>

<section class="content-header">
     <h1>
        <b>ระบบจองห้องประชุม</b>

        <small>>>จองห้อง</small>
      </h1>
      <ol class="breadcrumb">

        
      </ol>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">
        <div class="box"></div>
     
      <div>&nbsp;</div>
      <div class="col-sm-12">
      <div class="box box-warning">
      <div class="box-header with-border">
      <h3 class="box-title"><b>ข้อมูลห้อง</b></h3>
      </div>
      <table id="tblDisplay" class="table table-bordered table-hover">
      </table>
      </div>  
      </div>
        
    </section>


   


    <div class="modal fade" id="modal-calendar">
     <div class="modal-dialog" >
      <div class="modal-content" style="width:1000px;height:1000px" >
          <div class="box-header with-border">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Calendar</h4>
           </div>
           <div class="modal-body" id="dvCalendar">
           
           </div>
          <div>
                 <div class="modal-footer">
                    <input type="button" id="btnClose" value="ปิด"  class="btn btn-default pull-left" >
                  </div>
          </div>
      </div>
     </div>
   </div>


<script>
 function loadBookingRoom(){
    var url="<?=$rootPath?>/troom/displayBookingRoom.php";
    $("#tblDisplay").load(url);
 }



 function loadCalendar(roomNo){
        var url="<?=$rootPath?>/tbooking/calendarPopup.php?roomNo="+roomNo;
        $("#dvMain").load(url);
 }



 $( document ).ready(function() {
   loadBookingRoom();
 });

</script>
