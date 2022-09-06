<?php
  session_start();
  include_once "../config/config.php";
  $cnf=new Config();
  $url=$cnf->restURL;
  $rootPath=$cnf->path;
  $userCode=isset($_SESSION["UserCode"])?$_SESSION["UserCode"]:"";
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

<link rel="stylesheet" href="<?=$rootPath?>/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
<script src="<?=$rootPath?>/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?=$rootPath?>/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>


<section class="content container-fluid">
<div class="box">

<div class="row">
<div class="col-lg-12 col-xs-12">
  <div class="box box-success">
     <div class="box-header with-border">
      <h3 class="box-title"><b>ระบุการประชุมออนไลน์ผ่าน Zoom Meeting</b></h3>
      </div>
    <div class='form-group'>
      <label class="col-sm-12" id="lblActivity">หัวข้อการจอง:</label>
      <div class="col-sm-12">
        <textarea id="obj_activity" class="form-control"  rows="2" cols="50">
        </textarea>
        
      </div>
    </div>

      <div class='form-group'>
      <label class="col-sm-12" id="lblBookingName">ผู้จอง:</label>
      <div class="col-sm-3">
        <input type="text" 

              class="form-control" id='obj_bookingName'
               value='<?=$_SESSION["FullName"]?>' 
              placeholder='bookingName'>
      </div>
    </div>
     <div class='form-group'>
      <label class="col-sm-12" id="lblBookingName">หน่วยงาน:</label>
      <div class="col-sm-3">
        <select id="obj_department" class="form-control"></select>
      </div>
    </div>
      <div class='form-group'>
      <label class="col-sm-12" id="lblBookingName">วัตถุประสงค์:</label>
      <div class="col-sm-3">
        <select id="obj_objective" class="form-control"></select>
       
      </div>
    </div>


   

    <div class='form-group'>
      <label class="col-sm-12"  id="lblBookingDate">กำหนดวัน</label>
      <div class="col-sm-3">
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
           
          </tr>
        </table>
      </div>
    
    </div>
    <div class='form-group'>
    <label class="col-sm-12"  id="lblBookingTime">เวลาเริ่มประชุม:</label>
    <div class="col-sm-3">
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
      </div>
    </div>

    <div class='form-group'>
    <label class="col-sm-12"  id="lblBookingDuration">จำนวนชั่วโมง</label>
    <div class="col-sm-1">
      <select id="obj_timeDuration" onchange="setDurationDateTime()" class="form-control"></select>
    </div>
     <div class="col-sm-11">&nbsp;</div>
    </div>

    <div id="dvFinishTime" style="display:none"  class='form-group'>
   
        <div class="col-sm-12">
        <table width="100%">
          <tr>
            <td width="70px">
                <div class="input-group date">
                <div class="input-group-addon">
                <i class="fa fa-calendar"></i>
                </div>
                <input type="date" class="form-control" id="obj_finishDate">
                </div>
            </td>
            <td width="10px">-
            </td>
            <td >
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
      <div class="col-sm-3">
        <input type="text" 
              class="form-control" id='obj_telNo' 
              placeholder='telNo'>
       
      </div>
       <div class="col-sm-9">&nbsp;
      </div>
    </div>
    <div class='form-group'>
      <label class="col-sm-12" id="lblEmail">E-Mail:</label>
      <div class="col-sm-3">
        <input type="text" 
              class="form-control" id='obj_lineNo' 
              value='<?=$_SESSION["UserCode"]."@nrru.ac.th"?>'
              placeholder='example@nrru.ac.th'>
       
      </div>
       <div class="col-sm-9">&nbsp;
      </div>
    </div>
     <div class='form-group'>
      <div class="col-sm-12">&nbsp;
      </div>
    </div>
    
      <div class="modal-footer">
              <input type="button" id="btnSave" value="บันทึก"  class="btn btn-primary pull-left" >

      </div>
</div>
</div>
<div class="col-lg-12 col-xs-12">

<div class="box box-warning">
<div class="box-header with-border">
<h3 class="box-title"><b>รายการประชุมออนไลน์ผ่าน Zoom Meeting</b></h3>
</div>
<table id="tblDisplay" class="table table-bordered table-hover">
  
</table>
</div> 
</div>  
</div>

