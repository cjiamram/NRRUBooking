<!DOCTYPE html>
<?php
  include_once '../lib/classAPI.php';
  include_once '../config/config.php';
  $cnf=new Config();
  $api=new ClassAPI();
  $rootPath=$cnf->path;
?>

<html>
<head>
<meta charset='utf-8' />
<link href='<?=$rootPath ?>/js/lib/main.css' rel='stylesheet' />
<link rel="stylesheet" href="<?=$rootPath ?>/bower_components/fullcalendar/dist/fullcalendar.min.css">
<link rel="stylesheet" href="<?=$rootPath ?>/bower_components/fullcalendar/dist/fullcalendar.print.min.css" media="print">


</head>
<body>

 <section class="content container-fluid">

  <div class="box">
  <div >
   <div class="box-body no-padding">
  <div class="box-body no-padding">
    <div class="col-sm-2"><label>Zoom License :</label> </div>
    <div class="col-sm-3">
      <select class="form-control" id="obj_zoomCode"></select>
    </div>
    <div class="col-sm-1">
      <input type="button" id="btnBooking" class="btn btn-primary"  value="จอง Zoom">
    </div>


</div>
</div>


 </div>
</div>



<div class="box box-success">
<div id='calendar'></div>
</div>


</section>



</body>
</html>

   <div class="modal fade" id="modal-input">
     <div class="modal-dialog" id="dvInput" >
      <div class="modal-content">
          <div class="box-header with-border">
                <button type="button" class="close"  aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">จองโปรแกรม Zoom</h4>
           </div>
           <div class="modal-body" id="dvInputBody">
           
           </div>
          <div>
                 <div class="modal-footer">
                    <input type="button" id="btnClose" value="ปิด"  class="btn btn-default pull-left" >
                    <input type="button" id="btnSave" value="บันทึก"  class="btn btn-primary" >
                  </div>
          </div>
      </div>
     </div>
   </div>


<script src="<?=$rootPath ?>/bower_components/jquery/dist/jquery.min.js"></script>
<script src="<?=$rootPath ?>/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<script src='<?=$rootPath ?>/js/lib/main.js'></script>
<script src='<?=$rootPath ?>/js/lib/locales-all.js'></script>
<script>

  function getEvent(){
     var zoomCode =$("#obj_zoomCode").val();
     var url="<?=$rootPath ?>/tzoombooking/getZoomBookingEvent.php?zoomCode="+zoomCode;
     var data=queryData(url);
     return data;
  }

  function listZoomLicense(){
    var url="<?=$rootPath?>/tzoomlicense/getActiveLicense.php";
    setDDLPrefix(url,"#obj_zoomCode","***ทั้งหมด***");
  }
 

  function renderCalendar(currentdate){

    var initialLocaleCode = 'th';
    var calendarEl = document.getElementById('calendar');
    var calendar = new FullCalendar.Calendar(calendarEl, {
      headerToolbar: {
        left: 'prev,next today',
        center: 'title',
        right: 'dayGridMonth,timeGridWeek,timeGridDay,listMonth'
      },
      initialDate: currentdate,
      locale: 'th',
      buttonIcons: false, // show the prev/next text
      weekNumbers: true,
      navLinks: true, // can click day/week names to navigate views
      editable: true,
      dayMaxEvents: true, // allow "more" link when too many events
      events:getEvent()

    });

    calendar.render();

  }

function initialInput(){
      
        $('#modal-input').modal('toggle');
        var url="<?=$rootPath ?>/tzoombooking/zoomBookingInput.php";
        $("#dvInputBody").load(url);
    
}

function displayCalendar(){
      var currentdate = new Date();
      currentdate=getSystemDate(currentdate);
      renderCalendar(currentdate);

}

$( document ).ready(function() {
      
      listZoomLicense();
      displayCalendar();
      $("#btnBooking").click(function(){
        initialInput();
      });

      $("#obj_zoomCode").change(function(){
          displayCalendar();
      });

      $(".close").click(function(){
        $("#modal-input").modal("hide");

      });

      $("#btnClose").click(function(){
         $("#modal-input").modal("hide");

      });
});

</script>
