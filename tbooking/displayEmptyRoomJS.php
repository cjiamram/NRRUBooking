<?php
	include_once "../config/config.php";
	include_once "../lib/classAPI.php";
	header("Access-Control-Allow-Origin: *");
	header("Content-Type: application/json; charset=UTF-8");
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
	$url=$cnf->path."/tbooking/getRoomEmpty.php?building=".$_GET["building"]."&bookingDate=".$bookingDate."&sTime=".$sTime."&fTime=".$fTime;

?>

<table id="tblDisplayEmpty" class="table table-bordered table-hover">
<thead>
	<tr>
		<th>No.</th>
		<th>ห้อง</th>
		<th>ชั้น</th>
		<th>อาคาร</th>
		<th>หมายเหตุ</th>
		<th>คอมพิวเตอร์</th>
	</tr>
</thead>
<tbody id="tbEmpty"></tbody>

</tbody>
</table>

<script >
	var url='<?=$url?>';
	function getEmptyRoomRendering(){
		var data=queryData(url);
		strT="";
		if(data.length>0){
			for(i=0;i<data.length;i++){
				strT+="<tr>\n";
				strT+="<td >"+(i+1)+"</td>\n";
				strV="<input type='hidden' id='R"+i+"' value='"+data[i].roomNo+"'>";
				strT+="<td width='100px'><a class='btn btn-primary' href='#' onclick=\'linkReserve("+i+")\' >"+data[i].roomNo+strV+"&nbsp;&nbsp;<i class='fa fa-pencil-square-o' aria-hidden='true'></i></a></td>\n";
				strT+="<td>"+data[i].floorNo+"</td>\n";
				strT+="<td width='60px' align='center'>"+data[i].Building+"</td>\n";
				strT+="<td width='150px'><textarea row='2' style='width:100%' class='form-control'>"+data[i].Accessory+"</textarea></td>\n";
				strT+="<td width='100px' align='center'>"+data[i].ComputerNo+"</td>\n";
				strT+="</tr>\n";
			}
		}

		$("#tbEmpty").html(strT); 
	}

	function linkReserve(i){
		 var  sTime=$("#obj_sHr").val()+":"+$("#obj_sMn").val();
		 var  fTime=$("#obj_fHr").val()+":"+$("#obj_fMn").val();
		 var roomNo=$("#R"+i).val();
		 var link="<?=$rootPath?>/tbooking/inputBooking.php?roomNo="+roomNo+"&bookingDate="+$("#obj_bookingDate").val()+"&sTime="+sTime+"&fTime="+fTime+"&flagCheck=true";
		 $("#dvMain").load(link);

	}
	
	getEmptyRoomRendering();

</script>