</div>
</section>

 <div class="modal fade" id="modal-cancelBooking">
        <div class="modal-dialog" style="width:400px">
           <div class="modal-content"> 
            <div class="box-header with-border">
                <button type="button" class="close" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">ยกเลิกการจอง Zoom</h4>
           </div>           
           <div class="modal-body" id="dvCancelBooking">
                 
           </div>
            <div>
                 <div class="modal-footer">
                    <input type="button" id="btnCloseCancel" value="ปิด"  class="btn btn-default pull-left">
                    <input type="button" id="btnSaveCancel" value="บันทึก"  class="btn btn-primary">
                  </div>
          </div>
        </div>
     </div>
   </div>

   <div class="modal fade" id="modal-sendEmail">
        <div class="modal-dialog" style="width:400px">
           <div class="modal-content"> 
            <div class="box-header with-border">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">ส่งลิงค์ Zoom ผ่าน E-mail</h4>
           </div>           
           <div class="modal-body" id="dvSendMail">

                <div class='form-group'>
                <label class="col-sm-12">E-Mail:</label>
                 <div class="col-sm-12">
                  <input type='hidden' id='obj_resendId'>
                <input type="text" 
                      class="form-control" id='obj_sendTo' 
                      value='<?=$_SESSION["UserCode"]."@nrru.ac.th"?>'
                      >
               
              </div>
              <div class="col-sm-12">&nbsp;
              </div>

                </div>
                
                 
           </div>
            <div>
                 <div class="modal-footer">
                    <input type="button" id="btnCloseSend" value="ปิด"  class="btn btn-default pull-left">
                    <input type="button" id="btnSend" value="ส่ง E-Mail"  class="btn btn-primary">
                  </div>
          </div>
        </div>
     </div>
   </div>


<script >
    
  

   //var headURl='<?=$url?>';

    function setDurationDateTime(){
      var sDate=$("#obj_bookingDate").val();
      var sTime=$("#obj_sHr").val()+":"+$("#obj_sMn").val();
      var duration=$("#obj_timeDuration").val();
      var url="<?=$rootPath?>/tzoombooking/getDurationDateTime.php?sDate="+sDate+"&sTime="+sTime+"&duration="+duration;
      var data=queryData(url);
     
      $("#obj_finishDate").val(data.date);
      var times = data.time.split(":");
      $("#obj_fHr").val(times[0]);
      $("#obj_fMn").val(times[1]);
    }

  function cancelBooking(id){
    $("#modal-cancelBooking").modal("toggle");
    var url="<?=$rootPath?>/tcancelbooking/input.php?bookingId="+id;
    $("#dvCancelBooking").load(url);
  }

  function resendBooking(id){
    $("#modal-sendEmail").modal("toggle");
    $("#obj_resendId").val(id);
  }

  function sendTo(){
    var url="<?=$rootPath?>/tzoombooking/resendMeeting.php?id="+$("#obj_resendId").val()+"&sendTo="+$("#obj_sendTo").val();
    //console.log(url);
    executeGet(url);
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
    	//var url="<?=$rootPath ?>/tzoombooking/create.php";
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
      console.log(data);
      return data.MxId;
    }

    function getZoomBookingLicense(id){
      var url ="<?=$rootPath?>/tzoombooking/getLastLicense.php?id="+id;
      var data=queryData(url);
      return data.zoomCode;
    }

    function aproveAction(id){
      var licenseId=getZoomBookingLicense(id);
      var url ="<?=$rootPath?>/tzoombooking/aproveMeeting.php?licenseId="+licenseId+"&id="+id;
      var data=executeProgress(url,"#dvInputBody");
      //console.log(data);
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
     }
    });
    return result;
  }

  function displayData(){
     var url="<?=$rootPath?>/tzoombooking/displayCurrentBooking.php?userCode=<?=$userCode?>";
     //console.log(url);
     $("#tblDisplay").load(url);
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
      //console.log(data.range);

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
    	if(data.message===true){
                  sendNotify(data.id);

                  //var id=getZoomBookingLastId();
                  var id=data.id;
                  console.log(id);

                  var flag=aproveAction(id);


                  swal.fire({
                          title: "การบันทึกข้อมูลเสร็จสมบูรณ์แล้ว",
                          type: "success",
                          buttons: [false, "ปิด"],
                          dangerMode: true,
                      });
                  displayData();

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


  function createCancelBooking(){
        var url='<?=$rootPath?>/tcancelbooking/create.php';
        jsonObj={
          bookingId:$("#obj_bookingId").val(),
          cancelDate:$("#obj_cancelDate").val(),
          reason:$("#obj_reason").val()
        }
        var jsonData=JSON.stringify (jsonObj);
        var flag=executeData(url,jsonObj,false);
        return flag;

    }


    function saveCancelData(){
    var flag;
    flag=true;
    if(flag==true){
     
    flag=createCancelBooking();
    var url="<?=$rootPath?>/tzoombooking/cancelBooking.php?id="+$("#obj_bookingId").val();
    //console.log(url);
    data=executeGet(url);
    //console.log(data);
    flag=data.message;
    displayData();
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


     $( document ).ready(function() {
          setCurrentSysDate("#obj_bookingDate")
           //$("#modal-input").modal("shown");
          listDepartment();
          //$("#obj_").prop("selectedIndex", 0);

          displayData();
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


           $("#btnSaveCancel").click(function(){
              saveCancelData();
              $("#modal-cancelBooking").modal("hide");
              
            
          });

          $("#btnCloseCancel").click(function(){
              $("#modal-cancelBooking").modal("hide");

          });

          $("#btnSend").click(function(){
              sendTo();
              $("#modal-sendEmail").modal("hide");
          });

          $("#btnCloseSend").click(function(){
             $("#modal-sendEmail").modal("hide");
          });

          $(".close").click(function(){
              $("#modal-cancelBooking").modal("hide");
          });
     });

</script>

