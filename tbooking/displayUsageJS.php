<?php
	header("Access-Control-Allow-Origin: *");
	header("Content-Type: application/json; charset=UTF-8");
	header("Access-Control-Allow-Methods: POST");
	header("Access-Control-Max-Age: 3600");
	header("Access-Control-Allow-Headers: Content-Type,Access-Control-Allow-Headers, Authorization, X-Requested-With");

	
	function strToHex($string){
		$hex='';
		for ($i=0; $i < strlen($string); $i++){
		$hex .= dechex(ord($string[$i]));
		}
		return $hex;
	}

	include_once "../config/config.php";
	include_once "../lib/classAPI.php";
	$cnf=new Config();
	$rootPath=$cnf->path;
	$building=isset($_GET["building"]) ? $_GET["building"] : "";
	$bookingDate=isset($_GET["bookingDate"]) ? $_GET["bookingDate"] : "";
	$sTime=isset($_GET["sTime"]) ? $_GET["sTime"] : "";
	$fTime=isset($_GET["fTime"]) ? $_GET["fTime"] : "";
	$url=$rootPath."/tbooking/getRoomUsage.php?building=".$_GET["building"]."&bookingDate=".$bookingDate."&sTime=".$sTime."&fTime=".$fTime;
	//print_r($url);
?>

<table id="tblDisplayUsage" class="table table-bordered table-hover">
	<thead>
		<tr>
			<th>No.</th>
			<th>ห้อง</th>
			<th>วันที่จอง</th>
			<th>เวลา</th>
			<th>ผู้ใช้งาน</th>
			<th>หมายเหตุ</th>
		</tr>
	</thead>
	<tbody id="tbUsage">
	</tbody>
</table>

<script>
	function getUsageRoomRendering(){
		var url='<?=$url?>';
		var data=queryData(url);
		if(data.length>0){
			strT="";
			for(i=0;i<data.length;i++){
				
				strT+="<tr>\n";
				strT+="<td width='50px'>"+(i+1)+"</td>\n";
				strT+="<td width='100px'><span class='btn btn-warning'>"+data[i].bookingRoom+"</span></td>\n";
				strT+="<td width='100px'>"+data[i].bookingDate+"</td>\n";
				strT+="<td width='100px'>"+data[i].bookingTime+"</td>\n";
				strT+="<td>"+data[i].bookingName+"</td>\n";
				strT+="<td><textarea class='form-control' rows='2' style='width:100%'>"+data[i].Activity+"</textarea></td>\n";
				strT+="</tr>\n";
			}
			$("#tbUsage").html(strT);

		}
	}

	
	getUsageRoomRendering();
		//setTablePage("#tblDisplayUsage",10);

</script>