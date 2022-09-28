<?php
  session_start();
  include_once "../config/config.php";
  $cnf=new Config();
  $rootPath=$cnf->path;
  $url=$cnf->restURL;
  $roomNo=isset($_GET["roomNo"])?$_GET["roomNo"]:"";  
  $userCode=isset($_SESSION["UserName"])?$_SESSION["UserName"]:"";
  $flagCheck=isset($_GET["flagCheck"])?boolval($_GET["flagCheck"]):0;
 
  if($flagCheck===true){
      $bDate=date("Y-m-d",strtotime($_GET["bookingDate"]));
      $sTime=$_GET["sTime"];
      $fTime=$_GET["fTime"];
      $sTimes=explode(":",$sTime);
      $fTimes=explode(":",$fTime);

      //print_r($sTimes);
      $sH=$sTimes[0];
      $sM=$sTimes[1];
      $fH=$fTimes[0];
      $fM=$fTimes[1];

  }else{
    $bDate =date("Y-m-d");
    $sH="07";
    $sM="00";
    $fH="16";
    $fM="00";
  }

?>
<link rel="stylesheet" href="bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
<script src="<?=$rootPath?>/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?=$rootPath?>/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>

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
<section class="content-header">
     <h1>
        <b>ระบบจองห้อง</b>
        <small>>>จองห้อง</small>
      </h1>
      <ol class="breadcrumb">
                <input type="button" id="btnBack"  class="btn btn-primary"  value="ย้อนกลับ">

      </ol>
    </section>

<section class="content container-fluid">
<div class="box"></div>
<div class="box-body">
 <div class="col-xs-12"> 
  <div class="box box-success">
    <table width="100%">

      <tr>
        <td width="60%">

                    <div class="box-body">
              <div class='form-group'>
                <label class="col-sm-12" id="lblBookingRoom"><u>ระบุห้อง:</u></label>
                
                <div class="col-sm-12">
                
                  <select class="form-control" id='obj_bookingRoom' ></select>
                </div>
              </div>
              <div class='form-group'>
                <label class="col-sm-12"  id="lblBookingDate">กำหนดวัน/ช่วงเวลาใช้บริการ::</label>
                <div class="col-sm-12">
                  <table width="100%">
                    <tr>
                      <td>
                        <div class="input-group date">
                        <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                        </div>
                        <input type="date" value="<?=$bDate?>" class="form-control col-sm-4" id="obj_bookingDate">
                        </div>
                      </td>
                      <td>&nbsp;</td>
                       <td>
                        <select class="form-control" id="obj_sHr"></select>
                      </td>
                      <td align='center' width="10px">:
                      </td>
                      <td>
                        <select class="form-control" id="obj_sMn"></select>

                      </td>
                      <td>-</td>
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
              

                      <label class="form-control" value="<?=$_SESSION["FullName"]?>" id='obj_bookingName'><?=$_SESSION["FullName"]?></label>
                </div>
              </div>
              <div class='form-group'>
                <label class="col-sm-12">Tel/Line:</label>
                <div class="col-sm-6">
                  <input type="text" 
                        class="form-control" id='obj_telNo' 
                        placeholder='telNo'>
                </div>
                 <div class="col-sm-6">
                  <input type="text" 
                        class="form-control" id='obj_lineNo' 
                        placeholder='lineNo'>
                </div>
              </div>

            
              
              <div class='form-group'>
                <label class="col-sm-12" id="lblActivity">รายละเอียดการจอง:(*กรุณาระบุรายละเอียดของกิจกรรม)</label>
                <div class="col-sm-12">
                  <textarea id="obj_activity" class="form-control"  rows="6" cols="50">
                  </textarea>
                </div>
              </div>
              <div class="form-group">
                 <div class="col-sm-12">&nbsp;
                 </div>     
              </div>
            </div>
              <div class="form-group">
                 <div class="col-sm-12">
                      <input type="button" id="btnSave" value="บันทึก"  class="btn btn-primary pull-left" >
                 </div>     
              </div>
            </div>

        </td>
        <td valign="top">
          <div class="box-body">
          <label class="col-sm-12" id="lblOtion"><u>เลือกอุปกรณ์เสริม:</u></label>

          <div id="dvOption">
          

          </div>
          <div class="col-sm-12" style="">

          </div>
          </div>


        </td>
      </tr>

    </table>

  <!---->
  </div>

