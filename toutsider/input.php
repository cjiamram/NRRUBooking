<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type,Access-Control-Allow-Headers, Authorization, X-Requested-With");
include_once "../config/database.php";
include_once "../objects/toutsider.php";
include_once "../objects/classLabel.php";
$database = new Database();
$db = $database->getConnection();
$objLbl = new ClassLabel($db);
?>
<form role='form'>
<div class="box-body">
		<div class='form-group'>
			<label class="col-sm-12"><?php echo $objLbl->getLabel("t_outsider","Outsider","th").":"; ?></label>
			<div class="col-sm-12">
			<table width="100%">
				<tr>
				<td width="150px">
					<input type="text" 
							class="form-control" id='obj_title' 
							placeholder='title'>
				</td>
				<td>&nbsp;
				</td>
				<td>
					<input type="text" 
							class="form-control" id='obj_firstName' 
							placeholder='firstName'>
				</td>
				<td>&nbsp;
				</td>
				<td>
					<input type="text" 
							class="form-control" id='obj_lastName' 
							placeholder='lastName'>
				</td>
				</tr>
			</table>
			</div>
		</div>
		
		<div class='form-group'>
			<label class="col-sm-12"><?php echo $objLbl->getLabel("t_outsider","department","th").":"; ?></label>
			<div class="col-sm-12">
				<input type="text" 
							class="form-control" id='obj_department' 
							placeholder='department'>
			</div>
		</div>
		
		<div class='form-group'>
			<label class="col-sm-12"><?php echo $objLbl->getLabel("t_outsider","projectName","th").":"; ?></label>
			<div class="col-sm-12">
				<input type="text" 
							class="form-control" id='obj_projectName' 
							placeholder='projectName'>
			</div>
		</div>
		<div class='form-group'>
			<label class="col-sm-12"><?php echo $objLbl->getLabel("t_outsider","decription","th").":"; ?></label>
			<div class="col-sm-12">
				<input type="text" 
							class="form-control" id='obj_decription' 
							placeholder='decription'>
			</div>
		</div>

		<div class='form-group'>
			<label class="col-sm-12"><?php echo $objLbl->getLabel("t_outsider","telNo","th").":"; ?></label>
			<div class="col-sm-12">
				<input type="text" 
							class="form-control" id='obj_telNo' 
							placeholder='telNo'>
			</div>
		</div>
		<div class='form-group'>
			<label class="col-sm-12"><?php echo $objLbl->getLabel("t_outsider","lineNo","th").":"; ?></label>
			<div class="col-sm-12">
				<input type="text" 
							class="form-control" id='obj_lineNo' 
							placeholder='lineNo'>
			</div>
		</div>
		<div class='form-group'>
			<label class="col-sm-12"><?php echo $objLbl->getLabel("t_outsider","email","th").":"; ?></label>
			<div class="col-sm-12">
				<input type="text" 
							class="form-control" id='obj_email' 
							placeholder='email'>
			</div>
		</div>
		<div class='form-group'>
			<label class="col-sm-12"><?php echo $objLbl->getLabel("t_outsider","budget","th").":"; ?></label>
			<div class="col-sm-12">
				<input type="text" 
							class="form-control" id='obj_budget' 
							placeholder='budget'>
			</div>
		</div>
		<div class='form-group'>
			<label class="col-sm-12"><?php echo $objLbl->getLabel("t_outsider","doc","th").":"; ?></label>
			<div class="col-sm-12">
				<input type="file" 
							class="form-control" id='obj_doc' 
							placeholder='doc' onchange="readFile(this)">
				<input type="hidden" id="obj_fileAttach" >
			</div>
		</div>
</div>
</form>

<script>
 function readFile(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#obj_fileAttach').val(e.target.result);
                    
            };
            reader.readAsDataURL(input.files[0]);
        }
    }

</script>
