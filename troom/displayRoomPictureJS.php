<?php
	include_once "../config/config.php";
	$cnf=new Config();
	$rootPath=$cnf->path;
	$picURL=$rootPath."/img/Room.jpg";	
?>
<style> 
		.rcorners {
		  border-radius: 15px;
		  border: 2px solid #73AD21;
		  padding: 20px; 
		  width: 80%px;
		  height: 80%px;   
		}
</style>

<div class="content container-fluid" id="dvPicPanel">
</div>

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
 	var picURL='<?=$picURL?>';
	function checkFileExist(urlToFile) {
		var xhr = new XMLHttpRequest();
		xhr.open('HEAD', urlToFile, false);
		xhr.send();

		if (xhr.status == "404") {
				return false;
		} else {
				return true;
		}
	}
 	
 	function roomRendering(){
 		var url="<?=$rootPath?>/troom/getBookingRoom.php";
 		var picF='<?=$cnf->restURL?>';
 		//console.log(rootPath);
		var data=queryData(url);
		var strT="";
		for(i=0;i<data.length;i++){
			strT+="<div class='col-sm-4'>\n";
			strT+="<div class='rcorners'>\n";

			strRoom="<button type='button' class='btn btn-info' \n";
			strRoom+="onclick=\"loadCalendarDate('"+data[i].RoomNo+"')\">\n";
			strRoom+="<span class='fa fa-calendar'>ปฏิทิน</span>\n";
			strRoom+="</button>\n";
			strRoom+="<button type='button' class='btn btn-warning'\n";
			strRoom+="onclick=\"viewRoom('"+data[i].RoomNo+"')\"  >\n";
			strRoom+="<span class='fa fa-eye'>ผังห้องประชุม</span>\n";
			strRoom+="</button>\n";
			strRoom+="<button type='button' class='btn btn-primary'\n";
			strRoom+="onclick=\"viewPano('"+data[i].RoomNo+"')\"  >\n";
			strRoom+="<span class='fa-solid fa-panorama'>Pano</span>\n";
			strRoom+="</button>\n";
			strRoom+="<button type='button' class='btn btn-success'\n";
			strRoom+="onclick=\"bookingRoom('"+data[i].RoomNo+"')\">\n";
			strRoom+="<span class='fa fa-ticket'>จองห้อง</span>\n";
			strRoom+="</button>\n";


			var strT1="<table width='100%'>\n";
			strT1+="<tr><td align='center'><b>หมายเลขห้อง </b>"+data[i].RoomNo+"</td></tr>\n";
			strT1+="<tr><td align='center'>";
			//var urlPic= "<?=$cnf->restURL?>roomImages/"+data[i].RoomNo+".jpg";
			var urlPic= "<?=$cnf->restURL?>"+data[i].picture;

			if(checkFileExist(urlPic)===true)
				strT1+="<img width='250px' height='150px' src='"+urlPic+"'>";
			else
				strT1+="<img width='250px' height='150px' src='"+picURL+"'>";
			strT1+="</td><tr>";
			strT1+="<tr><td align='center'>\n";
			strT1+=strRoom;
			strT1+="</td></tr>\n";
			strT1+="</table>\n";

			strT+=strT1;

			strT+="</div>\n";
			strT+="</div>\n";
		}

		//console.log(strT);
		$("#dvPicPanel").html(strT);

	}

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
			  var url="<?=$rootPath?>/tbooking/inputBooking.php?roomNo="+roomNo;
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

 	$(document).ready(function(){
 		roomRendering();
 	});

 </script>