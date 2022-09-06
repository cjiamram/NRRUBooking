<?php
	include_once "../config/config.php";
	$cnf=new Config();
	$rootPath=$cnf->path;
	$strId=isset($_GET["buildingId"])?"<input type='hidden' id='obj_buildingId' value='".$_GET["buildingId"]."'>":"<input type='hidden' id='obj_buildingId' value=''>";
	echo $strId;

?>
<input type="hidden" id="obj_roomId" value="">
<form role='form'>
<div class="box-body">
		
		<div class='form-group'>
			<label class="col-sm-12" id="lblRoomNo">ห้อง:</label>
			<div class="col-sm-12">
				<input type="text" 
							class="form-control" id='obj_RoomNo_1' 
							placeholder='RoomNo'>
			</div>
		</div>
		<div class='form-group'>
			<label class="col-sm-12" id="lblComputerNo">จำนวนคอมพิวเตอร์/จำนวนโต๊ะ:</label>
			<div class="col-sm-6">
				<input type="text" 
							class="form-control" id='obj_ComputerNo' 
							placeholder='ComputerNo'>
			</div>
			<div class="col-sm-6">
				<input type="text" 
							class="form-control" id='obj_DeskNo' 
							placeholder='DeskNo'>
			</div>
		</div>
		
		<div class='form-group'>
			<label class="col-sm-12" id="lblAccessory">รายละเอียดห้อง:</label>
			<div class="col-sm-12">
				<input type="text" 
							class="form-control" id='obj_Accessory' 
							placeholder='Accessory'>
			</div>
		</div>

		<div class='form-group'>
			<label class="col-sm-12" id="lblFloorNo">ชั้นที่ :</label>
			<div class="col-sm-6">
				<input type="number" 
							class="form-control" id='obj_FloorNo_1' 
							placeholder='Floor No'>
			</div>
		</div>
		
</div>
<div class="col-sm-12">
	<div class='form-group'>
			<input type="button" id="btnSaveRoom" value="บันทึก"  class="btn btn-success" >
			<input type="button" id="btnNewRoom" value="เคลียร์"  class="btn btn-primary" >
		</div>
</div>

<div class="box-body" id="dvRoomList">
		<table id="tbDisplayRoom" class="table table-bordered table-hover">
      </table>    
</div>
</form>

<script src="<?=$rootPath?>/troom/jsExecuteRoom.js"></script>
<script>
	
	function displayDataRoom(buildingId){
		  var url="<?=$rootPath?>/troom/displayData.php?buildingId="+buildingId+"&keyWord=";
		  $("#tbDisplayRoom").load(url);
	}

	$("document").ready(function(){
		displayDataRoom($("#obj_buildingId").val());
		$("#btnSaveRoom").click(function(){
			saveDataRoom();
			displayDataRoom($("#obj_buildingId").val());
		});

		$("#btnNewRoom").click(function(){
			clearRoomData();
		});
	})
</script>
