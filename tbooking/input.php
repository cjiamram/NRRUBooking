<?php
  include_once "../config/config.php";
  $cnf=new Config();
  $rootPath=$cnf->path;
  $url=$cnf->restURL;
?>
<style type="text/css">
.without_ampm::-webkit-datetime-edit-ampm-field {
   display: none;
 }
 input[type=time]::-webkit-clear-button {
   -webkit-appearance: none;
   -moz-appearance: none;
   -o-appearance: none;
   -ms-appearance:none;
   appearance: none;
   margin: -10px; 
 }

</style>
<div class="box-body">
		<div class='form-group'>
			<label class="col-sm-12" id="lblBookingRoom">ระบุห้อง:</label>
			
			<div class="col-sm-12">
			
				<select class="form-control" id='obj_bookingRoom' ></select>
			</div>
		</div>
		<div class='form-group'>
			<label class="col-sm-12"  id="lblBookingDate">กำหนดวัน:</label>
			<div class="col-sm-12">
				<div class="input-group date">
				<div class="input-group-addon">
				<i class="fa fa-calendar"></i>
				</div>
				<input type="date" class="form-control" id="obj_bookingDate">
				</div>
			</div>
		</div>
		<div class='form-group'>
			<label class="col-sm-12" id="lblBookingTime">ช่วงเวลาใช้บริการ:</label>
			<div class="col-sm-6">
        <table width="70%">
          <tr>
            <td>
              <select class="form-control" id="obj_sHr"></select>
            </td>
            <td align='center' width="10px">:
            </td>
            <td>
              <select class="form-control" id="obj_sMn"></select>

            </td>
          </tr>
        </table>
			</div>
			<div class="col-sm-6">
			
        <table width="70%">
          <tr>
            <td>
              <select class="form-control" id="obj_fHr"></select>
            </td>
            <td align='center' width="10px">:
            </td>
            <td>
              <select class="form-control" id="obj_fMn"></select>

            </td>
          </tr>
        </table>
			</div>
		</div>
		
		<div class='form-group'>
			<label class="col-sm-12" id="lblBookingName">ผู้จอง:</label>
			<div class="col-sm-12">
				<input type="text" 
							class="form-control" id='obj_bookingName' 
							placeholder='bookingName'>
			</div>
		</div>
		<div class='form-group'>
			<label class="col-sm-12" id="lblTelNo">Tel:</label>
			<div class="col-sm-12">
				<input type="text" 
							class="form-control" id='obj_telNo' 
							placeholder='telNo'>
			</div>
		</div>
		<div class='form-group'>
			<label class="col-sm-12" id="lblLineNo">Line:</label>
			<div class="col-sm-12">
				<input type="text" 
							class="form-control" id='obj_lineNo' 
							placeholder='lineNo'>
			</div>
		</div>
	
		
		<div class='form-group'>
			<label class="col-sm-12" id="lblActivity">รายละเอียดการจอง:</label>
			<div class="col-sm-12">

				<textarea id="obj_activity" class="form-control"  rows="4" cols="50">
				</textarea>

				
			</div>
		</div>

</div>

