<!DOCTYPE HTML>

<?php
  include_once "../config/config.php";
  $cnf=new Config();
  $rootPath=$cnf->path;
  $cDate=date("Y-m-d");
  $sDate=isset($_GET["sDate"])?$_GET["sDate"]:$cDate;
  $fDate=isset($_GET["fDate"])?$_GET["fDate"]:$cDate;

?>
<html>
<head>
<meta charset="UTF-8">

<script>

var datasets=[];
function displayPie() {
 var url="<?=$rootPath?>/dashBoard/sumaryDepartmentByDate.php?sDate=<?=$sDate?>&fDate=<?=$fDate?>";
 var data=queryData(url);

 for(i=0;i<data.length;i++){
    datasets.push({"name":"หน่วยงาน :"+ data[i].departmentName, y: parseInt(data[i].THr)});
 }

var chart = new CanvasJS.Chart("pieChart", {
  exportEnabled: true,
  animationEnabled: true,
  title:{
    text: "สัดสัดส่วนการจอง Zoom Meeting"
  },
  legend:{
    cursor: "pointer",
    itemclick: explodePie
  },
  data: [{
    type: "pie",
    showInLegend: true,
    toolTipContent: "{name}: <strong>{y} Hr.</strong>",
    indexLabel: "{name} เวลาที่จอง {y} Hr",
    dataPoints:datasets
  }]
});
chart.render();
}

$( document ).ready(function() {
    displayPie();
});

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
<div id="pieChart" style="height: 370px; max-width: 920px; margin: 0px auto;"></div>
</body>
</html>