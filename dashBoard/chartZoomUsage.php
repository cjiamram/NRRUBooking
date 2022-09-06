<?php
	include_once "../config/config.php";
	$cnf=new Config();
	$rootPath=$cnf->path;
?>

<section class="content container-fluid">
<div class="box">
<table class="table table-bordered table-hover">
<tr>
	<td width="80px">ระหว่างวัน
	</td>
	<td width="150px">
		<div class="col-sm-12">
				<div class="input-group date">
				<div class="input-group-addon">
				<i class="fa fa-calendar"></i>
				</div>
				<input type="date" class="form-control" id="obj_sDate">
				</div>
			</div>
	</td>
	<td width="150px">
		<div class="col-sm-12">
				<div class="input-group date">
				<div class="input-group-addon">
				<i class="fa fa-calendar"></i>
				</div>
				<input type="date" class="form-control" id="obj_fDate">
				</div>
			</div>
	</td>
	<td>
		<input type="button" id="btnReport" value="แสดงผล"  class="btn btn-primary" >

	</td>
</tr>

</table>

</div>


<div class="box box-warning">
<table width="100%">
<tr>
<td width="60%">
	<div id="pieDepartment" style="width:100%;height:450px"></div>
</td>
<td width="40%">
	<div id="radarObjective" style="width:100%;height:500px">
	</div>
</td>
</tr>
<tr>
<td colspan="2">
	<div id="zoomUsage" style="width:100%;height:500px">
	</div>

</td>
</tr>
</table>
</div>

</section>

<script>

function getPieDepartment(){
	var sDate=$("#obj_sDate").val();
	var fDate=$("#obj_fDate").val();
	var url="<?=$rootPath?>/dashBoard/pieSumaryDepartmentByDate.php?sDate="+sDate+"&fDate="+fDate;
    $("#pieDepartment").load(url);
}

function getRadarObjective(){
	var sDate=$("#obj_sDate").val();
	var fDate=$("#obj_fDate").val();
	var url="<?=$rootPath?>/dashBoard/radarSumaryObjectiveByDate.php?sDate="+sDate+"&fDate="+fDate;
    $("#radarObjective").load(url);
}

function getLicenseUsageByDate(){
	var sDate=$("#obj_sDate").val();
	var fDate=$("#obj_fDate").val();
	var url="<?=$rootPath?>/dashBoard/barLicenseUsageByDate.php?sDate="+sDate+"&fDate="+fDate;
    $("#zoomUsage").load(url);
}




$(document).ready(function(){
	
	$("#btnReport").click(function(){
		getPieDepartment();
		getRadarObjective();
		getLicenseUsageByDate();
	}
	);
});


</script>