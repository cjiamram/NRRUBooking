<?php
include_once "../config/config.php";
include_once "../lib/classAPI.php";
include_once "../config/database.php";
include_once "../objects/classLabel.php";
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type,Access-Control-Allow-Headers, Authorization, X-Requested-With");
$database = new Database();
$db = $database->getConnection();
$objLbl = new ClassLabel($db);
$cnf=new Config();
$keyword=isset($_GET["keyWord"])?$_GET["keyWord"]:"";
$path="tzoombooking/getData.php?keyWord=".$keyword;
$url=$cnf->restURL.$path;
$api=new ClassAPI();
$data=$api->getAPI($url);
echo "<thead>";
		echo "<tr>";
			echo "<th>No.</th>";
			echo "<th>".$objLbl->getLabel("t_zoombooking","zoomCode","TH")."</th>";
			echo "<th>".$objLbl->getLabel("t_zoombooking","bookingDate","TH")."</th>";
			echo "<th>".$objLbl->getLabel("t_zoombooking","startTime","TH")."</th>";
			echo "<th>".$objLbl->getLabel("t_zoombooking","finishTime","TH")."</th>";
			echo "<th>".$objLbl->getLabel("t_zoombooking","bookingName","TH")."</th>";
			echo "<th>".$objLbl->getLabel("t_zoombooking","staffId","TH")."</th>";
			echo "<th>".$objLbl->getLabel("t_zoombooking","status","TH")."</th>";
			echo "<th>".$objLbl->getLabel("t_zoombooking","activity","TH")."</th>";
			echo "<th>".$objLbl->getLabel("t_zoombooking","telNo","TH")."</th>";
			echo "<th>".$objLbl->getLabel("t_zoombooking","lineNo","TH")."</th>";
			echo "<th>".$objLbl->getLabel("t_zoombooking","aproveStatus","TH")."</th>";
			echo "<th>".$objLbl->getLabel("t_zoombooking","outsiderId","TH")."</th>";
			echo "<th>จัดการ</th>";
		echo "</tr>";
echo "</thead>";
if($data!=""){
echo "<tbody>";
$i=1;
foreach ($data as $row) {
		echo "<tr>";
			echo '<td>'.$i++.'</td>';
			echo '<td>'.$row["zoomCode"].'</td>';
			echo '<td>'.$row["bookingDate"].'</td>';
			echo '<td>'.$row["startTime"].'</td>';
			echo '<td>'.$row["finishTime"].'</td>';
			echo '<td>'.$row["bookingName"].'</td>';
			echo '<td>'.$row["staffId"].'</td>';
			echo '<td>'.$row["status"].'</td>';
			echo '<td>'.$row["activity"].'</td>';
			echo '<td>'.$row["telNo"].'</td>';
			echo '<td>'.$row["lineNo"].'</td>';
			echo '<td>'.$row["aproveStatus"].'</td>';
			echo '<td>'.$row["outsiderId"].'</td>';
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
