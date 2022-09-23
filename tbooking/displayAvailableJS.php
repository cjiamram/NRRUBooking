<?php
	include_once "../config/config.php";
	include_once "../lib/classAPI.php";
	header("Access-Control-Allow-Origin: *");
	header("Content-Type: text/html; charset=UTF-8");
	header("Access-Control-Allow-Methods: POST");
	header("Access-Control-Max-Age: 3600");
	header("Access-Control-Allow-Headers: Content-Type,Access-Control-Allow-Headers, Authorization, X-Requested-With");
	$cnf=new Config();
	$rootPath=$cnf->path;
	$building=isset($_GET["building"]) ? $_GET["building"] : "";
	$bookingDate=isset($_GET["bookingDate"]) ? $_GET["bookingDate"] : "";
	$sTime=isset($_GET["sTime"]) ? $_GET["sTime"] : "";
	$sTime=str_replace(" ","",$sTime);
	$fTime=isset($_GET["fTime"]) ? $_GET["fTime"] : "";
	$fTime=str_replace(" ","",$fTime);
	$url=$rootPath."/tbooking/getRoomEmpty.php?building=".$_GET["building"]."&bookingDate=".$bookingDate."&sTime=".$sTime."&fTime=".$fTime;
	//$api=new ClassAPI();
	//$data=$api->getAPI($url);

?>

<table id="tblAvailable" class="table table-bordered table-hover">

<thead>
	<tr>
		<th>No.</th>
		<th>หมายเลขห้อง</th>
		<th>ชั้น</th>
		<th>อาคาร</th>
		<th>อุปกรณ์</th>
		<th>จำนวนคอมพิวเตอร์</th>
	</tr>
</thead>

<tbody id="tbAvailable">
</tbody>

</table>

<script>

	function availableRendering(){
		var url='<?=$url?>';
		var data =queryData(url);
		if(data.length>0){
			strT="";
			for(i=0;i<data.length;i++){
				strT+="<tr>\n";
				strT+="<td>"+ (i+1) +"</td>\n";
				strV="linkReserve("+i+")";
				strR="<input type='hidden' value='"+data[i].roomNo+"' id='R"+i+"'>";
				strT+="<td><a href='#' onclick=\'"+strV+"\' >"+data[i].roomNo+strR+"</a></td>\n";
				strT+="<td>"+data[i].floorNo+"</td>\n";
				strT+="<td>"+data[i].Building+"</td>\n";
				strT+="<td>"+data[i].Accessory+"</td>\n";
				strT+="<td>"+data[i].ComputerNo+"</td>\n";
				strT+="</tr>\n";
			}
			$("#tbAvailable").html(strT);
		}

	}
	

	function linkReserve(i){
		 $("#modal-available").modal("hide");
		 roomNo=$("#R"+i).val();
		 $("#obj_bookingRoom").val(roomNo);
		
	}

	availableRendering();
</script>