<?php
include_once "../config/config.php";
include_once "../lib/classAPI.php";
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type,Access-Control-Allow-Headers, Authorization, X-Requested-With");
$cnf=new Config();
$keyWord=isset($_GET["keyWord"])?$_GET["keyWord"]:"";
$url=$cnf->restURL."tbooking/getData.php?keyWord=".$keyWord;
$api=new ClassAPI();
$data=$api->getAPI($url);
echo "<thead>";
		echo "<tr>";
			echo "<th>No.</th>";
			echo "<th>bookingRoom</th>";
			echo "<th>bookingDate</th>";
			echo "<th>startTime</th>";
			echo "<th>finishTime</th>";
			echo "<th>bookingName</th>";
			echo "<th>staffId</th>";
			echo "<th>status</th>";
			echo "<th>activity</th>";
			echo "<th>lineNo</th>";
			echo "<th>telNo</th>";
			echo "<th>จัดการ</th>";
		echo "</tr>";
echo "</thead>";
if($data!=""){
echo "<tbody>";
$i=1;
foreach ($data as $row) {
		echo "<tr>";
			echo "<td>".$i++."</td>";
			echo "<td>".$row["bookingRoom"]."</td>";
			echo "<td>".$row["bookingDate"]."</td>";
			echo "<td>".$row["startTime"]."</td>";
			echo "<td>".$row["finishTime"]."</td>";
			echo "<td>".$row["bookingName"]."</td>";
			echo "<td>".$row["staffId"]."</td>";
			echo "<td>".$row["status"]."</td>";
			echo "<td>".$row["activity"]."</td>";
			echo "<td>".$row["lineNo"]."</td>";
			echo "<td>".$row["telNo"]."</td>";
			echo "<td>
			<button type='button' class='btn btn-info'
				data-toggle='modal' data-target='#modal-input'
				onclick='readOne(".$row['id'].")'>
				<span class='fa fa-edit'></span>
			</button>
			<button type='button'
				class='btn btn-danger'
				onclick='confirmDelete(".$row['id'].")'>
				<span class='fa fa-trash'></span>
			</button></td>";
			echo "</tr>";
}
echo "</tbody>";
}
?>
