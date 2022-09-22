<?php
      include_once '../config/database.php';
      include_once '../config/config.php';

      $cnf=new Config();
      $rootPath=$cnf->path;
      echo '<input type="hidden" id="obj_id" value="">';


?>
<section class="content-header">
     <h1>
        <b>ระบบการจองห้องประชุม</b>

        <small>>>ดึงข้อมูลการใช้ห้อง</small>
      </h1>
      <ol class="breadcrumb">
   
    

      </ol>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">
    <div class="box"></div>
     
    <div id="dvConsole"></div>
        
        
    </section>


  

   <!---Room Info-->


   <!--**********-->



<script>
function loadData(){
  var url="<?=$rootPath?>/transformation/setRoomUsageConsole.php";
  $("#dvConsole").load(url);
}

$(document).ready(function(){
  loadData();
});


</script>