</div>

</div>


<div class="col-xs-12"> 
 <div class="box box-success">   
  <div id="dvSelfBooking" ></div>
</div>
</div>



<div>
  <iframe id="frmCapture" style="width:1px;height:1px"></iframe>
</div>

</section>


   <div class="modal fade" id="modal-available">
     <div class="modal-dialog"  >
      <div class="modal-content" style="width:900px">
          <div class="box-header with-border">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">ห้องว่าง</h4>
           </div>
           <div class="modal-body" id="dvAvailable">
           
           </div>
          <div>
                 <div class="modal-footer">
                    <input type="button" id="btnClose" value="ปิด"  class="btn btn-default pull-left" data-dismiss="modal">
                  </div>
          </div>
      </div>
     </div>
   </div>

   <input type="hidden" id="obj_id" value="">



<script >
    
    var bookingRoom="<?=$roomNo?>";
    function listHr(){
      cb="";
      for(i=7;i<=17;i++){
          objHr=(i<10)?"0"+i:i;
          cb+="<option value="+objHr+">"+objHr+"</option>";
      }
      $("#obj_sHr").html(cb);
      $("#obj_fHr").html(cb);

       $("#obj_sHr").val('<?=$sH?>');
       $("#obj_fHr").val('<?=$fH?>');


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
      url="<?=$rootPath?>/tbooking/delete.php?id="+id;
      var flag=executeGet(url);
      displaySelfBooking();
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

    function listMn(){
      cb="";
      for(i=0;i<60;i+=5){
          objHr=(i<10)?"0"+i:i;
          cb+="<option value="+objHr+">"+objHr+"</option>";
      }
      $("#obj_sMn").html(cb);
      $("#obj_fMn").html(cb);

      $("#obj_sMn").val('<?=$sM?>');
      $("#obj_fMn").val('<?=$fM?>');

    }

	  function listBookingBuilding(){
      var url="tbuilding/listBuilding.php";
      setDDL(url,"#obj_bookingBuilding");
    }

    function listBookingRoom(building){
      var url="<?=$rootPath?>/troom/listRoom.php?building="+building;
      setDDL(url,"#obj_bookingRoom");
      $("#obj_bookingRoom").val(bookingRoom);
    }


    function setAcessory(){
        var url="<?=$rootPath?>/ttemplate/getData.php";
        var data=queryData(url);
        var objHtml="";
        var i=0;

        if(data.length>0){
          for(i=0;i<data.length;i++){
            objHtml+="<div class=\"col-sm-12\"><input type='checkbox' id='T-"+i+"' name='T' value='"+data[i].code+"'>&nbsp;&nbsp;"+data[i].templateOption+"</div>\n";

          }
        }

      $("#dvOption").html(objHtml);

    }

    function chooseOption(){
        var i=0;
        while(document.getElementById("T-"+i) !== null){
            templatCode=document.getElementById("T-"+i).value;
            var url="<?=$rootPath?>/toptional/isExist.php?bookingId="+$("#obj_id").val()+"&templateCode="+templatCode;
           
            var data=queryData(url);
            document.getElementById("T-"+i).checked=data.flag;
          
            i++;
        }
    } 

    function createData(){
    	var url="<?=$rootPath?>/tbooking/create.php";
    	var jsonObj={
    		bookingRoom:$("#obj_bookingRoom").val(),
    		bookingDate:$("#obj_bookingDate").val(),
    		startTime:$("#obj_sHr").val()+":"+$("#obj_sMn").val(),
    		finishTime:$("#obj_fHr").val()+":"+$("#obj_fMn").val(),
    		bookingName:$("#obj_bookingName").text(),
    		staffId:$("#obj_staffId").val(),
    		activity:$("#obj_activity").val(),
    		telNo:$("#obj_telNo").val(),
    		lineNo:$("#obj_lineNo").val(),
    		status:0,
        outsiderId:0
    	};
    	var jsonData=JSON.stringify (jsonObj);
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

          sendMsg($("#obj_id").val());

    }

    function sendMsg(id){
        var url="<?=$rootPath ?>/lineBot/notifyWithMSGW.php?id="+id;
        executeGet(url);
    }

    function sendStream(id){
            /*var url="<?=$rootPath?>/tbooking/displayBookingRoomById.php?id="+id;
            $('#frmCapture').attr('src', url)*/
            sendMsg(id);
    }


    function displayRoomEmpty(){

      var sTime=$("#obj_sHr").val()+":"+$("#obj_sMn").val();
      var fTime=$("#obj_fHr").val()+":"+$("#obj_fMn").val();
      var building="27";
      var url="<?=$rootPath?>/tbooking/displayAvailableJS.php?bookingDate="+$("#obj_bookingDate").val()+"&sTime="+sTime+"&fTime="+fTime+"&building="+building;

      $("#dvAvailable").load(url);
      $("#modal-available").modal("toggle");

    }



    function createOptional(template){
      var jsonObj={
          "bookingId":$("#obj_id").val(),
          "template":template,
          "description":"",
          "quantity":1
      }
      var url="<?=$rootPath?>/toptional/create.php";
      var flag=executeData(url,jsonObj,false);
      return flag;

    } 

    function deleteOptional(bookingId){
      var url="<?=$rootPath?>/toptional/deleteByBookingId.php?bookingId="+bookingId;
      var flag=executeGet(url);
      return flag;
    }


    function saveOptional(){
       var id=$("#obj_id").val();
       deleteOptional(id);
       var i=0;
        var flag=true;
        while(document.getElementById("T-"+i) !== null){
            if(document.getElementById("T-"+i).checked===true){
               flag &=createOptional(document.getElementById("T-"+i).value);
            }
            i++;
        }
        return flag;


    }



    function getDateDiff(){
       var bookingDate=$("#obj_bookingDate").val();
       var url="<?=$rootPath?>/tbooking/getDateDiff.php?bookingDate="+bookingDate;
       var data=queryData(url);
       return data.dayRange;
    }


    function getBookingNo(){
       var userCode= $("#obj_staffId").val();
       var url="<?=$rootPath?>/tbooking/getBookingNo.php?userCode="+userCode;
       var data=queryData(url);
       return data.bookingNo;
    }



    function saveData(){
    	if($("#obj_telNo").val()==="" && $("#obj_lineNo").val()===""){
         swal.fire({
                          title: "กรุณากรอกเบอร์โทรศัพท์หรือ Line",
                          type: "error",
                          buttons: [false, "ปิด"],
                          dangerMode: true,
                      });
         return;

      }



      if($("#obj_id").val()===""){

          var url="<?=$rootPath?>/tquotaprevillage/getQuota.php?userCode=<?=$userCode?>";
          //console.log(url);
          var quota=queryData(url);

          var bookingCount=getBookingNo();
         /* console.log(quota.duration);
          console.log(quota.quota);
          console.log(getDateDiff());
          console.log(bookingCount);*/


        
        
          if(getDateDiff()>quota.duration){
               swal.fire({
                          title: "สิทธิชองคุณจองห้องได้ไม่เกิน 15 วัน",
                          type: "error",
                          buttons: [false, "ปิด"],
                          dangerMode: true,
                });
               return;
          }

          if(getDateDiff()<Math.abs(quota.min)){
               swal.fire({
                          title: "กรุณาจองล่วงหน้าก่อน 3 วัน",
                          type: "error",
                          buttons: [false, "ปิด"],
                          dangerMode: true,
                });
               return;
          }



         
          if(bookingCount>quota.quota){
               swal.fire({
                          title: "ไม่อนุญาติให้จองมากว่า 3 ครั้งต่อผู้ใช้งาน 1 คน",
                          type: "error",
                          buttons: [false, "ปิด"],
                          dangerMode: true,
                });
               return;
          }




      }




     

      if (($("#obj_id").val()==="")&&isExist()){
    		 swal.fire({
                          title: "กรุณาตรวจสอบช่วงเวลาการจองอีกครั้งช่วงเวลามีการซ้อนทับ",
                          type: "error",
                          buttons: [false, "ปิด"],
                          dangerMode: true,
                      }).then(function(){
                         displayRoomEmpty();
                      });
    		 return ;
    	}


      if($("#obj_activity").val()===""){
          swal.fire({
                          title: "กรุณาระบุกิจกรรมที่ต้องการใช้บริการ",
                          type: "error",
                          buttons: [false, "ปิด"],
                          dangerMode: true,
                      }).then(function(){
                         displayRoomEmpty();
                      });
         return ;

      }
    	
      if($("#obj_id").val()===""){
        var flag=createData();
        var id=getBookingLastId();
         
        $("#obj_id").val(id);
        flag &=saveOptional();

      }else
      {
        var url="<?=$rootPath?>/tbooking/delete.php?id="+$("#obj_id").val();
        var flag=executeGet(url);
        deleteOptional($("#obj_id").val());
        var flag=createData();
        var id=getBookingLastId();

        $("#obj_id").val(id);
        flag &=saveOptional();
      }

     
      $("#obj_id").val(id);

      flag &=saveOptional();

    	if(flag==true){
                 sendStream($("#obj_id").val());
                  

                  swal.fire({
                          title: "การบันทึกข้อมูลเสร็จสมบูรณ์แล้ว",
                          type: "success",
                          buttons: [false, "ปิด"],
                          dangerMode: true,
                      }).then((result)=>{
                          sendMsg(id);

                      });
                  $("#obj_Room").val($("#obj_bookingRoom").val());
                 

                  displaySelfBooking();
                  clearBooking();
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

    function clearBooking(){
      $("#obj_id").val("");
      $("#obj_Room").val("");
      $("#obj_activity").val("");

    }

    function formatDate(date) {
        var year = date.getFullYear().toString();
        var month = (date.getMonth() + 101).toString().substring(1);
        var day = (date.getDate() + 100).toString().substring(1);
        return year + "-" + month + "-" + day;
    }


    function displaySelfBooking(){
       /*var url="<?=$rootPath?>/tbooking/displaySelfBookingRoom.php?userCode=<?=$userCode?>";
       $("#tblSelfBooking").load(url);*/
       var url="<?=$rootPath?>/tbooking/displaySelfBookingRoomJS.php?userCode=<?=$userCode?>"
       $("#dvSelfBooking").load(url); 
    }

  function readOne(id){
        var url="<?=$rootPath?>/tbooking/readOne.php?id="+id;

        var data=queryData(url);
        $("#obj_id").val(data.id);
        $("#obj_bookingRoom").val(data.bookingRoom);
        $("#obj_bookingDate").val(data.bookingDate);
        var st=data.startTime.split(":");
        var fn=data.finishTime.split(":");
        $("#obj_sHr").val(st[0]);
        $("#obj_sMn").val(st[1]);
        $("#obj_fHr").val(fn[0]);
        $("#obj_fMn").val(fn[1]);
        $("#obj_activity").val(data.activity);
        $("#obj_telNo").val(data.telNo);
        $("#obj_lineNo").val(data.lineNo);
        chooseOption();


  }




     $( document ).ready(function() {
      //setCurrentSysDate("#obj_bookingDate")
      listHr();
      listMn();
     	listBookingRoom("");
      setAcessory();
     	$("#obj_activity").val("");
      displaySelfBooking();

      //console.log($("#obj_bookingName").text());


       $("#btnBack").click(function(){
            var url="<?=$rootPath?>/troom/displayRoomPicture.php";
            $("#dvMain").load(url);

    });

     	$("#obj_bookingBuilding").click(function(){
        	listBookingRoom($("#obj_bookingBuilding").val());
      	});

      	$("#btnSave").click(function(){
          saveData();

      	});


     });

</script>

