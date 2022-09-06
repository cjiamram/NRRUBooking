
<style type="text/css">
    .bg-sec{background-color: #282DBE;  no-repeat left bottom; background-size:cover; min-height:100%; border-radius: 0 10px 10px 0; padding:0;}

</style>
<div style="background: -webkit-linear-gradient(to bottom, #459502, #67A800);width:100%;height: auto;padding : 150px 0;">

<div class="container">

<div class="text-center">
<div class="col-sm-12">

<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="info-box bg-blue">
      <img src='img/Header.jpg'>
    </div>
  </div>
</div>

<div class="row">
<div class="col-md-12 col-sm-12 col-xs-12">
<div class="info-box bg-yellow">
<span class="info-box-icon"><a href='#' onclick='zoomCalendar()'><i class="fa fa-calendar"></i></a></span>

<div class="info-box-content">
<span class="info-box-text"><h2>ปฏิทินการจอง Zoom</h2></span>
</div>
<!-- /.info-box-content -->
</div>
<!-- /.info-box -->
</div>
</div>



<div class="row">
<div class="col-md-12 col-sm-12 col-xs-12">
<div class="info-box bg-blue">
<span class="info-box-icon"><a href='#' onclick='zoomBooking()'><i class="fa fa-comments-o"></i></a></span>

<div class="info-box-content">
<span class="info-box-text"><h2>ระบุขอจองการใช้ Zoom</h2></span>
</div>
<!-- /.info-box-content -->
</div>
<!-- /.info-box -->
</div>
</div>
</div>


</div>
</div>

<script>
  function zoomBooking(){
       $("#dvMain").load("/NRRUBooking/tzoombooking/zoomBookingInputPage.php");
  }


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




