<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type,Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once "../config/config.php";
include_once "../lib/classAPI.php";
$cnf=new Config();
$keyword=isset($_GET["keyWord"])?$_GET["keyWord"]:"";
$buildingId=isset($_GET["buildingId"])?$_GET["buildingId"]:"";
$path="troom/getData.php?keyWord=".$keyword."&buildingId=".$buildingId;
$url=$cnf->restURL.$path;
$api=new ClassAPI();
$data=$api->getAPI($url);
echo "<thead>";
		echo "<tr>";
			echo "<th>No.</th>";
			echo "<th>หมายเลขห้อง</th>";
			echo "<th>คอมพิวเตอร์</th>";
			echo "<th>ที่นั่ง</th>";
			echo "<th>ชั้นที่</th>";
			echo "<th width='100px'>จัดการ</th>";
		echo "</tr>";
echo "</thead>";
if(!isset($data["message"])){
echo "<tbody>";
$i=1;
foreach ($data as $row) {
		echo "<tr>";
			echo '<td>'.$i++.'</td>';
			echo '<td>'.$row["RoomNo"].'</td>';
			echo '<td>'.$row["ComputerNo"].'</td>';
			echo '<td>'.$row["DeskNo"].'</td>';
			echo '<td>'.$row["FloorNo"].'</td>';
			echo "<td>
			<button type='button' class='btn btn-info'
				onclick='readOneRoom(".$row['id'].")'>
				<span class='fa fa-edit'></span>
			</button>
			<button type='button'
				class='btn btn-danger'
				onclick='confirmDeleteRoom(".$row['id'].")'>
				<span class='fa fa-trash'></span>
			</button></td>";
			echo "</tr>";
}
echo "</tbody>";
}
?>

<script src="./bower_components/jquery/dist/jquery.min.js"></script>
<script src="./bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="./bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="./bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>

<script>
  
function  tablePage () {
          table = function(){
            $('#tbDisplayRoom').DataTable( {
                'retrieve': false,
                'paging'      : true,
                'lengthChange': false,
                'searching'   : false,
                'ordering'    : true,
                'info'        : true,
                'autoWidth'   : false
        });
        }
        table();
  }

  tablePage ();
</script>




