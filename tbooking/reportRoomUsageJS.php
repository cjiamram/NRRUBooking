<?php
    include_once "../config/config.php";
    $cnf=new Config();
    $rootPath=$cnf->path;
    $cDate=date("Y-m-d");
    $fDate=date_create($cDate);
    date_add($fDate,date_interval_create_from_date_string("40 days"));
    //$fDate=date($fDate,"Y-m-d")

?>
<script src="<?=$rootPath?>/bower_components/jquery/dist/jquery.min.js"></script>
<script src="<?=$rootPath?>/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="<?=$rootPath?>/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?=$rootPath?>/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>

<section class="content container-fluid">
<div class="box">
<table class="table table-bordered table-hover">
<tr>
	<td width="80px">ระหว่างวัน
	</td>
	<td width="150px">
		<div class="col-sm-12">
				<div class="input-group date">
				<div class="input-group-addon">
				<i class="fa fa-calendar"></i>
				</div>
				<input type="date"  class="form-control"  id="obj_sDate">
				</div>
			</div>
	</td>
	<td width="150px">
		<div class="col-sm-12">
				<div class="input-group date">
				<div class="input-group-addon">
				<i class="fa fa-calendar"></i>
				</div>
				<input type="date"  class="form-control"  id="obj_fDate">
				</div>
			</div>
	</td>
    <td width="70px">ห้อง
    </td>
    <td>
        <select id="obj_room" class="form-control"></select>
    </td>
     <td width="70px">ผู้จอง
    </td>
    <td>
        <input type="text" class="form-control" id="obj_reserver">
    </td>
	<td>
		<input type="button" id="btnReport" value="แสดงผล"  class="btn btn-primary" >

	</td>
</tr>

</table>

</div>
<hr>

<div class="box box-warning">
    <div id="dvReport">
    </div>
</div>

</section>



<script>

 function listRoom(building){
      var url="troom/listRoom.php?building="+building;
      setDDLPrefix(url,"#obj_room","***เลือกห้องทั้งหมด***");
    }


function roomUsageReport(){

    var url="<?=$rootPath?>/tbooking/displayRoomUsageJS.php?sDate="+$("#obj_sDate").val()+"&fDate="+$("#obj_fDate").val()+"&bookingRoom="+$("#obj_room").val()+"&bookingName="+$("#obj_reserver").val();
    console.log("xxxxxxx");
    $("#dvReport").load(url);
}


function addDays(theDate, days) {
            return new Date(theDate.getTime() + days*24*60*60*1000);
    }

    function setInitialize(){
            var now = new Date();
            var day = ("0" + now.getDate()).slice(-2);
            var month = ("0" + (now.getMonth() + 1)).slice(-2);
            var today = now.getFullYear()+"-"+(month)+"-"+(day) ;
            $('#obj_sDate').val(today);
            
            var lastDate=addDays(now, 30*3);
            day = ("0" + lastDate.getDate()).slice(-2);
            month = ("0" + (lastDate.getMonth() + 1)).slice(-2);
            var lastDay = lastDate.getFullYear()+"-"+(month)+"-"+(day) ; 
            $('#obj_fDate').val(lastDay);

            listRoom("27");

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
                url="<?=$rootPath?>/tbooking/delete.php?id="+id;
                var flag=executeGet(url);
             	
                    swal.fire({
                                title: "ลบข้อมูลเรียบร้อยแล้ว",
                                type: "success",
                                buttons: "ตกลง",
                    }).then((result)=>{
                        roomUsageReport();
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


$( document ).ready(function() {
    setInitialize();

    roomUsageReport();

   $("#btnReport").click(function(){
   		roomUsageReport();
   });
});
</script>