<!DOCTYPE HTML>
<?php
	include_once "../config/config.php";
	$cnf=new Config();
	$rootPath=$cnf->path;
	$sDate=isset($_GET["sDate"])?$_GET["sDate"]:date("Y/m/d");
	$fDate=isset($_GET["fDate"])?$_GET["fDate"]:date("Y/m/d");
?>
<html>
<head>  
<meta charset="UTF-8">
<script src="<?=$rootPath?>/bower_components/jquery/dist/jquery.min.js"></script>
<script src="<?=$rootPath?>/js/component.js"></script>


<script>
var sDate='<?php echo $sDate; ?>';
var fDate='<?php echo $fDate; ?>';

var datasets=[];

function getJSONRoomUsage(){
	var url="<?=$rootPath?>/troom/getRoomList.php?sDate="+sDate+"&fDate="+fDate+"&building=";

	data=queryData(url);
	jsonData=JSON.stringify(data);
	return data;	
}

function seriesRoomUsage() {

var chart = new CanvasJS.Chart("seriesContainer", {
	
	animationEnabled: true,
	title:{
		text: "ปริมาณการใช้งานห้องประชุมของสำนักคอมพิวเตอร์"
	},
	axisY :{
		includeZero: false,
		title: "เวลาการใช้ห้อง.",
		suffix: " ชม."
	},
	toolTip: {
		shared: "true"
	},
	legend:{
		cursor:"pointer",
		itemclick : toggleDataSeries
	},
	data: getJSONRoomUsage()
});
chart.render();

function toggleDataSeries(e) {
	if (typeof(e.dataSeries.visible) === "undefined" || e.dataSeries.visible ){
		e.dataSeries.visible = false;
	} else {
		e.dataSeries.visible = true;
	}
	chart.render();
}

}

$( document ).ready(function() {
    seriesRoomUsage();
});

</script>
</head>
<body>
<div id="seriesContainer" style="height: 370px; max-width: 920px; margin: 0px auto;"></div>

<script src="<?=$rootPath?>/js/canvasjs.min.js"></script>

</body>
</html>