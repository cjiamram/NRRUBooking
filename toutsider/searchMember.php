<?php
include_once "../config/config.php";
include_once "../config/database.php";
include_once "../lib/classAPI.php";
include_once "../objects/classLabel.php";

header("Access-Control-Allow-Origin: *");
header("Content-Type: text/html; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type,Access-Control-Allow-Headers, Authorization, X-Requested-With");
$cnf=new Config();
$database=new Database();
$db=$database->getConnection();
$keyword=isset($_GET["keyWord"])?$_GET["keyWord"]:"";
$path="toutsider/getData.php?keyWord=".$keyword;
$url=$cnf->restURL.$path;
$api=new ClassAPI();
$data=$api->getAPI($url);
$objLbl = new ClassLabel($db);
echo "<thead>";
		echo "<tr>";
			echo "<th>No.</th>";
			echo "<th>". $objLbl->getLabel("t_outsider","Outsider","th")."</th>";
			echo "<th>". $objLbl->getLabel("t_outsider","department","th")."</th>";
			echo "<th>". $objLbl->getLabel("t_outsider","description","th")."</th>";
			echo "<th>". $objLbl->getLabel("t_outsider","TelNo","th")."</th>";
			
			echo "<th>จัดการ</th>";
		echo "</tr>";
echo "</thead>";
if($data!=""){
echo "<tbody>";
$i=1;
foreach ($data as $row) {
		echo "<tr>";
			echo '<td>'.$i++.'</td>';
			echo '<td>'.$row["title"].' '.$row["firstName"].' '.$row["lastName"].'</td>';
			echo '<td>'.$row["department"].'</td>';
			echo '<td>'.$row["decription"].'</td>';
			echo '<td>'.$row["telNo"].'</td>';
			
			echo "<td>
			<button type='button' class='btn btn-info'
				onclick='readOneMember(".$row['id'].")' data-dismiss='modal' >
				<span class='fa fa-hand-o-up'></span>
			</button></td>";
			echo "</tr>";
}
echo "</tbody>";
}
?>
