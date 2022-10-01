<?php
			header("Content-Type:text/html;charset=UTF-8");
			include_once "../config/config.php";
			include_once "../lib/classAPI.php";
			include_once "../objects/classLabel.php";
			include_once "../config/database.php";
			include_once "../objects/toptional.php";
			include_once "../objects/ttemplate.php";



			$database=new Database();
			$db=$database->getConnection();

			$objT=new ttemplate($db);
			$objO=new toptional($db);


			$cnf=new Config();
			$rootPath=$cnf->path;	
			$sDate=isset($_GET["sDate"])?$_GET["sDate"]:date("Y-m-d") ;
			$fDate=isset($_GET["fDate"])?$_GET["fDate"]:date("Y-m-d") ;
			$bookingRoom=isset($_GET["bookingRoom"])?$_GET["bookingRoom"]:"" ;
			$bookingName=isset($_GET["bookingName"])?$_GET["bookingName"]:"" ;
			$url=$rootPath."/tbooking/roomUsageReport.php?sDate=".$sDate."&fDate=".$fDate."&bookingName=".$bookingName."&bookingRoom=".$bookingRoom;
			$api=new ClassAPI();
			$data=$api->getAPI($url);
			$objLbl=new ClassLabel($db);



?>
<table id="tblReport" class="table table-bordered table-hover">
<?php
	
		echo "<thead>";
				echo "<tr>";
					echo "<th>No.</th>";
					echo "<th>".$objLbl->getLabel("t_booking","BookingRoom","th")."</th>";
					echo "<th>".$objLbl->getLabel("t_booking","bookingName","th")."</th>";
					echo "<th>".$objLbl->getLabel("t_booking","activity","th")."</th>";
					echo "<th width='120px'>".$objLbl->getLabel("t_booking","BookingDate","th")."</th>";
					echo "<th>".$objLbl->getLabel("t_booking","timeInterval","th")."</th>";
					echo "<th width='150px'>".$objLbl->getLabel("t_booking","HourDiff","th")."</th>";
					echo "<th>จัดการ</th>";
				echo "</tr>";
		echo "</thead>";
?>
<tbody id="tbReport"></tbody>
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
				strT1+="</tr>\n";
			});
		}
		strT1+="</table>\n";

		return strT1;


	}

	function reportRendering(){
		var url='<?=$url?>';
		var data=queryData(url);
		var strT="";
		if(data.length>0){
			jQuery.each( data, function( i, val ) {
				
				 strT+="<tr>\n";
					 strT+="<td align='center' with='60px'>"+(i+1)+"</td>\n";
					 strT+="<td >"+val.BookingRoom+"</td>\n";
					 strT+="<td >"+val.bookingName+"</td>\n";
					 strT+="<td >"+val.activity+getOptional(val.id)+"</td>\n";
					 strT+="<td align='center'>"+val.BookingDate+"</td>\n";
					 strT+="<td align='center'>"+val.startTime+"-"+val.finishTime+"</td>\n";
					 strT+="<td align='center'>"+val.HourDiff+"</td>\n";
					 strT+="<td><button type='button'\n";
					 strT+="class='btn btn-danger'\n";
					 strT+="onclick='confirmDelete("+val.id+")'>\n";
					 strT+="<span class='fa fa-trash'></span>\n";
				 	 strT+="</td>\n";
				 strT+="</tr>\n";	
			});

			$("#tbReport").html(strT);

		}

	}
  
  reportRendering();
  setTablePage("#tblReport",30);


</script>