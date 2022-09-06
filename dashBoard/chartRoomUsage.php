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
<td width="45%">
	<div id="pieRoomUsage" style="width:100%;height:450px"></div>
</td>
<td width="55%">
	<div id="seriesRoomUsage" style="width:100%;height:500px">
	</div>
</td>
</tr>
<tr>
<td colspan="2">
	<iframe id="pivotRoomUsage" 
	width="100%"
	height="600px" 
	frameborder="0">
	</iframe>
</td>
</tr>
</table>
</div>

</section>

<script>
function getPieRoomUsage(){
	var sDate=$("#obj_sDate").val();
	var fDate=$("#obj_fDate").val();
	var url="<?=$rootPath?>/tbooking/pieRoomReport_1.php?sDate="+sDate+"&fDate="+fDate;
   
    $("#pieRoomUsage").load(url);
}

function getSeriesRoomUsage(){
	var sDate=$("#obj_sDate").val();
	var fDate=$("#obj_fDate").val();
	var url="<?=$rootPath?>/tbooking/lineRoomReport_1.php?sDate="+sDate+"&fDate="+fDate;
   
    $("#seriesRoomUsage").load(url);
}

function getPivotRoomUsage(){
	var sDate=$("#obj_sDate").val();
	var fDate=$("#obj_fDate").val();
	var url="<?=$rootPath?>/tbooking/pivotBooking.php?sDate="+sDate+"&fDate="+fDate;
	$('#pivotRoomUsage').attr('src', url)
}

function addDays(theDate, days) {
    		return new Date(theDate.getTime() + days*24*60*60*1000);
	}

	function setInitialize(){
			var now = new Date();
			var day = ("0" + now.getDate()).slice(-2);
			var month = ("0" + (now.getMonth() + 1)).slice(-2);
			var today = now.getFullYear()+"-"+(month)+"-"+(day) ;

			$('#obj_sDate').val(today);
			var lastDate=addDays(now, 30*3);
			day = ("0" + lastDate.getDate()).slice(-2);
			month = ("0" + (lastDate.getMonth() + 1)).slice(-2);
			var lastDay = lastDate.getFullYear()+"-"+(month)+"-"+(day) ;
			$('#obj_fDate').val(lastDay);

	}



$( document ).ready(function() {
	setInitialize();
	getPieRoomUsage();
	getSeriesRoomUsage();
	getPivotRoomUsage();
	$("#btnReport").click(function(){
		getPieRoomUsage();
		getSeriesRoomUsage();
		getPivotRoomUsage();
	});
   
});

</script>