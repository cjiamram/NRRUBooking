<div style="height:900px">
<div class="col-xs-6">
	<div class="col-sm-12" id="dvCt">
	</div>
	<div class="col-sm-12"><iframe frameborder="0" scrolling="no" 
	src="/roomReserve/tbooking/FLOOR_3/Floor3.php"
	 width="900px" height="900px"></iframe></div>
</div>
<div class="col-xs-6">
	<div class="box box-warning">
		<div class="box-header with-border">
              <h3 class="box-title"><b>ข้อมูลการใช้ห้อง</b></h3>
           </div>
		 <table id="tblDisplay" class="table table-bordered table-hover">
         </table>
	</div>
</div>
</div>

<script > 
function display_c(){
var refresh=1000; // Refresh rate in milli seconds
	mytime=setTimeout('display_ct()',refresh)
	displayRoomFloor("27","3");
}

function display_ct() {
	var x = new Date()
	document.getElementById('dvCt').innerHTML = "<h3>"+x+"</h3>";
	display_c();
 }

	function displayRoomFloor(building,floorNo){
		var url="/roomReserve/tbooking/displayRoomFloor.php?building="+building+"&floorNo="+floorNo;
		$("#tblDisplay").load(url);
	}


	$( document ).ready(function() {
    	displayRoomFloor("27","3");
    	display_ct();
	});

</script>


