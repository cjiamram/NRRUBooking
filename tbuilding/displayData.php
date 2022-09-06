<?php
include_once "../config/config.php";
include_once "../lib/classAPI.php";
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type,Access-Control-Allow-Headers, Authorization, X-Requested-With");
$cnf=new Config();
$keyword=isset($_GET["keyWord"])?$_GET["keyWord"]:"";
$path="tbuilding/getData.php?keyWord=".$keyword;
$url=$cnf->restURL.$path;
$api=new ClassAPI();
$data=$api->getAPI($url);
echo "<thead>";
		echo "<tr>";
			echo "<th>No.</th>";
			echo "<th >หมายเลขอาคาร</th>";
			echo "<th>ชื่ออาคาร</th>";
			echo "<th >จำนวนชั้น</th>";
			echo "<th >จำนวนห้อง</th>";
			echo "<th>รูปภาพชั้น</th>";
			echo "<th width='150px' align='center'>จัดการ</th>";
		echo "</tr>";
echo "</thead>";
if($data!=""){
echo "<tbody>";
$i=1;
foreach ($data as $row) {
		echo "<tr>";
			echo '<td>'.$i++.'</td>';
			echo '<td>'.$row["BuildingNo"].'</td>';
			echo '<td>'.$row["BuildingName"].'</td>';
			echo '<td>'.$row["FloorNo"].'</td>';
			echo '<td>'.$row["RoomNo"].'</td>';
			echo '<td >'.$row["FloorPlan"].'</td>';
			echo "<td>

			<button type='button' class='btn btn-info'
				
				onclick='loadRoomInfo(".$row['BuildingNo'].")'>
				<span class='fa fa-list'></span>
			</button>
			
			<button type='button' class='btn btn-info'
				onclick='readOneBuilding(".$row['id'].")'>
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

<script src="./bower_components/jquery/dist/jquery.min.js"></script>
<script src="./bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="./bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="./bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>

<script>
  
function  tablePage () {
          table = function(){
            $('#tblDisplay').DataTable( {
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


