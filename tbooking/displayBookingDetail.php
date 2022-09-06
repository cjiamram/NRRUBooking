  <link rel="stylesheet" href="../bower_components/bootstrap/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="../bower_components/font-awesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="../bower_components/Ionicons/css/ionicons.min.css">
  <link rel="stylesheet" href="../dist/css/AdminLTE.min.css">
  <link rel="stylesheet" href="../dist/css/skins/skin-blue.min.css">

<?php
	header("content-type:text/html;charset=utf-8");
	include_once "../config/config.php";
	include_once "../lib/classAPI.php";
	include_once "../objects/manage.php";
	$cnf=new Config();
	$id=isset($_GET["id"])?$_GET["id"]:0;
	$url=$cnf->restURL."tbooking/getBookingNotify.php?id=".$id;
	$api=new ClassAPI();
	$data=$api->getAPI($url);
	echo "<div class='box box-warning'>";
	echo "<table width='600px' class='table table-bordered table-hover'>";
	echo "<tr><th colspan='2'><h4>รายละเอียดการจองห้องประชุม</h4></th></tr>";
	if($data!=""){

		$option="";
		$i=1;
		foreach ($data["optionals"] as $row) {
			$option.="<li>".($i++). ":".$row["templateOption"]." ".$row["description"]." จำนวน:".$row["quantity"]."</li>";
		}

		echo "<tr>";
		echo "<td align='left'>ผู้จอง :</td>";
		echo "<td>".$data["BookingName"]."</td>";
		echo "</tr>";

		echo "<tr>";
		echo "<td align='left'>ห้อง :</td>";
		echo "<td>".$data["BookingRoom"]."</td>";
		echo "</tr>";

		echo "<tr>";
		echo "<td align='left'>วันที่ :</td>";
		echo "<td>". $data["BookingDate"]."</td>";
		echo "</tr>";

		echo "<tr>";
		echo "<td align='left'>กิจกรรม :</td>";
		echo "<td>".$data["Activity"]."</td>";
		echo "</tr>";

		echo "<tr>";
		echo "<td colspan='2'>".$option."</td>";
		echo "</tr>";

	}

	echo "</table>";
	echo "</div>";

?>