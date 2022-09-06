<?php
      session_start();
      include_once '../config/database.php';
      include_once '../config/config.php';
      include_once "../objects/classLabel.php";
      $cnf=new Config();
      $tableName=isset($_GET["tableName"])?$_GET["tableName"]:"";
      $dbName=isset($_GET["dbName"])?$_GET["dbName"]:"";
      $tName=str_replace("_", "", $tableName);
      $database=new Database();
      $db=$database->getConnection();
      $objLbl = new ClassLabel($db);
      $path=$cnf->restURL;
      $url=$cnf->restURL;
      $rootPath=$cnf->path;
?>
<script src="<?=$rootPath?>/bower_components/jquery/dist/jquery.min.js"></script>
<script src="<?=$rootPath?>/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<link href='<?=$rootPath?>/js/lib/main.css' rel='stylesheet' />
<script src='<?=$rootPath?>/js/lib/main.js'></script>
<script src='<?=$rootPath?>/js/lib/locales-all.js'></script>

<input type="hidden" id="obj_outsiderId" value="">
<input type="hidden" id="obj_bookingId" value="">
<input type="hidden" id="obj_extendId" value="">
<section class="content-header">
     <h1>
       <b>ระบบการจองห้องประชุม</b>

        <small>>>จองสำหรับบุคคลภายนอก</small>
      </h1>
      <ol class="breadcrumb">
   
        <table width="100%" cellspacing="2" cellpading="2">
          <tr>
           
            <td width="60%" align="center">
                <input type="button" id="btnSearch"  class="btn btn-success col-sm-12"  value="ค้นหา">
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
            
             </div>
             <div>
              <div  class="col-sm-4">
              </div>
          </div>
          </div>
        </div>

      <div>&nbsp;</div>
      <div class="col-sm-7">
      <div class="box box-warning">
      <div class="box-header with-border">
      <h3 class="box-title"><b>ข้อมูลผู้ขอรับบริการ</b></h3>
      </div>
     

      <form role='form' >
		<div class="box-body">
		<div class='form-group'>
			<label class="col-sm-12"><?php echo $objLbl->getLabel("t_outsider","Outsider","th").":"; ?></label>
			<div class="col-sm-12">
			<table width="100%">
				<tr>
				<td width="150px">
	
					<select class="form-control" id="obj_Title"></select>
				</td>
				<td>&nbsp;
				</td>
				<td>
					<input type="text" 
							class="form-control" id='obj_firstName' 
							placeholder='ชื่อ'>
           
				</td>
				<td>&nbsp;
				</td>
				<td>
					<input type="text" 
							class="form-control" id='obj_lastName' 
							placeholder='สกุล'>
          
				</td>
				</tr>
			</table>
			</div>
		</div>
		
		<div class='form-group'>
			<label class="col-sm-12"><?php echo $objLbl->getLabel("t_outsider","department","th").":"; ?></label>
			<div class="col-sm-12">
				<input type="text" 
							class="form-control" id='obj_department' 
							placeholder='<?=$objLbl->getLabel("t_outsider","department","th")?>'>
			</div>
		</div>
		
		<div class='form-group'>
			<label class="col-sm-12"><?php echo $objLbl->getLabel("t_outsider","projectName","th").":"; ?></label>
			<div class="col-sm-12">
				<input type="text" 
							class="form-control" id='obj_projectName' 
							placeholder='<?=$objLbl->getLabel("t_outsider","projectName","th")?>'>

			</div>
		</div>
		<div class='form-group'>
			<label class="col-sm-12"><?php echo $objLbl->getLabel("t_outsider","description","th").":"; ?></label>
			<div class="col-sm-12">

				<textarea class="form-control" id='obj_decription' 
					rows="4" cols="50"

				></textarea>
			</div>
		</div>

		<div class='form-group'>
			<label class="col-sm-12"><?php echo $objLbl->getLabel("t_outsider","telNo","th").":"; ?></label>
			<div class="col-sm-12">
				<input type="text" 
							class="form-control" id='obj_telNo' 
							placeholder='<?=$objLbl->getLabel("t_outsider","telNo","th")?>'>
			</div>
		</div>
		<div class='form-group'>
			<label class="col-sm-12"><?php echo $objLbl->getLabel("t_outsider","lineNo","th").":"; ?></label>
			<div class="col-sm-12">
				<input type="text" 
							class="form-control" id='obj_lineNo' 
							placeholder='<?=$objLbl->getLabel("t_outsider","lineNo","th")?>'>
			</div>
		</div>
		<div class='form-group'>
			<label class="col-sm-12"><?php echo $objLbl->getLabel("t_outsider","email","th").":"; ?></label>
			<div class="col-sm-12">
				<input type="text" 
							class="form-control" id='obj_email' 
							placeholder='email'>
			</div>
		</div>
		<div class='form-group'>
			<label class="col-sm-12"><?php echo $objLbl->getLabel("t_outsider","budget","th").":"; ?>/<?php echo $objLbl->getLabel("t_outsider","budget1","th").":"; ?></label>
			<div class="col-sm-4">
				<input type="text" 
							class="form-control" id='obj_budget' 
							placeholder='<?=$objLbl->getLabel("t_outsider","budget","th")?>'>
			</div>
      <div class="col-sm-4">
        <input type="text" 
              class="form-control" id='obj_budget1' 
              placeholder='<?=$objLbl->getLabel("t_outsider","budget1","th")?>'>
      </div>
      <div class="col-sm-4">&nbsp;
      </div>
		</div>
		<div class='form-group'>
			<label class="col-sm-12"><?php echo $objLbl->getLabel("t_outsider","doc","th").":"; ?></label>
			<div class="col-sm-12">
				<input type="file" 
							class="form-control" id='obj_doc' 
							placeholder='doc' onchange="readFile(this)">
				<input type="hidden" id="obj_fileAttach" >
			</div>
		</div>
		<div class='form-group'>
			<label class="col-sm-12" id="lblBookingRoom">ระบุห้อง:</label>
			
			<div class="col-sm-12">
			
				<select class="form-control" id='obj_bookingRoom' ></select>
			</div>
		</div>
		<div class='form-group' >
			<label class="col-sm-12"  id="lblBookingDate">กำหนดวัน:</label>
			
			<table width="100%">
			<tr>
			<td width="50%">
				<div class="col-sm-12">
				<div class="input-group date">
				<div class="input-group-addon">
				<i class="fa fa-calendar"></i>
				</div>
				<input type="date" value="<?=date("Y-m-d")?>" class="form-control" id="obj_bookingDate">
				</div>
			</div>
			</td>
			<td width="24%">
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
			<td align="center">-
			</td>
			<td>

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
			</tr>	
			</table>
			
		</div>
	<div class='form-group'>
		<div class="col-sm-12">
      <input type="button" id="btnNew" value="เพิ่มใหม่"  class="btn btn-primary">
			<input type="button" id="btnSave" value="บันทึก"  class="btn btn-success">
		</div>
	</div>
