<?php
  include_once "../config/config.php";
  $cnf=new Config();
  $url=$cnf->restURL;
  $rootPath=$cnf->path;
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
      <label class="col-sm-12"  id="lblZoomCode">License Id:</label>
      <div class="col-sm-12">
        <select id="obj_zoomCode" class="form-control">
        </select>
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


    function createData(){
    	var url="<?=$rootPath ?>/tzoombooking/createByAdmin.php";
    	var jsonObj={
        zoomCode:$("#obj_zoomCode").val(),
    		bookingDate:$("#obj_bookingDate").val(),
    		startTime:$("#obj_sHr").val()+":"+$("#obj_sMn").val(),
    		finishTime:$("#obj_fHr").val()+":"+$("#obj_fMn").val(),
    		bookingName:$("#obj_bookingName").val(),
    		staffId:$("#obj_staffId").val(),
    		activity:$("#obj_activity").val(),
    		telNo:$("#obj_telNo").val(),
    		lineNo:$("#obj_lineNo").val(),
    		status:1,
        outsiderId:0
    	};
    	var jsonData=JSON.stringify (jsonObj);
    	console.log(jsonData);
    	var flag=executeData(url,jsonObj,false);
    	return flag;
    }

    function getZoomBookingLastId(){
      var url ="<?=$rootPath?>/tzoombooking/getZoomBookingLastId.php";
      var data=queryData(url);
      return data.MxId;
    }

  

    function sendNotify(){
        var id=getZoomBookingLastId();
        var url="<?=$rootPath ?>/tzoombooking/displayZoomNotify.php?id="+id;
        var data=queryData(url);
        url="<?=$rootPath ?>/lineBot/sendZoomNotify.php";
        var jsonObj={
          message:data.message
        }

        var jsonData=JSON.stringify(jsonObj);
        executeData(url,jsonObj,false);

    }

    function saveZoomBooking(){
   
    	var flag=createData();
    	if(flag==true){
                  sendNotify();
                  swal.fire({
                          title: "การบันทึกข้อมูลเสร็จสมบูรณ์แล้ว",
                          type: "success",
                          buttons: [false, "ปิด"],
                          dangerMode: true,
                      });
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
         	$("#obj_activity").val("");
          $("#btnSave").click(function(){
              saveZoomBooking();
               $("#modal-input").modal("hide");
          });
     });

</script>

