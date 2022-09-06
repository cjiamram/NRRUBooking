<?php
      include_once '../config/database.php';
      include_once '../config/config.php';
      include_once '../objects/classLabel.php';
      $cnf=new Config();
      /*$tableName=isset($_GET["tableName"])?$_GET["tableName"]:"";
      $dbName=isset($_GET["dbName"])?$_GET["dbName"]:"";
      $tName=str_replace("_", "", $tableName);
      $path=$cnf->path."/".$tName;*/
      $rootPath=$cnf->path;
      $database = new Database();
      $db = $database->getConnection();
      $objLbl=new ClassLabel($db);

?>
<script src="<?=$rootPath?>/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?=$rootPath?>/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>

<input type="hidden" id="obj_id" value="">
<section class="content-header">
     <h1>
        <b>ระบบจัดการ Zoom License</b>

        <small>>>Zoom License</small>
      </h1>
      <ol class="breadcrumb">
   
        <table width="100%" cellspacing="2" cellpading="2">
          <tr>
            <td width="40%" align="center">
                <input type="button" id="btnInput"   class="btn btn-primary col-sm-12" value="สร้าง">
            </td>
            <td width="60%" align="center">
                <input type="button" id="btnSearch"  class="btn btn-success col-sm-12" data-toggle="modal" data-target="#modal-search" value="ค้นหาข้นสูง">
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
      <h3 class="box-title"><b>Zoom License List</b></h3>
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
                <h4 class="modal-title">Zoom License API Key</h4>
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
                    <input type="button" id="btnAdvCose" value="ปิด"  class="btn btn-default pull-left" data-dismiss="modal">
                    <input type="button" id="btnAdvSearch" value="ค้นหา"  class="btn btn-primary" data-dismiss="modal">
                  </div>
           </div>
        </div>
     </div>
   </div>

<script>
 /*var path='<?php echo $path?>';
 var tableName='<?php echo $tableName; ?>';
 var dbName='<?php echo $dbName;?>';*/

 function loadInput(){
      var url="<?=$rootPath?>/tzoomlicense/input.php";
      $("#dvInputBody").load(url);
 }

function displayData(){
 
    var url="<?=$rootPath?>/tzoomlicense/displayData.php?keyWord="+$("#txtSearch").val();
    $("#tblDisplay").load(url);
 }

 function loadPage(){
    //$("#modal-input").modal("toggle");
    loadInput();
    displayData();
 }


 function getOne(id){
    $("#modal-input").modal("toggle");
    //loadInput();
    readDataOne(id);
    genURI();
 }

 function readDataOne(id){
    
    var url='<?=$rootPath?>/tzoomlicense/readOne.php?id='+id;
    data=queryData(url);
    if(data!=""){
      console.log(data.zoomCode);
      $("#obj_zoomCode").val(data.zoomCode);
      $("#obj_zoomDetail").val(data.zoomDetail);
      $("#obj_status").val(data.status);
      $("#obj_clientId").val(data.clientId);
      $("#obj_secreteId").val(data.secretId);
      //$("#obj_redirectURI").val(data.redirectURI);
      $("#obj_id").val(data.id);
    }
}

function createData(){
    var url='<?=$rootPath?>/tzoomlicense/create.php';
    jsonObj={
      zoomCode:$("#obj_zoomCode").val(),
      zoomDetail:$("#obj_zoomDetail").val(),
      status:$("#obj_status").val(),
      clientId:$("#obj_clientId").val(),
      secretId:$("#obj_secreteId").val()
    
    }
    var jsonData=JSON.stringify (jsonObj);
    console.log(jsonData);
    var flag=executeData(url,jsonObj,false);
    return flag;
}
function updateData(){
    var url='<?=$rootPath?>/tzoomlicense/update.php';
    jsonObj={
      zoomCode:$("#obj_zoomCode").val(),
      zoomDetail:$("#obj_zoomDetail").val(),
      status:$("#obj_status").val(),
      clientId:$("#obj_clientId").val(),
      secretId:$("#obj_secreteId").val(),
      id:$("#obj_id").val()
    }
    var jsonData=JSON.stringify (jsonObj);
    console.log(jsonData);
    var flag=executeData(url,jsonObj,false);
    return flag;
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
      url="tzoomlicense/delete.php?id="+id;
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
      $("#obj_id").val("");
      $("#obj_zoomCode").val("");
      $("#obj_zoomDetail").val("");
      $("#obj_status").val("");
      $("#obj_clientId").val("");
      $("#obj_secreteId").val("");
      //$("#obj_redirectURI").val("");
}

function saveData(){
    var flag;
    flag=true;
    if(flag==true){
          if($("#obj_id").val()!=""){
        flag=updateData();
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

  function genURI(){
    var url="http://nrruapp.nrru.ac.th/zoomAPI/callback.php?licenseId="+$("#obj_zoomCode").val()+"&uriType=2";

    $("#obj_uri").val(url);
  }

 $( document ).ready(function() {
    loadPage();
    displayData();

    $("#btnInput").click(function(){
        clearData();
        //$("#obj_code").val(genCode());
    });

    $("#txtSearch").change(function(){
        displayData();
    });

    $("#btnSave").click(function(){
        saveData();
    });

    $("#btnInput").click(function(){
      $("#modal-input").modal("toggle");
      loadInput();
    });

    //$("#btnInput").modal("toggle");
 });

</script>
