var regDec = /^\d+(\.\d{1,2})?$/;
var regEmail=/^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/g;
var regTel=/^[+]*[(]{0,1}[0-9]{1,4}[)]{0,1}[-\s\./0-9]*$/g;
var regDate=/(0[1-9]|1[012])[- \/.](0[1-9]|[12][0-9]|3[01])[- \/.](19|20)\d\d/;
function validInput(){
		var flag=true;
		{
			$("#obj_title").focus();
			return flag;
		}
		{
			$("#obj_firstName").focus();
			return flag;
		}
		{
			$("#obj_lastName").focus();
			return flag;
		}
		{
			$("#obj_department").focus();
			return flag;
		}
		{
			$("#obj_doc").focus();
			return flag;
		}
		{
			$("#obj_decription").focus();
			return flag;
		}
		{
			$("#obj_projectName").focus();
			return flag;
		}
		{
			$("#obj_telNo").focus();
			return flag;
		}
		{
			$("#obj_lineNo").focus();
			return flag;
		}
		{
			$("#obj_email").focus();
			return flag;
		}
		flag=regDec.test($("#obj_budget").val());
		if (flag==false){
			$("#obj_budget").focus();
			return flag;
}
		{
			$("#obj_budget").focus();
			return flag;
		}
		return flag;
}
function displayData(){
		//var url="/roomReserve/toutsider/displayData.php?tableName=t_outsider&dbName=dbreserveroom&keyWord="+$("#txtSearch").val();
		var url="displayData.php?tableName=t_outsider&dbName=dbreserveroom&keyWord="+$("#txtSearch").val();

		$("#tblDisplay").load(url);
}
function createData(){
		//var url='/roomReserve/toutsider/create.php';
		var url='create.php';

		jsonObj={
			title:$("#obj_title").val(),
			firstName:$("#obj_firstName").val(),
			lastName:$("#obj_lastName").val(),
			department:$("#obj_department").val(),
			doc:$("#obj_doc").val(),
			decription:$("#obj_decription").val(),
			projectName:$("#obj_projectName").val(),
			telNo:$("#obj_telNo").val(),
			lineNo:$("#obj_lineNo").val(),
			email:$("#obj_email").val(),
			budget:$("#obj_budget").val()
		}
		var jsonData=JSON.stringify (jsonObj);
		var flag=executeData(url,jsonObj,false);
		return flag;
}
function updateData(){
		//var url='/roomReserve/toutsider/update.php';
		var url='update.php';

		jsonObj={
			title:$("#obj_title").val(),
			firstName:$("#obj_firstName").val(),
			lastName:$("#obj_lastName").val(),
			department:$("#obj_department").val(),
			doc:$("#obj_doc").val(),
			decription:$("#obj_decription").val(),
			projectName:$("#obj_projectName").val(),
			telNo:$("#obj_telNo").val(),
			lineNo:$("#obj_lineNo").val(),
			email:$("#obj_email").val(),
			budget:$("#obj_budget").val(),
			id:$("#obj_id").val()
		}
		var jsonData=JSON.stringify (jsonObj);
		var flag=executeData(url,jsonObj,false);
		return flag;
}
function readOne(id){
		//var url='/roomReserve/toutsider/readOne.php?id='+id;
		var url='readOne.php?id='+id;

		data=queryData(url);
		if(data!=""){
			$("#obj_title").val(data.title);
			$("#obj_firstName").val(data.firstName);
			$("#obj_lastName").val(data.lastName);
			$("#obj_department").val(data.department);
			$("#obj_doc").val(data.doc);
			$("#obj_decription").val(data.decription);
			$("#obj_projectName").val(data.projectName);
			$("#obj_telNo").val(data.telNo);
			$("#obj_lineNo").val(data.lineNo);
			$("#obj_email").val(data.email);
			$("#obj_budget").val(data.budget);
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
			//url="/roomReserve/toutsider/delete.php?id="+id;
			url="delete.php?id="+id;
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
			$("#obj_title").val("");
			$("#obj_firstName").val("");
			$("#obj_lastName").val("");
			$("#obj_department").val("");
			$("#obj_doc").val("");
			$("#obj_decription").val("");
			$("#obj_projectName").val("");
			$("#obj_telNo").val("");
			$("#obj_lineNo").val("");
			$("#obj_email").val("");
			$("#obj_budget").val("");
}
function genCode(){
		//var url="genCode.php";
		//var data=queryData(url);
		//return data.code;
}
