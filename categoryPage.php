
<div class="text-center">

 <div class="row">
<div class="col-md-4 col-sm-6 col-xs-12">
<div class="info-box bg-yellow">
<span class="info-box-icon"><a href='#' onclick='zoomCalendar()'><i class="fa fa-calendar"></i></a></span>

<div class="info-box-content">
<span class="info-box-text">ปฏิทินการจอง Zoom</span>
</div>
<!-- /.info-box-content -->
</div>
<!-- /.info-box -->
</div>
</div>


<div class="row">
<div class="col-md-4 col-sm-6 col-xs-12">
<div class="info-box bg-blue">
<span class="info-box-icon"><a href='#' onclick='zoomBooking()'><i class="fa fa-comments-o"></i></a></span>

<div class="info-box-content">
<span class="info-box-text">ระบุขอจองการใช้ Zoom</span>
</div>
<!-- /.info-box-content -->
</div>
<!-- /.info-box -->
</div>
</div>

<div class="row">
<div class="col-md-4 col-sm-6 col-xs-12">
<div class="info-box bg-green">
<span class="info-box-icon"><a href='#' onclick='dashBoard()'><i class="fa fa-pie-chart"></i></a></span>


<div class="info-box-content">
<span class="info-box-text">Dash Board</span>
</div>
<!-- /.info-box-content -->
</div>
<!-- /.info-box -->
</div>
</div>








</div>

<script>
  function zoomBooking(){
       $("#dvMain").load("/NRRUBooking/tzoombooking/zoomBookingInputPage.php");
  }

//zoomBookingInputPage.php

  function zoomCalendar(){
       $("#dvMain").load("/NRRUBooking/tzoombooking/zoomCalendar.php");
  }

  function roomBooking(){
      $("#dvMain").load("/NRRUBooking/tbooking/calendar.php");

  }

    function dashBoard(){
      $("#dvMain").load("/NRRUBooking/dashBoard/mainDashBoard.php");

  }


  function menu(){
      $("#dvMain").load("/NRRUBooking/categoryPage.php");

  }


  $(document).ready(function(){

  });

</script>



