<?php 
  include_once "../config/config.php";
  $cnf=new Config();
  $rootPath=$cnf->path;
?>
<section class="content container-fluid">
<div class="box">
	<div class="box box-primary">
	<div class="box-body no-padding">
	<div><hr></div>
	<div class="row">
	<div class="col-sm-12">
      <div class="col-sm-1"><label>วันที่ :</label> </div>
      <div class="col-sm-2">
        <div class="input-group date">
        <div class="input-group-addon">
        <i class="fa fa-calendar"></i>
        </div>
        <input type="date" class="form-control" value="<?=date("Y-m-d")?>" id="obj_bookingDate">
        <input type="hidden" id="hdn_bookingDate">
        </div>
       </div>
      <div class="col-sm-1"><label>เวลา :</label> </div>
      <div class="col-sm-3">
       <table border="0" padding="0" width="100%">
        <tr>
          <td width="49%">


            <table width="100%">
          <tr>
            <td>
              <select class="form-control" id="obj_sHr"></select>
            </td>
            <td align='center' width="10px">:
            </td>
            <td>
              <select class="form-control" id="obj_sMn"></select>

            </td>
          </tr>
        </table>
          </td>
          <td>-</td>
          <td width="49%">
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
            <!--<input  
            class="form-control" type="time" id="obj_fTime" 
            placeholder="00:00">-->
          </td>
        </tr>
       </table>
       </div>
	    
	    <div class="col-sm-1">
	      <input type="button" id="btnDisplay" class="btn btn-primary"  value="เช็คตารางห้อง">
	    </div>
  	</div>
  	</div>
  	<div class="row">
  	<div class="col-sm-12">
  		 
  		 
  		 <div class="col-sm-1">
	      
	    </div>	
  	</div>
  </div>
  </div>

	</div>
	<div></div>
	<div class="box-body no-padding">


		<div class="col-sm-5" id="dvEmpty">
       
     
      <div class="box box-warning">
            <div class="box-header with-border">
              <h3 class="box-title"><b>ห้องว่าง</b></h3>
            </div>
            <table id="tblDisplayEmpty" class="table table-bordered table-hover">
            </table>
      </div>
    
      

    </div>
		<div class="col-sm-7" id="dvUsage">

     <div class="box box-success">
            <div class="box-header with-border">
              <h3 class="box-title"><b>ห้องที่ถูกใช้งาน</b></h3>
            </div>
            <table id="tblDisplayUsage" class="table table-bordered table-hover">
            </table>
      </div>

    </div>


	</div>

</div>
</section>
<script>
	 
   function listHr(){
      cb="";
      for(i=7;i<=17;i++){
          objHr=(i<10)?"0"+i:i;
          cb+="<option value="+objHr+">"+objHr+"</option>";
      }
      $("#obj_sHr").html(cb);
      $("#obj_fHr").html(cb);
      $("#obj_fHr").val("16");


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



    function displayRoomEmpty(){
      var sTime=$("#obj_sHr").val()+":"+$("#obj_sMn").val();
      var fTime=$("#obj_fHr").val()+":"+$("#obj_fMn").val();
      var building="27";
      var url="<?=$rootPath?>/tbooking/displayEmptyPage.php?building="+building+"&bookingDate="+$("#hdn_bookingDate").val()+"&sTime="+sTime+"&fTime="+fTime+"&bookingDate="+$("#obj_bookingDate").val();
      $("#tblDisplayEmpty").load(url);
    }

    function displayRoomUsage(){
      var sTime=$("#obj_sHr").val()+":"+$("#obj_sMn").val();
      var fTime=$("#obj_fHr").val()+":"+$("#obj_fMn").val();
      var building="27";

      var url="<?=$rootPath?>/tbooking/displayUsagePage.php?building="+building+"&sTime="+sTime+"&fTime="+fTime+"&bookingDate="+$("#obj_bookingDate").val();
      $("#tblDisplayUsage").load(url);
    }

    $(document).ready(function() {
        listHr();
        listMn();

        displayRoomEmpty();
        displayRoomUsage();


        $("#obj_bookingDate").change(function(){
          $("#hdn_bookingDate").val($("#obj_bookingDate").val());
          console.log($("#hdn_bookingDate").val());
        });


        $("#btnDisplay").click(function(){
          displayRoomEmpty();
          displayRoomUsage();
        });

      
    });
</script>