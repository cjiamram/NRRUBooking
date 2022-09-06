<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type,Access-Control-Allow-Headers, Authorization, X-Requested-With");
include_once "../config/database.php";
include_once "../objects/tzoomlicense.php";
include_once "../objects/classLabel.php";
$database = new Database();
$db = $database->getConnection();
$objLbl = new ClassLabel($db);
?>
<form role='form'>
<div class="box-body">
		<div class='form-group'>
			<label class="col-sm-12"><?php echo $objLbl->getLabel("t_zoomlicense","zoomCode","th").":" ?></label>
			<div class="col-sm-12">
				<!--<input type="text" 
							class="form-control" id='obj_zoomCode' 
							placeholder='zoomCode'>-->
					<div class="input-group date">
						<input type="text" class="form-control pull-right" placeholder='zoomCode' id="obj_zoomCode">
						<div class="input-group-addon">
						<a id="btnGen" href="#"><i class="fa fa-key" ></i></a>
						</div>
				</div>
			</div>
		</div>
		<div class='form-group'>
			<label class="col-sm-12"><?php echo $objLbl->getLabel("t_zoomlicense","redirect uri","th").":" ?></label>
			<div class="col-sm-12">
				<input type="text" 
							class="form-control" placeholder='redirect uri'  disable='true' id='obj_uri' 
							>
			</div>
		</div>
		<div class='form-group'>
			<label class="col-sm-12"><?php echo $objLbl->getLabel("t_zoomlicense","zoomDetail","th").":" ?></label>
			<div class="col-sm-12">
				<input type="text" 
							class="form-control" id='obj_zoomDetail' 
							placeholder='zoomDetail'>
			</div>
		</div>
		<div class='form-group'>
			<label class="col-sm-12"><?php echo $objLbl->getLabel("t_zoomlicense","status","th").":" ?></label>
			<div class="col-sm-12">
				<input type="text" 
							class="form-control" id='obj_status' 
							placeholder='status'>
			</div>
		</div>
		<div class='form-group'>
			<label class="col-sm-12"><?php echo $objLbl->getLabel("t_zoomlicense","clientId","th").":" ?></label>
			<div class="col-sm-12">
				<input type="text" 
							class="form-control" id='obj_clientId' 
							placeholder='clientId'>
			</div>
		</div>
		<div class='form-group'>
			<label class="col-sm-12"><?php echo $objLbl->getLabel("t_zoomlicense","secreteId","th").":" ?></label>
			<div class="col-sm-12">
				<input type="text" 
							class="form-control" id='obj_secreteId' 
							placeholder='secreteId'>
			</div>
		</div>
		<!--<div class='form-group'>
			<label class="col-sm-12"><?php echo $objLbl->getLabel("t_zoomlicense","redirectURI","th").":" ?></label>
			<div class="col-sm-12">
				<input type="text" 
							class="form-control" id='obj_redirectURI' 
							placeholder='redirectURI'>
			</div>
		</div>-->
</div>
</form>
<script>


	$(document).ready(function(){
		$("#btnGen").click(function(){
			 genURI();
		});
	});
</script>
