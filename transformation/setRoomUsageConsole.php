<?php
  include_once "../config/config.php";
  $cnf=new Config();
  $rootPath=$cnf->path;
  $url=$cnf->restURL;
?>

<form role='form'>

<div class="box box-warning">

		<div class='form-group'>
			<label class="col-sm-12">ปีการศึกษา/ภาคการศึกษา:</label>
			<div class="col-sm-3">
				<input type="text" class="form-control"
					value ="<?=date("Y")+543?>"

				 id="obj_yearNo">
			</div>
			<div class="col-sm-3">
				<select class="form-control" id="obj_termNo" is="obj_termNo">
					<option value="1">ภาคการศึกษาที่ 1</option>
					<option value="2">ภาคการศึกษาที่ 2</option>
				</select>
			</div>
			<div class="col-sm-6">&nbsp;
			</div>
		</div>

		<div class='form-group'>
			<label class="col-sm-12">วันที่:</label>
			<div class="col-sm-3">
				<input type="date" class="form-control" id="obj_sDate"
				value="<?=date("Y-m-d")?>"
				>
			</div>
			<div class="col-sm-3">
				<input type="date" class="form-control" 
				value="<?=date("Y-m-d")?>"
				 id="obj_fDate">
			</div>
			<div class="col-sm-6">&nbsp;
			</div>
		</div>
		<div class='form-group'>&nbsp;
		</div>

	<div class='form-group'>
		<div >
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="button" id="btnMigrate" value="ดึงข้อมูล"  class="btn btn-primary" >

		</div>

	</div>
</div>
</form>

<script type="text/javascript">
	function setRoomUsage(){
		var yearNo=$("#obj_yearNo").val();
		var termNo=$("#obj_termNo").val();
		var sDate=$("#obj_sDate").val();
		var fDate=$("#obj_fDate").val();
		var url="<?=$rootPath?>/transformation/setRoomUsage.php?yearNo="+yearNo+"&termNo="+termNo+"&buildingCode=029&sDate="+sDate+"&fDate="+fDate;
		var flag=executeGet(url);
		flag=true;
		if(flag==true){
                  swal.fire({
                          title: "การบันทึกข้อมูลเสร็จสมบูรณ์แล้ว",
                          type: "success",
                          buttons: [false, "ปิด"],
                          dangerMode: true,
                      });
                  displayData();
         }
         else{
                 swal.fire({
                          title: "การบันทึกข้อมูลผิดพลาด",
                          type: "error",
                          buttons: [false, "ปิด"],
                          dangerMode: true,
                      });
         }

	}

	$("#btnMigrate").click(function(){
		setRoomUsage();
	});
</script>