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

    <div id="dvFinishTime" style="display:none"  class='form-group'>
   
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

    function listHr(){
      cb="";
      for(i=1;i<=23;i++){
          objHr=(i<10)?"0"+i:i;
          cb+="<option value="+objHr+">"+objHr+"</option>";
      }
      $("#obj_sHr").html(cb);
      $("#obj_fHr").html(cb);
    }

    function listDuration(){
      cb="";
      for(i=1;i<=6;i++){
          cb+="<option value="+i+">"+i+"</option>";
      }
      $("#obj_timeDuration").html(cb);
      
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
      for(i=0;i<60;i+=15){
          objHr=(i<10)?"0"+i:i;
          cb+="<option value="+objHr+">"+objHr+"</option>";
      }
      $("#obj_sMn").html(cb);
      $("#obj_fMn").html(cb);

    }

  function createBookingFail(){
      var url='<?=$rootPath?>/tbookingfail/create.php';
      jsonObj={
        bookingDate:$("#obj_bookingDate").val(),
        startTime:$("#obj_sHr").val()+":"+$("#obj_sMn").val(),
        finishTime:$("#obj_fHr").val()+":"+$("#obj_fMn").val(),
        departmentId:$("#obj_department").val()
      }
      var jsonData=JSON.stringify (jsonObj);
      var flag=executeData(url,jsonObj,false);
      return flag;
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
    	var url="<?=$rootPath ?>/tzoombooking/createWithLastId.php";
    	var jsonObj={
    		bookingDate:$("#obj_bookingDate").val(),
    		startTime:$("#obj_sHr").val()+":"+$("#obj_sMn").val(),
    		finishTime:$("#obj_fHr").val()+":"+$("#obj_fMn").val(),
    		bookingName:$("#obj_bookingName").val(),
    		staffId:$("#obj_staffId").val(),
    		activity:$("#obj_activity").val(),
    		telNo:$("#obj_telNo").val(),
    		lineNo:$("#obj_lineNo").val(),
    		status:1,
        aproveStatus:1,
        outsiderId:0,
        objective:$("#obj_objective").val(),
        departmentId:$("#obj_department").val(),
        finishDate:$("#obj_finishDate").val(),
        timeDuration:$("#obj_timeDuration").val()
    	};
    	var jsonData=JSON.stringify (jsonObj);
      var data=executeReturnData(url,jsonObj);
      return data;
    }

    function getZoomBookingLastId(){
      var url ="<?=$rootPath?>/tzoombooking/getZoomBookingLastId.php";
      var data=queryData(url);
      return data.MxId;
    }

    function getZoomBookingLicense(id){
      var url ="<?=$rootPath?>/tzoombooking/getLastLicense.php?id="+id;
      console.log(url);
      var data=queryData(url);
      return data.zoomCode;
    }

    function aproveAction(id){
      //var licenseId=$("#obj_zoomCode_1").val();
      var licenseId=getZoomBookingLicense(id);
      var url ="<?=$rootPath?>/tzoombooking/aproveMeeting.php?licenseId="+licenseId+"&id="+id;
      //console.log(url);
      var data=executeProgress(url,"#dvInputBody");
      return true;
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
  
        if($("#obj_lineNo").val()===""||$("#obj_activity").val()===""||$("#obj_telNo").val()===""){
          swal.fire({
                            title: "กรุณาระบุข้อมูลให้ครบถ้วน",
                            type: "error",
                            buttons: [false, "ปิด"],
                            dangerMode: true,
                        });
          return ;
      }
      
    	

      //var flag=createData();
      var data=createData();
      console.log(data);

    	if(data.message===true){
                  sendNotify(data.id);
                  var id=data.id;

                  //var id=getZoomBookingLastId();
                  var flag=aproveAction(id);


                  swal.fire({
                          title: "การบันทึกข้อมูลเสร็จสมบูรณ์แล้ว",
                          type: "success",
                          buttons: [false, "ปิด"],
                          dangerMode: true,
                      });
                  //displayCalendar();
         }
         else{
                 createBookingFail();

                 swal.fire({
                          title: "การจองรายการดังกล่าวมีการทับซ้อนโปรดจองช่วงเวลาอื่น",

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
           //$("#modal-input").modal("shown");
          listDepartment();
          //$("#obj_").prop("selectedIndex", 0);

          listObjective();
          //$("#obj_objective option:first").attr('selected','selected');
        

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

