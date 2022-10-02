<style> 


.rcorners {
  border-radius: 15px;
  border: 2px solid #73AD21;
  padding: 20px; 
  width: 80%px;
  height: 80%px;   
}

</style>

<?php
	header("content-type:text/html;charset=UTF-8");
	include_once "../config/config.php";
	include_once "../lib/classAPI.php";
	$cnf=new Config();
	$api=new ClassAPI();

	$url=$cnf->restURL;

	$url=$cnf->restURL."troom/getBookingRoom.php";
	//print_r($url);
	$rootPath=$cnf->path;

	$picURL=$rootPath."/img/Room.jpg";



	//print_r($url);

	$data=$api->getAPI($url);
	echo "<div class=\"content container-fluid\">\n";
	if(!isset($data["message"])){
		foreach ($data as $row) {
			echo "<div class='col-sm-4'>\n";
			echo "<div class='rcorners'>\n";

			$strRoom="<button type='button' class='btn btn-info'
			onclick=\"loadCalendarDate('".$row['RoomNo']."')\">
			<span class='fa fa-calendar'>ปฏิทิน</span>
			</button>
			<button type='button' class='btn btn-warning'
			onclick=\"viewRoom('".$row['RoomNo']."')\"  >
			<span class='fa fa-eye'>ผังห้องประชุม</span>
			</button>
			<button type='button' class='btn btn-primary'
			onclick=\"viewPano('".$row['RoomNo']."')\"  >
			<span class='fa-solid fa-panorama'>Pano</span>
			</button>
			<button type='button' class='btn btn-success'
			onclick=\"bookingRoom('".$row['RoomNo']."')\">
			<span class='fa fa-ticket'>จองห้อง</span>
			</button>";

			$strT="<table width='100%'>\n";
			$strT.="<tr><td align='center'><b>หมายเลขห้อง </b>".$row["RoomNo"]."</td></tr>\n";
			$strT.="<tr><td align='center'>";
			$urlPic='../roomImages/'.$row["RoomNo"].".jpg";
			if(file_exists($urlPic)==true)
				$strT.="<img width='250px' height='150px' src='".$rootPath."/roomImages/".$row["RoomNo"].".jpg'>";
			else
				$strT.="<img width='250px' height='150px' src='".$picURL."'>";
			$strT.="</td><tr>";
			$strT.="<tr><td align='center'>\n";
			$strT.=$strRoom;
			$strT.="</td></tr>\n";
			$strT.="</table>\n";

			echo $strT;
			
			echo "</div>\n";
			echo "</div>\n";
			# code...
		}
	}
	echo "</div>\n";



?>


    <div class="modal fade" id="modal-room">
     <div class="modal-dialog" >
      <div class="modal-content"  style="width:730px" >
          <div class="box-header with-border">
                <button type="button" class="close"  aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">ผังห้องประชุม</h4>
           </div>
           <div class="modal-body" id="dvRoom">
           
           </div>
      </div>
     </div>
   </div>




<script>
	
	

	function viewRoom(roomNo){
		var url="<?=$rootPath?>/troom/getRoomPlan.php?roomNo="+roomNo;
		
		$("#dvRoom").load(url);
		$("#modal-room").modal("toggle");

	}

	function viewPano(roomNo){
		var url="<?=$rootPath?>/troom/getPano.php?roomNo="+roomNo;
		$("#dvMain1").css({"display":"block"});
		$("#dvMain").css({"display":"none"});
		$("#frmMain").css({"height":"800px"});
		$("#frmMain").attr("src",url);


	}

	 function bookingRoom(roomNo){
			  var url="<?=$rootPath?>/tbooking/inputBookingT.php?roomNo="+roomNo;
			  $("#dvMain").load(url);
	 }

	 function loadCalendar(roomNo){
           var url="<?=$rootPath?>/tbooking/calendarPopup.php?roomNo="+roomNo;

        $("#dvMain").load(url);
 	}

 	 function loadCalendarDate(roomNo){
        var url="<?=$rootPath?>/tbooking/calendaPopup_1.php?roomNo="+roomNo;
        $("#dvMain").load(url);
 	}

 	$(".close").click(function(){
 		$("#modal-room").modal("hide");
 	});

 	$("#btnClose").click(function(){
 		//$("#modal-room").modal("hide");
 	});

</script>