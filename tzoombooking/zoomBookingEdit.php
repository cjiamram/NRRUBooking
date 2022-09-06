<?php
  session_start();
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
<input type="hidden" id="obj_licenseId">
<div class="box-body">
	
		      
    <div class='form-group'>
      <label class="col-sm-12" id="lblActivity">หัวข้อการจอง:</label>
      <div class="col-sm-12">
        <textarea id="obj_activity" class="form-control"  rows="2" cols="50">
        </textarea>
        
      </div>
    </div>

      <div class='form-group'>
      <label class="col-sm-12" id="lblBookingName">ผู้จอง:</label>
      <div class="col-sm-12">
        <input type="text" 
              class="form-control" id='obj_bookingName'
              value=<?=$_SESSION["FullName"]?> 
              placeholder='bookingName'>
      </div>
    </div>
     <div class='form-group'>
      <label class="col-sm-12" id="lblBookingName">หน่วยงาน:</label>
      <div class="col-sm-12">
        <select id="obj_department" class="form-control"></select>
      </div>
    </div>
      <div class='form-group'>
      <label class="col-sm-12" id="lblBookingName">วัตถุประสงค์:</label>
      <div class="col-sm-12">
        <select id="obj_objective" class="form-control"></select>
      </div>
    </div>


   

    <div class='form-group'>
			<label class="col-sm-12"  id="lblBookingDate">กำหนดวัน-เวลา :</label>
			<div class="col-sm-12">
				<table width="100%">
          <tr>
            <td width="100px">
                <div class="input-group date">
                <div class="input-group-addon">
                <i class="fa fa-calendar"></i>
                </div>
                <input type="date" class="form-control" disabled="disabled" id="obj_bookingDate">
                </div>
            </td>
            <td width="10px">-
            </td>
            <td>
               <table width="100%">
              <tr>
              <td>
              <select class="form-control" disabled="disabled" id="obj_sHr"></select>
              </td>
              <td align='center' width="10px">:
              </td>
              <td>
              <select class="form-control" disabled="disabled" id="obj_sMn"></select>

              </td>
              </tr>
              </table>
            </td>
            <td width="10px" align="center">-
            </td>
            <td>
              <table width="100%">
              <tr>
              <td>
              <select class="form-control" disabled="disabled" id="obj_fHr"></select>
              </td>
              <td align='center' width="10px">:
              </td>
              <td>
              <select class="form-control" disabled="disabled" id="obj_fMn"></select>

              </td>
              </tr>
              </table>
            </td>
          </tr>
        </table>
			</div>
		</div>
	
	
		<div class='form-group'>
			<label class="col-sm-12" id="lblTelNo">โทรศัพท์/E-Mail:</label>
			<div class="col-sm-12">
				<table width="100%">
          <tr>
            <td>
              <input type="text" 
              class="form-control" id='obj_telNo' 
              placeholder='telNo'>
            </td>
            <td width="10px">/</td>
            <td>
                <input type="text" 
              class="form-control" id='obj_lineNo' 
              value='<?=$_SESSION["UserCode"]."@nrru.ac.th"?>'
              placeholder='xxxxx@nrru.ac.th'>
            </td>
          </tr>
        </table>
			</div>
		</div>
		
	


</div>

<script >
    
  

   var headURl='<?=$url?>';

    function listHr(){
      cb="";
      for(i=1;i<=23;i++){
          objHr=(i<10)?"0"+i:i;
          cb+="<option value="+objHr+">"+objHr+"</option>";
      }
      $("#obj_sHr").html(cb);
      $("#obj_fHr").html(cb);
    }

    function listDepartment(){
      var url="<?=$rootPath?>/tdepartment/listDepartment.php";
      setDDLPrefix(url,"#obj_department","***หน่วยงาน***");
    }

    function listObjective(){
      var url="<?=$rootPath?>/tbookingobjective/listObjective.php";
      setDDLPrefix(url,"#obj_objective","***วัตถุประสงค์***");
      $("#obj_objective").prop("selectedIndex", 1);
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

    function readOne(id){
      var url="<?=$rootPath ?>/tzoombooking/readOne.php?id="+id;
      var data=queryData(url);

     
      if(data!=""){
          $("#obj_id").val(data.id);
          $("#obj_licenseId").val(data.zoomCode);
          $("#bookingDate").val(data.bookingDate);
          var sDates=data.startTime.split(":");
          var fDates=data.finishTime.split(":");
          $("#obj_sHr").val(sDates[0]);
          $("#obj_sMn").val(sDates[1]);
          $("#obj_fHr").val(fDates[0]);
          $("#obj_fMn").val(fDates[1]);
          $("#obj_bookingName").val(data.bookingName);
          $("#obj_activity").val(data.activity);
          $("#obj_telNo").val(data.telNo);
          $("#obj_lineNo").val(data.lineNo);
          $("#obj_department").val(data.departmentId);
          $("#obj_objective").val(data.objective);
      }

    }


    function updateData(){
    	var url="<?=$rootPath ?>/tzoombooking/update.php";
    	var jsonObj={
        zoomCode:$("#obj_licenseId").val(),
    		bookingDate:$("#obj_bookingDate").val(),
    		startTime:$("#obj_sHr").val()+":"+$("#obj_sMn").val(),
    		finishTime:$("#obj_fHr").val()+":"+$("#obj_fMn").val(),
    		bookingName:$("#obj_bookingName").val(),
    		staffId:$("#obj_staffId").val(),
    		activity:$("#obj_activity").val(),
    		telNo:$("#obj_telNo").val(),
    		lineNo:$("#obj_lineNo").val(),
    		status:0,
        outsiderId:0,
        objective:$("#obj_objective").val(),
        departmentId:$("#obj_department").val(),
        id:$("#obj_id").val()
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
   
        if($("#obj_lineNo").val()===""){
          swal.fire({
                            title: "กรุณาระบุ E-mail ของท่านเพื่อสะดวกในการ ส่ง Meeting Link",
                            type: "error",
                            buttons: [false, "ปิด"],
                            dangerMode: true,
                        });
          return ;
      }
      
    	

      var flag=updateData();
    	if(flag===true){
                  //sendNotify();
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
          listDepartment();
          listObjective();
          $("#obj_objective option:first").attr('selected','selected');
          listHr();
          listMn();
          readOne(<?=isset($_GET["id"])?$_GET["id"]:0?>);

          $("#btnSave").click(function(){
               saveZoomBooking();
               $("#modal-input").modal("hide");
          });
     });

</script>

