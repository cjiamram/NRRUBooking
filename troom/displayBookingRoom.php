<?php
	header("content-type:text/html;charset=UTF-8");
	include_once "../config/config.php";
	include_once "../lib/classAPI.php";

	$cnf=new Config();
	$api=new ClassAPI();

	$rootPath=$cnf->path;

	$url=$cnf->restURL."troom/getBookingRoom.php";
	$data=$api->getAPI($url);
	echo "<thead>";
		echo "<tr>";
			echo "<th width='50px'>No.</th>";
			echo "<th width='150px'>หมายเลขห้อง</th>";
			echo "<th>รายละเอียดห้อง</th>";
			echo "<th>คอมพิวเตอร์</th>";
			echo "<th>ที่นั่ง</th>";
			echo "<th>ชั้นที่</th>";
			//echo "<th width='100px'>จัดการ</th>";
		echo "</tr>";
	echo "</thead>";

	if(!isset($data["message"])){
			echo "<tbody>";
			$i=1;
			foreach ($data as $row) {
					$strRoom="<div class='col-sm-12'>".$row["RoomNo"]."</div>";
					$strRoom.="<button type='button' class='btn btn-info'
							onclick=\"loadCalendar('".$row['RoomNo']."')\">
							<span class='fa fa-calendar'></span>
						</button>
						<button type='button' class='btn btn-success'
							onclick=\"bookingRoom('".$row['RoomNo']."')\">
							<span class='fa fa-ticket'></span>
						</button>";

					echo "<tr>";
						echo '<td>'.$i++.'</td>';
						echo '<td>'.$strRoom.'</td>';
						echo '<td>'.$row["Description"].'</td>';
						echo '<td>'.$row["ComputerNo"].'</td>';
						echo '<td>'.$row["DeskNo"].'</td>';
						echo '<td>'.$row["FloorNo"].'</td>';
					
						echo "</tr>";
			}
			echo "</tbody>";
	}

?>

<script>
	 	 function bookingRoom(roomNo){
			  var url="<?=$rootPath?>/tbooking/inputBooking.php?roomNo="+roomNo;
			  $("#dvMain").load(url);
	 	}
	 	setTablePage("#tblDisplay");

</script>s