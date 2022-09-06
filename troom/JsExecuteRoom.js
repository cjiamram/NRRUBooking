var full = location.pathname;
		//var path = full.substr(full.lastIndexOf("/") + 0);
var res = full.split("/");
var rootPath="/"+res[1];


function validInputRoom(){
		var flag=true;
		
		flag=regDec.test($("#obj_ComputerNo").val());
		if (flag==false){
			$("#obj_ComputerNo").focus();
			return flag;
		}
		
		flag=regDec.test($("#obj_DeskNo").val());
		if (flag==false){
			$("#obj_DeskNo").focus();
			return flag;
		}
		
		flag=regDec.test($("#obj_FloorNo").val());
		if (flag==false){
			$("#obj_FloorNo").focus();
			return flag;
		}
		
		return flag;
}



function createRoomData(){
		//var url='/roomReserve/troom/create.php';
		var url=rootPath+'/troom/create.php';

		jsonObj={
			RoomNo:$("#obj_RoomNo_1").val(),
			ComputerNo:$("#obj_ComputerNo").val(),
			DeskNo:$("#obj_DeskNo").val(),
			Accessory:$("#obj_Accessory").val(),
			Status:$("#obj_Status").val(),
			FloorNo:$("#obj_FloorNo_1").val(),
			Building:$("#obj_buildingId").val()

		}
		var jsonData=JSON.stringify (jsonObj);
		console.log(jsonData);
		var flag=executeData(url,jsonObj,false);
		return flag;
}
function updateRoomData(){
		//var url='/roomReserve/troom/update.php';
		var url=rootPath+'/troom/update.php';
		//console.log(url);

		jsonObj={
			RoomNo:$("#obj_RoomNo_1").val(),
			ComputerNo:$("#obj_ComputerNo").val(),
			DeskNo:$("#obj_DeskNo").val(),
			Accessory:$("#obj_Accessory").val(),
			Status:$("#obj_Status").val(),
			FloorNo:$("#obj_FloorNo_1").val(),
			Building:$("#obj_buildingId").val(),
			id:$("#obj_roomId").val()
		}
		var jsonData=JSON.stringify (jsonObj);
		console.log(jsonData);
		var flag=executeData(url,jsonObj,false);
		//displayDataRoom($("#obj_buildingId").val());
		return flag;
}
function readOneRoom(id){
		//var url='/roomReserve/troom/readOne.php?id='+id;

		var url=rootPath+'/troom/readOne.php?id='+id;

		data=queryData(url);
		console.log(url);
		if(data!=""){
			$("#obj_RoomNo_1").val(data.RoomNo);
			$("#obj_ComputerNo").val(data.ComputerNo);
			$("#obj_DeskNo").val(data.DeskNo);
			$("#obj_Accessory").val(data.Accessory);
			$("#obj_Status").val(data.Status);
			$("#obj_FloorNo_1").val(data.FloorNo);
			$("#obj_buildingId").val(data.Building);
			$("#obj_roomId").val(data.id);

		}
}
function saveDataRoom(){
		var flag;
		flag=validInput();
		//console.log($("#obj_roomId").val());
		if(flag==true){
			if($("#obj_roomId").val()!=""){
				flag=updateRoomData();
			}else{
				flag=createRoomData();
		}
		//displayRoomData($("#obj_buildingId").val());
		if(flag==true){
			swal.fire({
			title: "การบันทึกข้อมูลเสร็จสมบูรณ์แล้ว",
			type: "success",
			buttons: [false, "ปิด"],
			dangerMode: true,
		});
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
function confirmDeleteRoom(id){
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
			var url=rootPath+"/troom/delete.php?id="+id;
			executeGet(url,false,"");
			displayDataRoom($("#obj_buildingId").val());
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
function clearRoomData(){
			$("#obj_RoomNo_1").val("");
			$("#obj_ComputerNo").val("");
			$("#obj_DeskNo").val("");
			$("#obj_Accessory").val("");
			$("#obj_Status").val("");
			$("#obj_FloorNo_1").val("");
			$("#obj_buildingId").val("");
			$("#obj_roomId").val("");
}
function genCode(){
		
}
