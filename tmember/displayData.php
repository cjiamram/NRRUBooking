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
$path="tmember/getData.php?keyWord=".$keyword;
$url=$cnf->restURL.$path;
$api=new ClassAPI();
$data=$api->getAPI($url);
echo "<thead>";
		echo "<tr>";
			echo "<th>No.</th>";
			echo "<th>".$objLbl->getLabel("t_member","member","TH")."</th>";
			echo "<th>".$objLbl->getLabel("t_member","department","TH")."</th>";
			echo "<th>".$objLbl->getLabel("t_member","telNo","TH")."</th>";
			echo "<th>".$objLbl->getLabel("t_member","lineNo","TH")."</th>";
			echo "<th>".$objLbl->getLabel("t_member","email","TH")."</th>";
			echo "<th>จัดการ</th>";
		echo "</tr>";
echo "</thead>";
if($data!=""){
echo "<tbody>";
$i=1;
foreach ($data as $row) {
		echo "<tr>";
			echo '<td>'.$i++.'</td>';
			echo '<td>'.$row["title"].' '.$row["firstName"].' '. $row["lastName"] .'</td>';
			echo '<td>'.$row["department"].'</td>';
			echo '<td>'.$row["telNo"].'</td>';
			echo '<td>'.$row["lineNo"].'</td>';
			echo '<td>'.$row["email"].'</td>';
			echo "<td>
			<button type='button' class='btn btn-info'
				data-toggle='modal' data-target='#modal-input'
				onclick='readOneMember(".$row['id'].")' data-dismiss='modal'>
				<span class='fa fa-hand-o-up'></span>
			</button></td>";
			echo "</tr>";
}
echo "</tbody>";
}
?>
