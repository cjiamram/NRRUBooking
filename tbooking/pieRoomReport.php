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
window.onload = function () {

 var url="<?=$rootPath?>/tbooking/roomReport.php?sDate="+sDate+"&fDate="+fDate+"&rType=2";
 var data=queryData(url);

 console.log(data.length);
 for(i=0;i<data.length;i++){
 	  datasets.push({"name":"Room No :"+ data[i].BookingRoom, y: parseInt(data[i].SHour)});
 }

 //console.log(datasets);




var chart = new CanvasJS.Chart("chartContainer", {
	exportEnabled: true,
	animationEnabled: true,
	title:{
		text: "สัดส่วนการใช้บริการห้องประชุมของ สำนักคอมพิวเตอร์"
	},
	legend:{
		cursor: "pointer",
		itemclick: explodePie
	},
	data: [{
		type: "pie",
		showInLegend: true,
		toolTipContent: "{name}: <strong>{y} Hr</strong>",
		indexLabel: "{name} Usage {y} Hr",
		dataPoints:datasets
	}]
});
chart.render();
}

function explodePie (e) {
	if(typeof (e.dataSeries.dataPoints[e.dataPointIndex].exploded) === "undefined" || !e.dataSeries.dataPoints[e.dataPointIndex].exploded) {
		e.dataSeries.dataPoints[e.dataPointIndex].exploded = true;
	} else {
		e.dataSeries.dataPoints[e.dataPointIndex].exploded = false;
	}
	e.chart.render();

}
</script>
</head>
<body>
<div id="chartContainer" style="height: 370px; max-width: 920px; margin: 0px auto;"></div>
<script src="<?=$rootPath?>/js/canvasjs.min.js"></script>
</body>
</html>