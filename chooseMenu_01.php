
<style type="text/css">
    .bg-sec{background-color: #282DBE;  no-repeat left bottom; background-size:cover; min-height:100%; border-radius: 0 10px 10px 0; padding:0;}
    .bg-footer{no-repeat right bottom; background-size:cover; min-height:100%; border-radius: 0 10px 10px 0; padding:0;}
    .fontRight {text-align: right}
    .fontLeft {text-align: left}
</style>
<div style="background-color: #E5E5E5;background: -webkit-linear-gradient(to bottom, #459502, #67A800);width:100%;height: 800px;padding : 150px 0;">
<div class="container">

<div class="row">
  <div class="col-md-6 col-sm-12 col-xs-12">
	<img src="img/2.png" style="justify-content" onclick='roomBooking()'>  

  </div>
  <div class="col-md-6 col-sm-12 col-xs-12">
  	<img src="img/1.png" style="justify-content" onclick='zoomBooking()'>  

  </div>
 </div>
  <div class="row">
  	<hr>
  </div>
 <div class="row">
 	<div class="col-md-6 col-sm-12 col-xs-12">&nbsp;
 	</div>
 	<div class="col-md-6 col-sm-12 col-xs-12">
 	<img src="img/Contact.png">
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

