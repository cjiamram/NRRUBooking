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

 img {
  display: block;
  margin-left: auto;
  margin-right: auto;
  width:200px;
}

</style>

<div class="box-body">

      <div class='form-group'>
      <label class="col-sm-12" id="lblActivity">รายละเอียดการจอง:</label>
      <div class="col-sm-12">

        <textarea id="obj_activity" class="form-control"  rows="2" cols="50">
        </textarea>

        
      </div>
    </div>
    <div class='form-group'>
      <label class="col-sm-12" id="lblZoomCode">License:</label>
      <div class="col-sm-12">
        <select id="obj_zoomCode_1" class="form-control"></select>
      </div>
    </div>

      <div class='form-group'>
      <label class="col-sm-12" id="lblBookingName">ผู้จอง:</label>
      <div class="col-sm-12">
        <input type="text" 
              class="form-control" id='obj_bookingName' 
              value='<?=$_SESSION["FullName"]?>' 
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
      <label class="col-sm-12"  id="lblBookingDate">กำหนดวัน-เวลาเริ่ม:จำนวนชั่วโมง</label>
      <div class="col-sm-12">
        <table width="100%">
          <tr>
            <td width="100px">
                <div class="input-group date">
                <div class="input-group-addon">
                <i class="fa fa-calendar"></i>
                </div>
                <input type="date" class="form-control" id="obj_bookingDate" onchange="setDurationDateTime()">
                </div>
            </td>
            <td width="10px">-
            </td>
            <td width='30%'>
               <table width="100%">
              <tr>
              <td>
              <select class="form-control" onchange="setDurationDateTime()" id="obj_sHr"></select>
              </td>
              <td align='center' width="10px">:
              </td>
              <td>
              <select class="form-control" onchange="setDurationDateTime()" id="obj_sMn"></select>

              </td>
              </tr>
              </table>
            </td>
            <td width="10px" align="center">:
            </td>
            <td>
              <select id="obj_timeDuration" onchange="setDurationDateTime()" class="form-control"></select>
             
            </td>
            <td>:ชั่วโมง
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

    <div id="dvFinishTime"  style="display:none"  class='form-group'>
   
        <div class="col-sm-12">
        <table width="100%">
          <tr>
            <td width="100px">
                <div class="input-group date">
                <div class="input-group-addon">
                <i class="fa fa-calendar"></i>
                </div>
                <input type="date" class="form-control" id="obj_finishDate">
                </div>
            </td>
            <td width="10px">-
            </td>
            <td width='30%'>
               <table width="100%">
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
            </td>
            <td width="10px" align="center">:
            </td>
            <td>
             
            </td>
          </tr>
        </table>
      </div>
    </div>
  
  
	
		
	
	
		
	

</div>

<script >
    
  

   var headURl="<?=$url?>";

   function setDurationDateTime(){
      var sDate=$("#obj_bookingDate").val();
      var sTime=$("#obj_sHr").val()+":"+$("#obj_sMn").val();
      var duration=$("#obj_timeDuration").val();
      var url="<?=$rootPath?>/tzoombooking/getDurationDateTime.php?sDate="+sDate+"&sTime="+sTime+"&duration="+duration;
      var data=queryData(url);
      //console.log(url);
     
      $("#obj_finishDate").val(data.date);
      var times = data.time.split(":");
      $("#obj_fHr").val(times[0]);
      $("#obj_fMn").val(times[1]);
    }


  function listZoomLicense_1(){
    var url="<?=$rootPath?>/tzoomlicense/listLicenseAdmin.php";
    setDDLPrefix(url,"#obj_zoomCode_1","***ทั้งหมด***");
    $("#obj_zoomCode_1").prop("selectedIndex", 0);
  }
    

    function listHr(){
      cb="";
      for(i=1;i<=23;i++){
          objHr=(i<10)?"0"+i:i;
          cb+="<option value="+objHr+">"+objHr+"</option>";
      }
      $("#obj_sHr").html(cb);
      $("#obj_fHr").html(cb);


    }

    function listMn(){
      cb="";
      for(i=0;i<60;i+=15){
          objHr=(i<10)?"0"+i:i;
          cb+="<option value="+objHr+">"+objHr+"</option>";
      }
      $("#obj_sMn").html(cb);
      $("#obj_fMn").html(cb);

    }

    function listDuration(){
      cb="";
      for(i=1;i<=6;i++){
          cb+="<option value="+i+">"+i+"</option>";
      }
      $("#obj_timeDuration").html(cb);
      
    }

    function executeReturnData(url,jsonObj){
    var jsonData=JSON.stringify (jsonObj);
    var execData;
      $.ajax({
        //**************
          url: url,
          contentType: "application/json; charset=utf-8",
          type: "POST",
          dataType: "json",
          data:jsonData,
          async:false,
          success: function(data){
            execData=data;
          } 
        //**************
      });
      return execData;
  }



    function createData(){
    	//var url="<?=$rootPath ?>/tzoombooking/createByAdmin.php";
    	var url="<?=$rootPath ?>/tzoombooking/createByAdminWithLastId.php";
      var jsonObj={
        zoomCode:$("#obj_zoomCode_1").val(),
    		bookingDate:$("#obj_bookingDate").val(),
    		startTime:$("#obj_sHr").val()+":"+$("#obj_sMn").val(),
    		finishTime:$("#obj_fHr").val()+":"+$("#obj_fMn").val(),
    		bookingName:$("#obj_bookingName").val(),
    		staffId:$("#obj_staffId").val(),
    		activity:$("#obj_activity").val(),
    		telNo:$("#obj_telNo").val(),
    		lineNo:$("#obj_lineNo").val(),
    		status:1,
        outsiderId:0,
        objective:$("#obj_objective").val(),
        departmentId:$("#obj_department").val(),
        finishDate:$("#obj_finishDate").val(),
        timeDuration:$("#obj_timeDuration").val()
    	};
    	var jsonData=JSON.stringify (jsonObj);
      console.log(jsonData);
    	var data=executeReturnData(url,jsonObj);
      console.log(data);
    	return data;
    }

    function getZoomBookingLastId(){
      var url ="<?=$rootPath?>/tzoombooking/getZoomBookingLastId.php";
      var data=queryData(url);
      return data.MxId;
    }

  

    function sendNotify(id){
        //var id=getZoomBookingLastId();
        var url="<?=$rootPath ?>/tzoombooking/displayZoomNotify.php?id="+id;
        var data=queryData(url);
        url="<?=$rootPath ?>/lineBot/sendZoomNotify.php";
        var jsonObj={
          message:data.message
        }

        var jsonData=JSON.stringify(jsonObj);
        executeData(url,jsonObj,false);

    }

