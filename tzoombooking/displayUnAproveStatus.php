<?php
include_once "../config/config.php";
include_once "../lib/classAPI.php";
include_once "../objects/classLabel.php";
include_once "../config/database.php";



$database=new Database();
$db=$database->getConnection();
$cnf=new Config();
$api=new ClassAPI();
$objLbl = new ClassLabel($db);
$keyWord=isset($_GET["keyWord"])?$_GET["keyWord"]:"";
$url=$cnf->restURL."/tzoombooking/getUnAproveStatus.php?keyWord=".$keyWord;

$data=$api->getAPI($url);
echo "<thead>\n";
	echo "<tr>\n";
		echo "<th>No.</th>\n";
		echo "<th>".$objLbl->getLabel("t_zoombooking","License ID","th")."</th>\n";
		echo "<th>".$objLbl->getLabel("t_zoombooking","bookingDate","th")."</th>\n";
		echo "<th>".$objLbl->getLabel("t_zoombooking","duration","th")."</th>\n";
		echo "<th>".$objLbl->getLabel("t_zoombooking","activity","th")."</th>\n";
		echo "<th>".$objLbl->getLabel("t_zoombooking","bookingName","th")."</th>\n";
		echo "<th>".$objLbl->getLabel("t_zoombooking","contact","th")."</th>\n";
		echo "<th>จัดการ</th>\n";
	echo "</tr>\n";	
echo "</thead>\n";	
echo "<tbody>\n";
if(!isset($data["message"])){
	$i=1;
	foreach ($data as $row) {
		echo "<tr>\n";
		echo "<td>".$i."<input type='hidden' id='licenseId_".$i."' value='".$row["licenseId"]."'></td>\n";
		echo "<td width='150px'>".$row["licenseId"]."</td>\n";
		echo "<td width='150px'>".$row["bookingDate"]."</td>\n";
		echo "<td width='100px'>".$row["duration"]."</td>\n";
		echo "<td><textarea rows='4' cols='50'>".$row["activity"]."</textarea></td>\n";
		echo "<td>".$row["bookingName"]."</td>\n";
		echo "<td>".$row["contact"]."</td>\n";
		
		echo "<td width='200px'>
			<button type='button' class='btn btn-info'
				onclick='readOneBooking(".$row['id'].")'>
				<span class='fa fa-edit'></span>
			</button>
			<button type='button' class='btn btn-success'
				onclick='aproveBooking(".$i.",".$row["id"].")'>
				<span class='fa fa-thumbs-o-up'></span>
			</button>
			<button type='button' class='btn btn-warning'
				onclick='cancelBooking(".$row["id"].")'>
				<span class='fa fa-thumbs-o-down'></span>
			</button>
			</td>\n";
		echo "</tr>\n";
		$i++;
	}
}
echo "</tbody>\n";
?>


<script>
   tablePage ('#tblDisplay');
 </script>



