<form role='form'>
<div class="box-body">
		<div class='form-group'>
			<label class="col-sm-12" id="lbl_BuildingNo">หมายเลขอาคาร:</label>
			<div class="col-sm-12">
				<input type="text" 
							class="form-control" id='obj_BuildingNo' 
							placeholder='BuildingNo'>
			</div>
		</div>
		<div class='form-group'>
			<label class="col-sm-12" id="lbl_BuildingName">ชื่ออาคาร:</label>
			<div class="col-sm-12">
				<input type="text" 
							class="form-control" id='obj_BuildingName' 
							placeholder='BuildingName'>
			</div>
		</div>
		<div class='form-group'>
			<label class="col-sm-12" id="lbl_FloorNo">จำนวนชั้น:</label>
			<div class="col-sm-12">
				<input type="text" 
							class="form-control" id='obj_FloorNo' 
							placeholder='FloorNo'>
			</div>
		</div>
		<div class='form-group'>
			<label class="col-sm-12" id="lbl_RoomNo">จำนวนห้อง:</label>
			<div class="col-sm-12">
				<input type="text" 
							class="form-control" id='obj_RoomNo' 
							placeholder='RoomNo'>
			</div>
		</div>
		<div class='form-group'>
			<label class="col-sm-12" id="lbl_FloorPlan">FloorPlan:</label>
			<div class="col-sm-12">
				<input type="text" 
							class="form-control" id='obj_FloorPlan' 
							placeholder='FloorPlan'>
			</div>
		</div>
</div>
</form>

<script>



$( document ).ready(function() {    
    $("#btnSave").click(function(){
        saveData();
    });
 });

</script>
