<?php
	header("content-type:text/html;charset=UTF-8");
	include_once "../config/config.php";
	include_once "../lib/classAPI.php";
	include_once "../objects/classLabel.php";
	include_once "../objects/ttemplate.php";
	include_once "../config/database.php";
	include_once "../objects/toptional.php";


	$database=new Database();
	$db=$database->getConnection();
	$cnf=new Config();
	$rootPath=$cnf->path;
	$api=new ClassAPI();
	$url=$cnf->restURL;
	$userCode=isset($_GET["userCode"])?$_GET["userCode"]:"";
	$objLbl=new ClassLabel($db);
	$objT=new ttemplate($db);
	$objO=new toptional($db);

	$url=$rootPath."/tbooking/getSelfBookingRoom.php?userCode=".$userCode;

?>
<table id="tblSelfBooking" class="table table-bordered table-hover">
	<?php
		echo "<thead>";
			echo "<tr>";
				echo "<th width='50px'>No.</th>";
				echo "<th width='150px'>".$objLbl->getLabel("t_booking","BookingRoom","th")."</th>";
				echo "<th width='200px'>".$objLbl->getLabel("t_booking","bookingDate","th")."</th>";
				echo "<th>".$objLbl->getLabel("t_booking","activity","th")."</th>";
			    echo "<th width='100px'>จัดการ</th>";
			echo "</tr>";
		echo "</thead>";
	?>
	<tbody id="tbSelfBooking">

	</tbody>

</table>

<script>
	function getOptional(bookingId){
		var url='<?=$rootPath?>/toptional/getData.php?bookingId='+bookingId;
		var data=queryData(url);
		var strT1="<table width='50%' lass=\"table table-bordered table-hover\">\n";
		if(data.length>0){
			strT1+="<tr>\n";
				strT1+="<td>No.</td>\n";
				strT1+="<td>อุปกรณ์</td>\n";
			strT1+="</tr>\n";
			jQuery.each( data, function( i, val ) {
				strT1+="<tr>\n";
				strT1+="<td align='center'>"+(i+1)+"</td>\n";
				strT1+="<td>"+val.template+"</td>\n";
				//strT1+="<td width='50px'>"+val.qty+"</td>\n";
				strT1+="</tr>\n";
			});
		}
		strT1+="</table>\n";

		return strT1;


	}

	function selfBookingRendering(){
		var url='<?=$url?>';
		var data=queryData(url);
		if(data.length>0){
			
			strT="";
			jQuery.each( data, function( i, val ) {
				 strT+="<tr>\n";
				 strT+= "<td>"+(i+1)+"</td>\n";
				 strT+= "<td>"+val.bookingRoom+"</td>\n";
				 strT+= "<td>"+val.bookingDate+"</td>\n";
				 strT+= "<td>"+val.activity+getOptional(val.id)+"</td>\n";
				 strT+="<td>\n";
				 strT+="<a class='btn btn-info' href='#'\n";
				 strT+="class='btn btn-info'\n";
				 strT+="data-toggle='modal' data-target='#modal-input'\n";
				 strT+="title='แก้ไขข้อมูล'\n";
				 strT+="onclick='readOne("+val.id+")'>\n";
				 strT+="<span class='fa fa-edit'></span></a>\n";
				 strT+="<a class='btn btn-danger' href='#' title='ลบการจองห้อง'";
				 strT+="class='btn btn-danger'\n";
				 strT+="onclick='confirmDelete("+val.id+")'>\n";
				 strT+="<span class='fa fa-trash'></span></a>\n";
				 strT+="</td>\n";
				 strT+="</tr>\n";


			});

			$("#tbSelfBooking").html(strT);
		}
	}

	selfBookingRendering();

</script>

