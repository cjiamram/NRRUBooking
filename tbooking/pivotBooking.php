<html>
<?php
    include_once "../config/config.php";
    $cnf=new Config();
    $rootPath=$cnf->path;
    $sDate=isset($_GET["sDate"])?$_GET["sDate"]:date("Y/m/d");
    $fDate=isset($_GET["fDate"])?$_GET["fDate"]:date("Y/m/d");
?>
<head>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>


<link rel="stylesheet" type="text/css" href="/roomReserve/dist/pivot.css">
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
<script type="text/javascript" src="<?=$rootPath?>/dist/pivot.js"></script>
<link rel="stylesheet" href="<?=$rootPath?>/bower_components/bootstrap/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="<?=$rootPath?>/bower_components/font-awesome/css/font-awesome.min.css">
<link rel="stylesheet" href="<?=$rootPath?>/bower_components/Ionicons/css/ionicons.min.css">
<link rel="stylesheet" href="<?=$rootPath?>/dist/css/AdminLTE.min.css">
<link rel="stylesheet" href="<?=$rootPath?>/dist/css/skins/skin-blue.min.css">
<link rel="stylesheet" href="<?=$rootPath?>/bower_components/select2/dist/css/select2.min.css">
<link rel="stylesheet" href="<?=$rootPath?>/dist/css/jquery-confirm.min.css">
<link rel="stylesheet"
    href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

<style>

body {font-family: Verdana;}
		.node {
		border: solid 1px white;
		font: 10px sans-serif;
		line-height: 12px;
		overflow: hidden;
		position: absolute;
		text-indent: 2px;
}

</style>
</head>
<script>
	var sDate='<?php echo $sDate; ?>';
	var fDate='<?php echo $fDate; ?>';

	function getPivotRoom(){
		var url="<?=$rootPath?>/tbooking/getRoomUsageReport.php?sDate="+sDate+"&fDate="+fDate;
        $.getJSON(url, function(mps) {
            $("#output").pivotUI(mps, {
                rows: ["BookingRoom"],
                cols: ["YYMM"],
                aggregatorName: "Integer Sum",
                vals: ["HourDiff"],
                rendererName: "Heatmap",
                rendererOptions: {
                    table: {
                        clickCallback: function(e, value, filters, pivotData){
                            var names = [];
                            pivotData.forEachMatchingRecord(filters,
                                function(record){ names.push(record.Name); });
                            alert(names.join("\n"));
                        }
                    }
                }
            });
        });
    }
    

    $( document ).ready(function() {
    		getPivotRoom();
	});


</script>

<body>
<div class="col-sm-9">
<div id="output"  style="margin: 30px;width:900px"></div>
</div>
<div class="col-sm-3">
    <table width="100%" class="table table-bordered table-hover">
    <tr>
        <th>
            Legend
        </th>
    </tr>
    <tr>
        <td>
            <li>bookingName:ผู้จอง</li>
        </td>
    </tr>
    <tr>
        <td>
            <li>BookingDate:วันที่จอง</li>
        </td>
    </tr>
      <tr>
        <td>
            <li>BookingRoom:ห้องที่จอง</li>
        </td>
    </tr>
      <tr>
        <td>
            <li>HourDiff:จำนวนชั่วโมง</li>
        </td>
    </tr>
    </table>
</div>
</body>
</html>