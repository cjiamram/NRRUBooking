<?php
      include_once '../config/database.php';
      include_once '../config/config.php';
      include_once '../objects/classLabel.php';
      $cnf=new Config();
      $rootPath=$cnf->path;
      $redirectURI=$cnf->redirectURI;
      $database = new Database();
      $db = $database->getConnection();
      $objLbl=new ClassLabel($db);


?>
<style>
img {
  display: block;
  margin-left: auto;
  margin-right: auto;
  width:200px;
}
</style>

<link rel="stylesheet" href="<?=$rootPath?>/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
<script src="<?=$rootPath?>/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?=$rootPath?>/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>


<input type="hidden" id="obj_id" value="">

<section class="content-header">
     <h1>
        <b>ระบบจองแอพลิเคชั่นประชุม</b>

        <small>>>อนุมัติการประชุม</small>
      </h1>
      <ol class="breadcrumb">
   
  

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
      <h3 class="box-title"><b>รายการออนุมัติประชุมออนไลน์</b></h3>
      </div>

    

      <table id="tblDisplay" class="table table-bordered table-hover">
      </table>
      </div>  
      </div>
        
    </section>


   <div class="modal fade" id="modal-Booking">
     <div class="modal-dialog" >
      <div class="modal-content">
          <div class="box-header with-border">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">แก้ใขการจองระบบ Zoom</h4>
           </div>
           <div class="modal-body" id="dvBooking">
           
           </div>
          <div>
                 <div class="modal-footer">
                    <input type="button" id="btnClose" value="ปิด"  class="btn btn-default pull-left">
                    <input type="button" id="btnSave" value="บันทึก"  class="btn btn-primary">
                  </div>
          </div>
      </div>
     </div>
   </div>

     <div class="modal fade" id="modal-loading">
        <div class="modal-dialog" style="width:400px">
           <div class="modal-content">
            
           <div class="modal-body" id="dvLoadBody">
                 <div id="dvLoading">
                  <img src="<?=$rootPath?>/img/Loading.gif" alt="Wait" />

                 </div>
           </div>
      
        </div>
     </div>
   </div>


<script>
function displayData(){
    var url="<?=$rootPath?>/tzoombooking/displayUnAproveStatus.php?keyWord="+$("#txtSearch").val();
    $("#tblDisplay").load(url);
 }

 function readOneBooking(id){
      $("#modal-Booking").modal("toggle");
      $("#dvBooking").load("<?=$rootPath?>/tzoombooking/zoomBookingEdit.php?id="+id);
 }

 function cancelBooking(id){
      var url="<?=$rootPath?>/tzoombooking/setUnAproveStatus.php?id="+id;
      var message=executeGet(url);
       displayData();
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
      url="<?=$rootPath?>/tzoombooking/delete.php?id="+id;
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

 function executeProgress(url){
    var result;
    $.ajax({
      type:'GET',
      url:url,
      dataType:'json',
      async:true,
      success:function(data){
       //result=data;
      },
      beforeSend: function(){
        $("#modal-loading").modal('toggle');
     },
     complete: function(){
        $("#modal-loading").modal('hide');
        displayData();
        swal.fire({
          title: "การบันทึกข้อมูลเสร็จสมบูรณ์แล้ว",
          type: "success",
          buttons: [false, "ปิด"],
          dangerMode: true,
        });
     }
    });
    return true;
  }

 function aproveAction(index,id){
      var licenseId=$("#licenseId_"+index).val();
      var url="<?=$rootPath?>/tzoombooking/setAproveStatus.php?id="+id;
      var message=executeGet(url);
      url ="<?=$rootPath?>/tzoombooking/aproveMeeting.php?licenseId="+licenseId+"&id="+id;
      executeProgress(url);
      
 }

 function aproveBooking(index,id){
      aproveAction(index,id)
 }

 $( document ).ready(function() {
    displayData();

    $("#btnClose").click(function(){
      $("#modal-Booking").modal("hide");
    });

    $("#btnSave").click(function(){
      $("#modal-Booking").modal("hide");
    });

    $(".close").click(function(){
      $("#modal-Booking").modal("hide");
    });

    $("#txtSearch").change(function(){
       displayData();
    });
 });





</script>
