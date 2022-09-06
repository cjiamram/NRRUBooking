<?php
      include_once '../config/database.php';
      include_once '../objects/createModel.php';

      $tableName=isset($_GET["tableName"])?$_GET["tableName"]:"";
      $dbName=isset($_GET["dbName"])?$_GET["dbName"]:"";
      $tName=str_replace("_", "", $tableName);

      $database = new Database();
      $db = $database->getConnection();
      $conn = new CreateModel($db);

      $conn->table_name=$tableName;
      $conn->db_name=$dbName;
      $stmt= $conn->getSchema();
      $num = $stmt->rowCount();

      $connArr=array();

      $phpJsonObj="{\n";
      $i=1;
//COLUMN_COMMENT
      while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $connItem=array(
                "COLUMN_NAME" => $COLUMN_NAME,
                "DATA_TYPE"=>$DATA_TYPE,
                ""=>$COLUMN_COMMENT
            );
            array_push($connArr, $connItem);
            if(($i++)<$num)
                $phpJsonObj.=$COLUMN_NAME.':'.'$("#obj_'.$COLUMN_NAME.'").val(),'."\n";
            else
                $phpJsonObj.=$COLUMN_NAME.':'.'$("#obj_'.$COLUMN_NAME.'").val()'."\n";
      }
      $phpJsonObj.="}\n";
      echo '<input type ="hidden" id="obj_input" value="'.$phpJsonObj.'">';
      echo '<input type ="hidden" id="obj_path" value="'.$tName.'">';


?>
<section class="content-header">
     <h1>
        <b>Module</b>

        <small>>>Sub Module</small>
      </h1>
      <ol class="breadcrumb">
   
        <table width="100%" cellspacing="2" cellpading="2">
          <tr>
            <td width="40%" align="center">
              <input type="button" id="btnInput"   class="btn btn-primary col-sm-12" data-toggle="modal" data-target="#modal-input" value="สร้าง">

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
              <h3 class="box-title"><b>Object List</b></h3>
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
                <h4 class="modal-title">Input</h4>
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

 var regDec = /^\d+(\.\d{1,2})?$/;
 var regEmail=/^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/g;
 var regTel=/^[+]*[(]{0,1}[0-9]{1,4}[)]{0,1}[-\s\./0-9]*$/g;
 var regDate=/(0[1-9]|1[012])[- \/.](0[1-9]|[12][0-9]|3[01])[- \/.](19|20)\d\d/;


 function validInput(){
  var flag=true;
  <?php
    foreach ($conArr as $row) {

      if($row["DATA_TYPE"]=="decimal"||$row["DATA_TYPE"]=="int"){
          echo 'flag=regDec.test($("#obj_'.$row["COLUMN_NAME"].'").val());'."\n";
          echo 'if (flag==false){'."\n";
          echo "\t\t".'$("#obj_'.$row["COLUMN_NAME"].'").focus();'."\n";
          echo "\t\t".'return flag;'."\n";
          echo '}'."\n";
      }

      if($row["COLUMN_COMMENT"]=="email"){
          echo 'flag=regEmail.test($("#obj_'.$row["COLUMN_NAME"].'").val());'."\n";
          echo 'if (flag==false){'."\n";
          echo "\t\t".'$("#obj_'.$row["COLUMN_NAME"].'").focus();'."\n";
          echo "\t\t".'return flag;'."\n";
          echo '}'."\n";
      }

       if($row["DATA_TYPE"]=="datetime"){
          echo 'flag=regDate.test($("#obj_'.$row["COLUMN_NAME"].'").val());'."\n";
          echo 'if (flag==false){'."\n";
          echo "\t\t".'$("#obj_'.$row["COLUMN_NAME"].'").focus();'."\n";
          echo "\t\t".'return flag;'."\n";
          echo '}'."\n";
      }


    }

  ?>
  return flag;

 }
 

 function create(){
    var jsonObj=$("#obj_input").val();
    var path='<?php echo $tName?>';
    var url="../"+path+"/create.php";
    flag=executeData(url,jsonObject,true);
    return flag;
 }

 function update(){
    var jsonObj=$("#obj_input").val();
    var path='<?php echo $tName?>';
    var url="../"+path+"/update.php";
    flag=executeData(url,jsonObject,true);
    return flag;
 }

 function displayData(){
    var tableName='<?php echo tableName ?>';
    var dbName='<?php echo dbName?>';
    var url="displayData.php?tableName?"+tableName+"&dbName="+dbName+"&keyWord="+$("#txtSearch").val();
    $("#tblDisplay").load(url);
 }

 function saveData(){
   

   var flag;
   flag=validInput();

   if(flag==true){
         if($("#obj_id").val()!=""){
            flag=update();
         }else{
            flag=create();
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

 function confirmDelete(id){
        swal.fire({
            title: "คุณต้องการที่จะลบข้อมูลนี้หรือไม่?",
            text: "***กรุณาตรวจสอบข้อมูลให้ครบถ้วนก่อนกดปุ่มตกลง",
            type: 'warning',
            confirmButtonText: "ตกลง",
            cancelButtonText: 'ยกเลิก',
            showCancelButton: true,
            showConfirmButton: true
        }).then((willDelete) => {
            if (willDelete.value) {
                url="delete.php?id="+id;
                executeGet(url,false,"");
             
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
    <?php
      $l=count($connArr);
      $i=1;
      foreach ($connArr as $row) {
          echo '$(\'#obj_'.$row["COLUMN_NAME"].'\').val(\'\');'."\n";
      }
    ?>
 }

 function readOne(id){
   var url="readOne.php?id="+id();
   var data=queryData(data);
   $("#obj_id").val(id);
   if (data!=""){
        <?php
          $l=count($connArr);
          $i=1;
          foreach ($connArr as $row) {
              echo '$(\'#obj_'.$row["COLUMN_NAME"].'\').val(data.'.$row["COLUMN_NAME"].');'."\n";
          }
        ?>
   }
 }

 function genCode(){
       var url="genCode.php";
       var data=queryData(url);
       return data.code;

 }

  function loadInput(){
      var url=$("#obj_path").val()+"/input.php";
      $("#dvInputBody").load(url);

 }

 function loadPage(){
    loadInput();
    displayData();
 }

 $( document ).ready(function() {
    loadPage();
    $("#btnInput").click(function(){
        clearData();
        $("#obj_code").val(genCode());
    });

    $("#txtSearch").change(function(){
        displayData();
    });

    $("#btnSave").click(function(){
        saveData();
    });
 });

</script>
