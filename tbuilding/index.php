<?php
      include_once '../config/database.php';
      include_once '../config/config.php';
    

      $tableName=isset($_GET["tableName"])?$_GET["tableName"]:"";
      $dbName=isset($_GET["dbName"])?$_GET["dbName"]:"";
      $tName=str_replace("_", "", $tableName);
      $cnf=new Config();
      $rootPath=$cnf->path;
      echo '<input type="hidden" id="obj_id" value="">';


?>
<section class="content-header">
     <h1>
        <b>ระบบการจองห้องประชุม</b>

        <small>>>จัดการข้อมูลห้อง</small>
      </h1>
      <ol class="breadcrumb">
   
        <table width="100%" cellspacing="2" cellpading="2">
          <tr>
            <td width="40%" align="center">
              <input type="button" id="btnInput"   class="btn btn-primary col-sm-12"  value="สร้าง">

            </td>
             <td width="60%" align="center">
                    <input type="button" id="btnSearch"  class="btn btn-success col-sm-12"  value="ค้นหาข้นสูง">
             </td>
          </tr>
        </table>

      </ol>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">
        <div class="box"></div>
        <div class="form-group">
          <div class="col-sm-12">
             <div class="col-sm-6">
               <div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-search"></i>
                  </div>
                  <input type="text" class="form-control pull-right" id="txtSearch">
                </div>
             </div>
             <div>
              <div  class="col-sm-4">
              </div>
          </div>
          </div>
        </div>

        <div>&nbsp;</div>
         <div class="col-sm-12">
           <div class="box box-warning">
             <div class="box-header with-border">
              <h3 class="box-title"><b>รายชื่ออาคาร</b></h3>
            </div>
            <table id="tblDisplay" class="table table-bordered table-hover">
            </table>
            </div>  
           </div>
        
    </section>


   <div class="modal fade" id="modal-input">
     <div class="modal-dialog" id="dvInput" >
      <div class="modal-content">
          <div class="box-header with-border">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">ข้อมูลอาคาร</h4>
           </div>
           <div class="modal-body" id="dvInputBody">
           
           </div>
          <div>
                 <div class="modal-footer">
                    <input type="button" id="btnClose" value="ปิด"  class="btn btn-default pull-left" data-dismiss="modal">
                    <input type="button" id="btnSave" value="บันทึก"  class="btn btn-primary" data-dismiss="modal">
                  </div>
          </div>
      </div>
     </div>
   </div>

     <div class="modal fade" id="modal-search">
        <div class="modal-dialog" id="dvSearch">
           <div class="modal-content">
            <div class="box-header with-border">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Advance Search</h4>
           </div>
           <div class="modal-body" id="dvAdvBody">
           
           </div>
          <div>
                 <div class="modal-footer">
                    <input type="button" id="btnAdvClose" value="ปิด"  class="btn btn-default pull-left" data-dismiss="modal">
                    <input type="button" id="btnAdvSearch" value="ค้นหา"  class="btn btn-primary" data-dismiss="modal">
                  </div>
           </div>
        </div>
     </div>
   </div>

   <!---Room Info-->

<div class="modal fade" id="modal-roomInfo">
        <div class="modal-dialog" style="width:700px">
           <div class="modal-content">
            <div class="box-header with-border">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">จัดการข้อมูลห้อง</h4>
           </div>
           <div class="modal-body" id="dvRoomInfo">
           
           </div>
          <div>
                 <div class="modal-footer">
                    <input type="button" id="btnInfoClose" value="ปิด"  class="btn btn-default pull-left" data-dismiss="modal">
                  </div>
           </div>
        </div>
     </div>
   </div>
   <!--**********-->



<script>

var regDec = /^\d+(\.\d{1,2})?$/;
var regEmail=/^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/g;
var regTel=/^[+]*[(]{0,1}[0-9]{1,4}[)]{0,1}[-\s\./0-9]*$/g;
var regDate=/(0[1-9]|1[012])[- \/.](0[1-9]|[12][0-9]|3[01])[- \/.](19|20)\d\d/;
function validInput(){
    var flag=true;
    return flag;
}

function readOne(id){
    var url='<?=$rootPath?>/tbuilding/readOne.php?id='+id;
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

function clearData(){
      $("#obj_BuildingNo").val("");
      $("#obj_BuildingName").val("");
      $("#obj_FloorNo").val("");
      $("#obj_RoomNo").val("");
      $("#obj_FloorPlan").val("");
}

function createData(){
    var url='<?=$rootPath?>/tbuilding/create.php';
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
    var url='<?=$rootPath?>/tbuilding/update.php';
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
    displayDataBuilding();
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
      url="<?=$rootPath?>/tbuilding/delete.php?id="+id;
      executeGet(url,false,"");
      displayDataBuilding();
    swal.fire({
      title: "ลบข้อมูลเรียบร้อยแล้ว",
      type: "success",
      buttons: "ตกลง",
    });
    }
    });
}

function displayDataBuilding(){
    var url="<?=$rootPath?>/tbuilding/displayData.php?tableName=t_building&dbName=dbreservroom&keyWord="+$("#txtSearch").val();
    $("#tblDisplay").load(url);
    //tablePage("#tblDisplay");
  }

 function readOneBuilding(id){
      $("#modal-input").modal("toggle");
      readOne(id);
 }


 function loadRoomInfo(id){
      var url="<?=$rootPath?>/troom/input.php?buildingId="+id;
      $("#modal-roomInfo").modal("toggle");
      $("#dvRoomInfo").load(url);
 }

 function loadPage(){
    displayDataBuilding();
    var url="<?=$rootPath?>/tbuilding/input.php";
    $("#dvInputBody").load(url);
 }

 $( document ).ready(function() {
    loadPage();

    $("#btnInput").click(function(){
        $("#modal-input").modal("toggle");
        var url="<?=$rootPath?>/tbuilding/input.php";
        $("#dvInputBody").load(url);
        clearData();
        $("#obj_code").val(genCode());
    });

    $("#btnSave").click(function(){
        saveData();
    });

    $("#txtSearch").change(function(){
        displayDataBuilding();
    });

   
 });

</script>
