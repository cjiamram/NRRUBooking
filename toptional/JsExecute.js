var regDec = /^\d+(\.\d{1,2})?$/;
var regEmail=/^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/g;
var regTel=/^[+]*[(]{0,1}[0-9]{1,4}[)]{0,1}[-\s\./0-9]*$/g;
var regDate=/(0[1-9]|1[012])[- \/.](0[1-9]|[12][0-9]|3[01])[- \/.](19|20)\d\d/;
function validInput(){
		var flag=true;
		{
			$("#obj_bookingId").focus();
			return flag;
		}
		{
			$("#obj_template").focus();
			return flag;
		}
		{
			$("#obj_description").focus();
			return flag;
		}
		flag=regDec.test($("#obj_quantity").val());
		if (flag==false){
			$("#obj_quantity").focus();
			return flag;
}
		{
			$("#obj_quantity").focus();
			return flag;
		}
		return flag;
}
function displayData(){
		var url="toptional/displayData.php?tableName=t_optional&dbName=dbreserveroom&keyWord="+$("#txtSearch").val();
		$("#tblDisplay").load(url);
}
function createData(){
		var url='toptional/create.php';
		jsonObj={
			bookingId:$("#obj_bookingId").val(),
			template:$("#obj_template").val(),
			description:$("#obj_description").val(),
			quantity:$("#obj_quantity").val()
		}
		var jsonData=JSON.stringify (jsonObj);
		var flag=executeData(url,jsonObj,false);
		return flag;
}
function updateData(){
		var url='toptional/update.php';
		jsonObj={
			bookingId:$("#obj_bookingId").val(),
			template:$("#obj_template").val(),
			description:$("#obj_description").val(),
			quantity:$("#obj_quantity").val(),
			id:$("#obj_id").val()
		}
		var jsonData=JSON.stringify (jsonObj);
		var flag=executeData(url,jsonObj,false);
		return flag;
}
function readOne(id){
		var url='toptional/readOne.php?id='+id;
		data=queryData(url);
		if(data!=""){
			$("#obj_bookingId").val(data.bookingId);
			$("#obj_template").val(data.template);
			$("#obj_description").val(data.description);
			$("#obj_quantity").val(data.quantity);
			$("#obj_id").val(data.id);
		}
}
function saveData(){
		var flag;
		flag=validInput();
		if(flag==true){
					if($("#obj_id").val()!=""){
			flag=updateData();
			}else{
			flag=createData();
		}
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
		}else{
			swal.fire({
			title: "รูปแบบการกรอกข้อมูลไม่ถูกต้อง",
			type: "error",
			buttons: [false, "ปิด"],
			dangerMode: true,
			});
			}
}
function confirmDelete(id){
		swal.fire({
			title: "คุณต้องการที่จะลบข้อมูลนี้หรือไม่?",
			text: "***กรุณาตรวจสอบข้อมูลให้ครบถ้วนก่อนกดปุ่มตกลง",
			type: "warning",
			confirmButtonText: "ตกลง",
			cancelButtonText: "ยกเลิก",
			showCancelButton: true,
			showConfirmButton: true
		}).then((willDelete) => {
		if (willDelete.value) {
			url="toptional/delete.php?id="+id;
			executeGet(url,false,"");
			displayData();
		swal.fire({
			title: "ลบข้อมูลเรียบร้อยแล้ว",
			type: "success",
			buttons: "ตกลง",
		});
		} else {
			swal.fire({
			title: "ยกเลิกการทำรายการ",
			type: "error",
			buttons: [false, "ปิด"],
			dangerMode: true,
		})
		}
		});
}
function clearData(){
			$("#obj_bookingId").val("");
			$("#obj_template").val("");
			$("#obj_description").val("");
			$("#obj_quantity").val("");
}
function genCode(){
		//var url="genCode.php";
		//var data=queryData(url);
		//return data.code;
}
