<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type,Access-Control-Allow-Headers, Authorization, X-Requested-With");
include_once "../config/database.php";
include_once "../objects/tcancelbooking.php";
include_once "../objects/classLabel.php";
$database = new Database();
$db = $database->getConnection();
$objLbl = new ClassLabel($db);
$bookingId=isset($_GET["bookingId"])?$_GET["bookingId"]:0;
?>
<form role='form'>
<div class="box-body">


		<input type="hidden" id="obj_bookingId" value='<?=$bookingId?>'>

		<div class='form-group'>
			<label class="col-sm-12"><?php echo $objLbl->getLabel("t_cancelbooking","cancelDate","th").":" ?></label>
			<div class="col-sm-12">
				<div class="input-group date">
				<div class="input-group-addon">
				<i class="fa fa-calendar"></i>
				</div>
				<input type="date" class="form-control" id="obj_cancelDate">
				</div>
			</div>
		</div>
		<div class='form-group'>
			<label class="col-sm-12"><?php echo $objLbl->getLabel("t_cancelbooking","reason","th").":" ?></label>
			<div class="col-sm-12">
				<textarea class="form-control" id="obj_reason" 
				rows="4" cols="50"
				></textarea>
			</div>
		</div>
</div>
</form>

<script>

	

	$(document).ready(function(){
		var d = new Date();
		var cDate=getSystemDate(d);
		$("#obj_cancelDate").val(cDate);
	});

</script>
