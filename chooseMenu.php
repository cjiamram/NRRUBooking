
<!--<style type="text/css">
    .bg-sec{background-color: #282DBE;  no-repeat left bottom; background-size:cover; min-height:100%; border-radius: 0 10px 10px 0; padding:0;}
    .bg-footer{no-repeat right bottom; background-size:cover; min-height:100%; border-radius: 0 10px 10px 0; padding:0;}
    .fontRight {text-align: right}
    .fontLeft {text-align: left}
</style>
<div style="background-color: #E5E5E5;background: -webkit-linear-gradient(to bottom, #459502, #67A800);width:100%;height: 800px;padding : 150px 0;">-->




	<div class="row text-center mb-5">
	  
	  <div class="col-md-6 col-lg-6 col-xs-12 css_btnroom">
		<img src="img/iconRoom.png" class=""  onclick='roomBooking()'>  

	  </div>
	  
	  <div class="col-md-6 col-lg-6 col-xs-12 css_btnroom">
	  	<img src="img/iconZoom.png" class=""  onclick='zoomBooking()'>  

	  </div>
	  
	</div>
	
	<!--
	 <div class="row icon_cont mt-5">
	 	<div class="col-md-7 col-lg-7 col-xs-3 text-right">&nbsp;
	 		<img src="img/iconcontact.png" >
	 	</div>
	 	<div class="col-md-5 col-lg-5 col-xs-9">
	 		<div class="row">
	 			<div class="col-lg-12 col-md-12 col-xs-12 font_contt">
	 				หากมีข้อสงสัยในการจองห้อง /ยกเลิกเร่งด่วน 
	 			</div>
	 			<div class="col-lg-12 col-md-12 col-xs-12 font_contt2">
	 				กรุณาติดต่อหน่วยงาน    
	 			</div>
	 			<div class="col-lg-12 col-md-12 col-xs-12 font_contt3">
	 				ห้องปฏิบัติการสำนักคอมพิวเตอร์
	 			</div>
	 			<div class="col-lg-12 col-md-12 col-xs-12 font_contt4">
	 				ติดต่อ 044-009-009 ต่อ 2710
	 			</div>
	 		</div>
	 	</div>
	 </div>-->
	 
	 <div class="row mt-5 text-right icon_contt">
	 	
	 		<img src="img/contact2.png" >
	 
	 	
	 		
	 	
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

