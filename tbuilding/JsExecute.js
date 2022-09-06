var full = location.pathname;
		//var path = full.substr(full.lastIndexOf("/") + 0);
var res = full.split("/");
var rootPath="/"+res[1];






var regDec = /^\d+(\.\d{1,2})?$/;
var regEmail=/^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/g;
var regTel=/^[+]*[(]{0,1}[0-9]{1,4}[)]{0,1}[-\s\./0-9]*$/g;
var regDate=/(0[1-9]|1[012])[- \/.](0[1-9]|[12][0-9]|3[01])[- \/.](19|20)\d\d/;
function validInput(){
		var flag=true;
		return flag;
}

function createData(){
		var url='/NRRUBooking/tbuilding/create.php';
		jsonObj={
			BuildingNo:$("#obj_BuildingNo").val(),
			BuildingName:$("#obj_BuildingName").val(),
			FloorNo:$("#obj_FloorNo").val(),
			RoomNo:$("#obj_RoomNo").val(),
			FloorPlan:$("#obj_FloorPlan").val()
		}
		var jsonData=JSON.stringify (jsonObj);
		var flag=executeData(url,jsonObj,false);
		console.log(flag);
		return flag;
}
function updateData(){
		var url='/NRRUBooking/tbuilding/update.php';
		jsonObj={
			BuildingNo:$("#obj_BuildingNo").val(),
			BuildingName:$("#obj_BuildingName").val(),
			FloorNo:$("#obj_FloorNo").val(),
			RoomNo:$("#obj_RoomNo").val(),
			FloorPlan:$("#obj_FloorPlan").val(),
			id:$("#obj_id").val()
		}
		var jsonData=JSON.stringify (jsonObj);
		var flag=executeData(url,jsonObj,false);
		return flag;
}
function readOne(id){
		var url='/NRRUBooking/tbuilding/readOne.php?id='+id;

		console.log(url);
		data=queryData(url);
		if(data!=""){
			$("#obj_BuildingNo").val(data.BuildingNo);
			$("#obj_BuildingName").val(data.BuildingName);
			$("#obj_FloorNo").val(data.FloorNo);
			$("#obj_RoomNo").val(data.RoomNo);
			$("#obj_FloorPlan").val(data.FloorPlan);
			$("#obj_id").val(data.id);
		}
}
function saveData(){
		var flag;
		flag=validInput();
		var flag=true;
		//console.log($("#obj_id").val());
		if(flag==true){
			if($("#obj_id").val()!=""){
			flag=updateData();
			console.log("update");
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
			url="/roomReserve/tbuilding/delete.php?id="+id;
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
			$("#obj_BuildingNo").val("");
			$("#obj_BuildingName").val("");
			$("#obj_FloorNo").val("");
			$("#obj_RoomNo").val("");
			$("#obj_FloorPlan").val("");
}
function genCode(){
}