<script >
    
   var bookingRoom='<?php 
      if(isset($_GET["bookingRoom"])){
        echo $_GET["bookingRoom"];
      }else{
        echo "";
      }

   ?>';

   var headURl='<?php 
      echo $url;
   ?>';

    function listHr(){
      cb="";
      for(i=7;i<=17;i++){
          objHr=(i<10)?"0"+i:i;
          cb+="<option value="+objHr+">"+objHr+"</option>";
      }
      $("#obj_sHr").html(cb);
      $("#obj_fHr").html(cb);


    }

    function listMn(){
      cb="";
      for(i=0;i<60;i+=5){
          objHr=(i<10)?"0"+i:i;
          cb+="<option value="+objHr+">"+objHr+"</option>";
      }
      $("#obj_sMn").html(cb);
      $("#obj_fMn").html(cb);

    }

	  function listBookingBuilding(){
      var url="tbuilding/listBuilding.php";
      setDDL(url,"#obj_bookingBuilding");
    }

    function listBookingRoom(building){
      var url="troom/listRoom.php?building="+building;
      setDDL(url,"#obj_bookingRoom");
      $("#obj_bookingRoom").val(bookingRoom);
    }

    function createData(){
    	var url="<?=$rootPath?>/tbooking/create.php";
    	var jsonObj={
    		bookingRoom:$("#obj_bookingRoom").val(),
    		bookingDate:$("#obj_bookingDate").val(),
    		startTime:$("#obj_sHr").val()+":"+$("#obj_sMn").val(),
    		finishTime:$("#obj_fHr").val()+":"+$("#obj_fMn").val(),
    		bookingName:$("#obj_bookingName").val(),
    		staffId:$("#obj_staffId").val(),
    		activity:$("#obj_activity").val(),
    		telNo:$("#obj_telNo").val(),
    		lineNo:$("#obj_lineNo").val(),
    		status:0,
        outsiderId:0
    	};
    	var jsonData=JSON.stringify (jsonObj);
    	console.log(jsonData);
    	var flag=executeData(url,jsonObj,false);
    	return flag;
    }

    function isExist(){
      var sTime=$("#obj_sHr").val()+":"+$("#obj_sMn").val();
      var fTime=$("#obj_fHr").val()+":"+$("#obj_fMn").val();
    	var url="<?=$rootPath?>/tbooking/isExist.php?roomNo="+$("#obj_bookingRoom").val()+"&bookingDate="+$("#obj_bookingDate").val()+"&sTime="+sTime+"&fTime="+fTime;
    	var data=queryData(url);
    	return data.flag;
    }

    function getBookingLastId(){
      var url ="<?=$rootPath?>/tbooking/getLastId.php";
      var data=executeGet(url);
      return data.MxId;
    }

    function sendNotify(){
        var id=getBookingLastId();
        var url="<?=$rootPath?>/tbooking/displayNotify.php?id="+id;
        var data=queryData(url);
        url="<?=$rootPath?>/lineBot/sendNotify.php";
        var link=headURl+'tbooking/displayBookingDetail.php?bookingId='+id;
        var jsonObj={
          message:data.message+link
        }

        var jsonData=JSON.stringify(jsonObj);
        executeData(url,jsonObj,false);

    }

    function saveData(){
    	if (isExist()){
    		 swal.fire({
                          title: "กรุณาตรวจสอบช่วงเวลาการจองอีกครั้งช่วงเวลามีการซ้อนทับ",
                          type: "error",
                          buttons: [false, "ปิด"],
                          dangerMode: true,
                      });
    		 return ;
    	}
    	var flag=createData();
    	if(flag==true){
                  sendNotify();
                  swal.fire({
                          title: "การบันทึกข้อมูลเสร็จสมบูรณ์แล้ว",
                          type: "success",
                          buttons: [false, "ปิด"],
                          dangerMode: true,
                      });
                  $("#obj_Room").val($("#obj_bookingRoom").val());
                  displayCalendar();
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

    function formatDate(date) {
        var year = date.getFullYear().toString();
        var month = (date.getMonth() + 101).toString().substring(1);
        var day = (date.getDate() + 100).toString().substring(1);
        return year + "-" + month + "-" + day;
    }


     $( document ).ready(function() {
      setCurrentSysDate("#obj_bookingDate")
      listHr();
      listMn();
     	listBookingRoom("");
     	$("#obj_activity").val("");

     	$("#obj_bookingBuilding").click(function(){
        	listBookingRoom($("#obj_bookingBuilding").val());
      	});

      	$("#btnSave").click(function(){
      		 if($("#dvModalContain").html()!=""){
      			saveData();
      		 }
      		$("#dvModalContain").html("");
      	});


     });

</script>

