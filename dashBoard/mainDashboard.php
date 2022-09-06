    <?php
      include_once "../config/config.php";
      $cnf=new Config();
      $rootPath=$cnf->path;
    ?>
 
    <section class="content">
    	 <div class="row">
    	 	<div class="col-lg-3 col-xs-6">
          <!-- small box -->
	          <div class="small-box bg-aqua">
	            <div class="inner">
	              <p>จำนวนการจองห้อง</p>
                  <h3><span id="obj_bookingRoom"></span></h3>
	            </div>
	            <div class="icon">
	              <i class="ion-ios-home-outline"></i>
	            </div>
	            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
	          </div>
	        </div>

	      <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
             

              <p>ชั่วโมงการจองห้อง</p>
               <h3><span id="obj_bookingHour"></span></h3>
            </div>
            <div class="icon">
              <i class="ion-ios-home"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>

         <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <p>จำนวนการจอง Zoom</p>
              <h3><span id="obj_bookingZoom"></span></h3>

              
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>


          <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
               <p>ชั่วโมงการจอง Zoom</p>
              <h3><span id="obj_zoomHour"></span></h3>

             
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
       </div>

      <div class="row">
         <div class="col-lg-6 col-xs-6">
          <div id="dvRoom">
          </div>

         </div>
        <div class="col-lg-6 col-xs-6">
              <div id="dvZoom">
              </div>
        </div>
      </div>
    </section>




<script>

function setBooking(){
  var url="<?=$rootPath?>/tbooking/getCountBooking.php";
  var data=queryData(url);
  $("#obj_bookingRoom").text(data.CNT);
  $("#obj_bookingHour").text(data.THr);

}

function setZoomBooking(){
  var url="<?=$rootPath?>/tzoombooking/getCountBooking.php";
  var data=queryData(url);
  $("#obj_bookingZoom").text(data.CNT);
  $("#obj_zoomHour").text(data.THr);

}

function setSumaryRoom(){
  var url="<?=$rootPath?>/dashBoard/barSumaryRoomBooking.php";
  $("#dvRoom").load(url);
}

function setSumaryZoom(){
  var url="<?=$rootPath?>/dashBoard/pieSumaryZoomBooking.php";
  $("#dvZoom").load(url);
}

$(document).ready(function(){
  setBooking();
  setZoomBooking();
  setSumaryRoom();
  setSumaryZoom();
});



</script>
