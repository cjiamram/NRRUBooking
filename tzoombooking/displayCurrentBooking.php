
<?php
//session_start();
include_once "../lib/classAPI.php";
include_once "../objects/classLabel.php";
include_once "../config/database.php";
include_once "../config/config.php";
include_once "../objects/tzoombooking.php";


$cnf=new Config();
$api=new ClassAPI();
$database=new Database();
$db=$database->getConnection();
$objLbl = new ClassLabel($db);
$obj=new tzoombooking($db);

$userCode=isset($_GET["userCode"])?$_GET["userCode"]:"";

$url=$cnf->restURL."/tzoombooking/getCurrentBooking.php?userCode=".$userCode;
//print_r($url);
$data=$api->getAPI($url);
echo "<thead>\n";
  echo "<tr>\n";
    echo "<th>No.</th>\n";
    echo "<th>".$objLbl->getLabel("t_zoombooking","License ID","th")."</th>\n";
    echo "<th>".$objLbl->getLabel("t_zoombooking","bookingDate","th")."</th>\n";
    echo "<th>".$objLbl->getLabel("t_zoombooking","duration","th")."</th>\n";
    echo "<th>".$objLbl->getLabel("t_zoombooking","activity","th")."</th>\n";
    echo "<th>สถานะ</th>\n";
    echo "<th>ยกเลิก</th>\n";

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
    echo "<td><textarea style='width:100%;height:80px;'  >".$row["activity"]."</textarea></td>\n";
    echo "<td width='100px'>".$obj->getMeetingStatus($row["id"])."</td>\n";
    if($obj->getMeetingPrepare($row["id"])===true){
    echo "<td width='80px'>
				<button type='button' class='btn btn-danger'
					onclick='cancelBooking(".$row["id"].")'>
					<span class='fa fa-trash'></span>
				</button>
        <button type='button' class='btn btn-primary'
          onclick='resendBooking(".$row["id"].")'>
          <span class='fa fa-envelope'></span>
        </button>
		   </td>\n";}
    else{
       echo "<td width='80px'>
        <button type='button' diable class='btn btn-secondary'>
          <span class='fa fa-trash'></span>
        </button>
       </td>\n";
    }

    echo "</tr>\n";
    $i++;
  }
}
echo "</tbody>\n";
  ?>

 <script>
 	tablePage("#tblDisplay");
 </script>