function executeProgress(url,container){
    var result;
    $.ajax({
      type:'GET',
      url:url,
      dataType:'json',
      async:false,
      success:function(data){
       result=data;
      },
      beforeSend: function(){
         $(container).html('<img src="<?=$rootPath?>/img/Loading.gif" alt="Wait" />');

     },
     complete: function(){
        $(container).html('');
         displayCalendar();
     }
    });
    return result;
  }


 function aproveAction(id){
      var licenseId=$("#obj_zoomCode_1").val();
      sendNotify(id);
     // aproveAction(id);
      url ="<?=$rootPath?>/tzoombooking/aproveMeeting.php?licenseId="+licenseId+"&id="+id;
      var data=executeProgress(url,"#dvInputBody");

      return true;
 }


function isExist(){
      var sTime=$("#obj_sHr").val()+":"+$("#obj_sMn").val();
      var fTime=$("#obj_fHr").val()+":"+$("#obj_fMn").val();
      var url="<?=$rootPath?>/tzoombooking/isExistByDuration.php?zoomCode="+$("#obj_zoomCode_1").val()+"&bookingDate="+$("#obj_bookingDate").val()+"&finishDate="+$("#obj_finishDate").val()+"&sTime="+sTime+"&fTime="+fTime;
      var data=queryData(url);
      return data.flag;
}   

function getDateRange(bookingDate){
    var url ="<?=$rootPath?>/tzoombooking/getDateRange.php?bDate="+bookingDate;
    
    var data=queryData(url);
    return data.range;
  }

function saveZoomBooking(){
      
     var range=getDateRange($("#obj_bookingDate").val());
        if(range>14){
                  swal.fire({
                            title: "ไม่สามารถจองล่วงหน้าเกิน 14 วัน",
                            type: "error",
                            buttons: [false, "ปิด"],
                            dangerMode: true,
                        });
            return ;
        }


      if($("#obj_lineNo").val()===""){
          swal.fire({
                            title: "กรุณาระบุ E-mail ของท่านเพื่อสะดวกในการ ส่ง Meeting Link",
                            type: "error",
                            buttons: [false, "ปิด"],
                            dangerMode: true,
                        });
          return ;
      }
    	
      if(!isExist()){
        var data=createData();
        //var id=getZoomBookingLastId();

        var flag=aproveAction(data.id);
      	if(flag===true){
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
                            title: "License ดังกล่าวมีการใช้แล้วในช่วงเวลาดังกล่าว",
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

    function listDepartment(){
      var url="<?=$rootPath?>/tdepartment/listDepartment.php";
      setDDLPrefix(url,"#obj_department","***หน่วยงาน***");
    }

    function listObjective(){
      var url="<?=$rootPath?>/tbookingobjective/listObjective.php";
      setDDLPrefix(url,"#obj_objective","***วัตถุประสงค์***");
      $("#obj_objective").prop("selectedIndex", 2);

    }


     $( document ).ready(function() {
          listDepartment();
          listObjective();
          listZoomLicense_1();
          setCurrentSysDate("#obj_bookingDate")
          listHr();
          listMn();

          listDuration();
          setDurationDateTime();
         	$("#obj_activity").val("");
          $("#btnSave").click(function(){
              saveZoomBooking();
               $("#modal-input").modal("hide");
          });
     });

</script>

