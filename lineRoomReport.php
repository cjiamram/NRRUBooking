<!DOCTYPE HTML>
<html>
<head>
<meta charset="UTF-8">
<script src="/roomReserve/bower_components/jquery/dist/jquery.min.js"></script>
<script src="/roomReserve/js/component.js"></script>

<?php
	$sDate=isset($_GET["sDate"])?$_GET["sDate"]:date("Y/m/d");
	$fDate=isset($_GET["fDate"])?$_GET["fDate"]:date("Y/m/d");

?>
<script>
	var sDate='<?php echo $sDate; ?>';
	var fDate='<?php echo $fDate; ?>';



var datasets=[];
window.onload = function () {

 /*var url="/roomReserve/tbooking/roomReport.php?sDate="+sDate+"&fDate="+fDate+"&rType=2";
 var data=queryData(url);

 console.log(data.length);
 for(i=0;i<data.length;i++){
 	  datasets.push({"name":"Room No "+ data[i].BookingRoom, y: parseInt(data[i].SHour)});
 }*/

 //console.log(datasets);




var chart = new CanvasJS.Chart("chartContainer", {
	theme:"light2",
	animationEnabled: true,
	title:{
		text: "Game of Thrones Viewers of the First Airing on HBO"
	},
	axisY :{
		includeZero: false,
		title: "ปริมาณการใช้ห้องของสำนักคอมพิวเตอร์",
		suffix: "Hour"
	},
	toolTip: {
		shared: "true"
	},
	legend:{
		cursor:"pointer",
		itemclick : toggleDataSeries
	},
	data[]


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
<script src="/roomReserve/js/canvasjs.min.js"></script>
</body>
</html>