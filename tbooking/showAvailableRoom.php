<?php
	header("content-type:text/html;charset=utf-8");
	include_once "../config/config.php";

	$building=isset($_GET["building"]) ? $_GET["building"] : "";
	$bookingDate=isset($_GET["bookingDate"]) ? $_GET["bookingDate"] : "";
	$sTime=isset($_GET["sTime"]) ? $_GET["sTime"] : "";
	$sTime=str_replace(" ","",$sTime);
	$fTime=isset($_GET["fTime"]) ? $_GET["fTime"] : "";
	$fTime=str_replace(" ","",$fTime);

	$cnf=new Config();
	$rootPath=$cnf->path;


	
?>

 <table id="tblAvailable" class="table table-bordered table-hover">
</table>

<script>
	function loadAvailable(){
	  var sTime='<?=$sTime?>';
      var fTime='<?=$fTime?>';
      var building="27";
      var url="<?=$rootPath?>/tbooking/displayAvailable.php?building="+building+"&bookingDate="+$("#obj_bookingDate").val()+"&sTime="+sTime+"&fTime="+fTime+"&bookingDate="+$("#obj_bookingDate").val();
      //console.log(url);
      $("#tblDisplayEmpty").load(url);
	}

	$(document).ready(function(){
		loadAvailable();
	});



</script>