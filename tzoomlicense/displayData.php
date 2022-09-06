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
$path="tzoomlicense/getData.php?keyWord=".$keyword;
$url=$cnf->restURL.$path;
$api=new ClassAPI();
$data=$api->getAPI($url);
echo "<thead>";
		echo "<tr>";
			echo "<th>No.</th>";
			echo "<th>".$objLbl->getLabel("t_zoomlicense","zoomCode","TH")."</th>";
			echo "<th>".$objLbl->getLabel("t_zoomlicense","zoomDetail","TH")."</th>";
			echo "<th>".$objLbl->getLabel("t_zoomlicense","status","TH")."</th>";
			echo "<th>".$objLbl->getLabel("t_zoomlicense","clientId","TH")."</th>";
			echo "<th>".$objLbl->getLabel("t_zoomlicense","secretId","TH")."</th>";
			echo "<th>".$objLbl->getLabel("t_zoomlicense","redirectURI","TH")."</th>";
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
			echo '<td>'.$row["zoomDetail"].'</td>';
			echo '<td>'.$row["status"].'</td>';
			echo '<td>'.$row["clientId"].'</td>';
			echo '<td>'.$row["secretId"].'</td>';
			echo '<td><textarea style=\'width:100%;height:80px;\'>'.$row["redirectURI"].'</textarea></td>';
			echo "<td width='100px'>
			<button type='button' class='btn btn-info'
				onclick='getOne(".$row['id'].")'>
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
<script>
	tablePage("#tblDisplay");
</script>