</div>
</form>
</div>  
</div>
<div class="col-sm-5">
 <div class="box box-danger" id="dvExtend">
   <div class="box-header with-border">
      <h3 class="box-title"><b>เพิ่มเติม</b></h3>
      </div>
  <table width="100%" class="table table-bordered table-hover">
 
    <tr>
      <td width="150px">
        เพิ่มเติม
      </td>
      <td >
        <select class="form-control" id="obj_template"></select>
      </td>
      </tr>
      <tr> 
      <td>
        รายละเอียด
      </td>
      <td>
         <input type="text" class="form-control" id="obj_templateDesc">
      </td>
    </tr>
     <tr> 
      <td>
        จำนวน
      </td>
      <td>
         <input type="text" class="form-control" style="width:80px" id="obj_qty">
      </td>
    </tr>
      <tr>
      <td>
        <button id="btnExtend" class="btn btn-success">เพิ่ม</button>
      </td>
    </tr>
  </table>

  <table width="100%" class="table table-bordered table-hover" id="tblExtend">
  </table>
</div>
</div>
        
 </section>


   

     <div class="modal fade" id="modal-search">
        <div class="modal-dialog" style="width:800px" id="dvSearch">
           <div class="modal-content">
            <div class="box-header with-border">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">ข้อมูลสมาชิก</h4>
           </div>
           <div class="modal-body" id="dvAdvBody">
         
       <table width="100%" >
        <tr>
          <td width="70%">
                
                <div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-search"></i>
                  </div>
                  <input type="text" class="form-control pull-right" id="txtSearch">
                </div>
          </td>
          <td>
          </td>
        </tr>
        <tr>
          <td colspan="2">&nbsp;
          </td>
        </tr>
        <tr>
          <td colspan="2">
              <div class="box box-success">
       
                 <table  id="tblSearchMember" class="table table-bordered table-hover">
                 </table>
        
              </div>
          </td>
        </tr>
       </table>  
     
     

      

     
           
           </div>
          <div>
                 <div class="modal-footer">
                    <input type="button" id="btnAdvClose" value="ปิด"  class="btn btn-default pull-left" data-dismiss="modal">
                </div>
           </div>
        </div>
     </div>
   </div>

   <script>
  var path='<?php echo $path; ?>';
  var headURl='<?php 
      echo $url;
   ?>';
  var flagSaveOutsider=false;
  


  function readOneMember(id){
   
    var url="<?=$rootPath?>/tmember/readOne.php?id="+id;
   
    var data=queryData(url);
    
        //$("#obj_outsiderId").val(data.id);
        $("#obj_Title").val(data.title);
        $("#obj_firstName").val(data.firstName);
        $("#obj_lastName").val(data.lastName);
        $("#obj_department").val(data.department);
        $("#obj_telNo").val(data.telNo);
        $("#obj_lineNo").val(data.lineNo);
        $("#obj_email").val(data.email);
        //$("#obj_email").val(data.email);
  }

  function isExistMember(){
    var firstName=$("#obj_firstName").val();
    var lastName=$("#obj_lastName").val();

    var url ="<?=$rootPath?>/tmember/isExist.php?firstName="+firstName+"&lastName="+lastName;
    var data=queryData(url);
    return data.flag;

  } 

  function createMember(){
    var url="<?=$rootPath?>/tmember/create.php";
    var jsonObj={
      title:$("#obj_Title").val(),
      firstName:$("#obj_firstName").val(),
      lastName:$("#obj_lastName").val(),
      department:$("#obj_department").val(),
      telNo:$("#obj_telNo").val(),
      lineNo:$("#obj_lineNo").val(),
      email:$("#obj_email").val()
    }
    var jsonData=JSON.stringify(jsonObj);
    var flag=executeData(url,jsonObj,false);
    return flag;
  }

  function saveMember(){
      if(isExistMember()==false){
          createMember();
      }
  }

  function isExist(){
      var sTime=$("#obj_sHr").val()+":"+$("#obj_sMn").val();
      var fTime=$("#obj_fHr").val()+":"+$("#obj_fMn").val();
      var url="<?=$rootPath?>/tbooking/isExist.php?roomNo="+$("#obj_bookingRoom").val()+"&bookingDate="+$("#obj_bookingDate").val()+"&sTime="+sTime+"&fTime="+fTime;
      
      var data=queryData(url);
      return data.flag;
    }

  function hideExtend() {
        document.getElementById("dvExtend").style.display = "none";
  }

  function showExtend() {
        document.getElementById("dvExtend").style.display = "block";
  }
  
   function readFile(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#obj_fileAttach').val(e.target.result);
            };
            reader.readAsDataURL(input.files[0]);
        }
    }


  function readOne(id){
    var url='<?=$rootPath?>/toptional/readOne.php?id='+id;
    data=queryData(url);
    if(data!=""){
          $("#obj_bookingId").val(data.bookingId);
          $("#obj_template").val(data.template);
          $("#obj_description").val(data.description);
          $("#obj_quantity").val(data.quantity);
          $("#obj_extendId").val(data.id);
    }
  }



  function searchMember(){
     var url="<?=$rootPath?>/tmember/displayData.php?keyWord="+$("#txtSearch").val();
     console.log(url);
     $("#tblSearchMember").load(url);
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
      url="/roomReserve/toptional/delete.php?id="+id;
      executeGet(url);
      displayExtend();
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




   function listHr(){
      cb="";
      for(i=7;i<=17;i++){
          objHr=(i<10)?"0"+i:i;
          cb+="<option value="+objHr+">"+objHr+"</option>";
      }
      $("#obj_sHr").html(cb);
      $("#obj_fHr").html(cb);
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

     function listBookingRoom(building){
      var url="<?=$rootPath?>/troom/listRoom.php?building="+building;
      setDDL(url,"#obj_bookingRoom");
    }

   	function getTitle(){
   		var url="<?=$rootPath?>/ttitle/getData.php";
   		setDDLPrefix(url,"#obj_Title","***เลือก***")
   	}

    function getTemplate(){
      var url="<?=$rootPath?>/ttemplate/getData.php";
      setDDLPrefix(url,"#obj_template","***เลือก***")
    }

   	function getLastId(){
   		var url ="<?=$rootPath?>/toutsider/getLastId.php";
   		var data=executeGet(url);
   		return data.MxId;
   	}

    function getBookingLastId(){
      var url ="<?=$rootPath?>/tbooking/getLastId.php";
      var data=executeGet(url);
      return data.MxId;
    }


    function createOptional(){
        var url="<?=$rootPath?>/toptional/create.php";
        var jsonObj={
            bookingId:$("#obj_bookingId").val(),
            template:$("#obj_template").val(),
            description:$("#obj_templateDesc").val(),
            quantity:$("#obj_qty").val()
          }
        var jsonData=JSON.stringify (jsonObj);
        var flag=executeData(url,jsonObj,false);
        return flag;
    }

    function displayExtend(){
       var bookingId=$("#obj_bookingId").val();

       //var url="/roomReserve/toptional/displayData.php?bookingId="+bookingId;
       var url="<?=$rootPath?>/toptional/displayData.php?tableName=t_optional&dbName=dbreserveroom&bookingId="+$("#obj_bookingId").val();
       console.log(url);
      $("#tblExtend").load(url);

    }

    
     function sendNotify(){
        var id=$("#obj_bookingId").val();
        var url="<?=$rootPath?>/tbooking/displayNotify.php?id="+id;
        var data=queryData(url);
        url="<?=$rootPath?>/lineBot/sendNotify.php";
        var link=headURl+'tbooking/displayBookingDetail.php?bookingId='+id;
        var jsonObj={
          message:data.message+link
        }

        var jsonData=JSON.stringify(jsonObj);
        executeData(url,jsonObj,false);

    }

   	function saveData(){
   		var flag;
   		
      if(flagSaveOutsider==false || $("#obj_outsiderId").val()==""){
          saveMember();
          flag=createData();
      }
      else
          flag=true;
   		

      if(flag==true){


        if(isExist()!=true){
              if($("#obj_outsiderId").val()!=""){
                  var lastId=getLastId();
                  $("#obj_outsiderId").val(lastId);
              }
              bookingRoom();
             // sendNotify();
              var lastBookingId=getBookingLastId();
              $("#obj_bookingId").val(lastBookingId);
              showExtend();
              flagSaveOutsider=false;

              
        		   swal.fire({
        					title: "การบันทึกข้อมูลเสร็จสมบูรณ์แล้ว",
        					type: "success",
        					buttons: [false, "ปิด"],
        					dangerMode: true,
        			});

        }
        else{
             flagSaveOutsider=true;
             swal.fire({
                          title: "กรุณาตรวจสอบช่วงเวลาการจองอีกครั้งช่วงเวลามีการซ้อนทับ",
                          type: "error",
                          buttons: [false, "ปิด"],
                          dangerMode: true,
              });
        }
      } 
   	}

   	function  bookingRoom(){
    	var url="<?=$rootPath?>/tbooking/create.php";
    	var jsonObj={
    		bookingRoom:$("#obj_bookingRoom").val(),
    		bookingDate:$("#obj_bookingDate").val(),
    		startTime:$("#obj_sHr").val()+":"+$("#obj_sMn").val(),
    		finishTime:$("#obj_fHr").val()+":"+$("#obj_fMn").val(),
    		bookingName:$("#obj_Title").val()+' '+$("#obj_firstName").val()+' '+$("#obj_lastName").val(),
    		staffId:$("#obj_staffId").val(),
    		activity:$("#obj_projectName").val(),
    		telNo:$("#obj_telNo").val(),
    		lineNo:$("#obj_lineNo").val(),
        outsiderId:$("#obj_outsiderId").val(),
    		status:0
    	};
    	var jsonData=JSON.stringify (jsonObj);
    	//console.log(jsonData);
    	var flag=executeData(url,jsonObj,false);
    	return flag;
   	}

   	function createData(){
		var url='<?=$rootPath?>/toutsider/create.php';

		if($("#obj_doc").val()!=""){
            	var file=$("#obj_doc").val().split('\\').pop();
            	var fileName =  path+"uploads/"+$("#obj_email").val()+"/"+file;
            	fileUpload("obj_doc","../uploads/"+$("#obj_email").val());
            	$("#obj_fileAttach").val(fileName);
     }


		jsonObj={
			title:$("#obj_Title").val(),
			firstName:$("#obj_firstName").val(),
			lastName:$("#obj_lastName").val(),
			department:$("#obj_department").val(),
			doc:$("#obj_fileAttach").val(),
			decription:$("#obj_decription").val(),
			projectName:$("#obj_projectName").val(),
			telNo:$("#obj_telNo").val(),
			lineNo:$("#obj_lineNo").val(),
			email:$("#obj_email").val(),
			budget:$("#obj_budget").val(),
      budget1:$("#obj_budget1").val()
		}
		var jsonData=JSON.stringify (jsonObj);
    console.log(jsonData);
		var flag=executeData(url,jsonObj,false);
		return flag;
 
 }

 function validSave(){
    if($("#obj_projectName").val()==""||$("#obj_bookingRoom").val()==""||$("#obj_budget").val()=="" ||$("#obj_firstName").val()==""||$("#obj_lastName").val()==""){
      return false;
    }
    else
      return true;
 }

 function clearData(){
        $("#obj_firstName").val("");
        $("#obj_lastName").val("");
        $("#obj_department").val("");
        $("#obj_telNo").val("");
        $("#obj_lineNo").val("");
        $("#obj_email").val("");
        $("#obj_decription").val("");
        $("#obj_budget").val(0);
        $("#obj_budget1").val(0);
        $("#obj_projectName").val("");
        $("#tblExtend").html("<tr><td></td></tr>");
        hideExtend();
        $("#obj_template").val("");
 }
   	

   	$(document).ready(function(){
   		getTitle();
   		listHr();
   		listMn();
      getTemplate();
   		listBookingRoom("");
      //hideExtend();
      clearData();

      $("#txtSearch").change(function(){
          searchMember();
      });

      $("#btnSearch").click(function(){
         $('#modal-search').modal('toggle');
        searchMember();
      });

      $("#btnNew").click(function(){
          clearData();
      });

      $("#btnSave").click(function(){
        if(validSave()==true)
            saveData();
        else
        {

               swal.fire({
                  title: "กรุณากรอกข้อมูลที่มีความจำเป็นให้ครบถ้วน",
                  type: "success",
                  buttons: [false, "ปิด"],
                  dangerMode: true,
              });
        }
      });



      $("#btnExtend").click(function(){
        createOptional();
        displayExtend();
      });
   	})
   </script>