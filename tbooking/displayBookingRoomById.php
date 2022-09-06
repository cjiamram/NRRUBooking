
<?php
	header("content-type:text/html;charset=UTF-8");
	include_once "../config/config.php";
	include_once "../config/database.php";
	include_once "../lib/classAPI.php";
	include_once "../objects/toptional.php";
	include_once "../objects/manage.php";
	include_once "../vendor/autoload.php"; //important



	$api=new ClassAPI();
	$cnf=new Config();
	$database=new Database();
	$db=$database->getConnection();
	$objO=new toptional($db);
	$rootPath=$cnf->path;



	$id=isset($_GET["id"])?$_GET["id"]:0;

	function getOptional($objO,$bookingId,$templateCode){
			return $objO->isExist($bookingId,$templateCode);
	}


	function getExistOptional($objO,$bookingId){
				$stmt=$objO->getData($bookingId);
				$strT="<table width='100%' border='0' cellpading='0' cellspacing='0'>\n";
				$strT.="<tr><td><b>อุปกรณ์เสริม</b></td></tr>";
				if($stmt->rowCount()>0){

				
				while($row=$stmt->fetch(PDO::FETCH_ASSOC)){
					extract($row);
					$strT.="<tr><td>".$template."</td></tr>\n";
				   }
				}
				$strT.="</table>\n";
				return $strT;
	}

	$url=$cnf->restURL."/tbooking/getBookingRoomById.php?id=".$id;
	//print_r($url);
	$data=$api->getAPI($url);
	if(!isset($data["message"])){

		echo "<div id=\"dvCapture\"  style='background-color:2AC2D2;width:600px'>\n"; 

			echo "<table width='600px' border='1'>\n";
			echo "<tr>\n";
			echo "<td style='height:30px'>หมายเลขห้อง :</td>\n";
			echo "<td>".$data["bookingRoom"]."</td>\n";
			echo "</tr>\n";
			echo "<tr>\n";
			echo "<td style='height:30px'>วันที่จอง :</td>\n";
			echo "<td>".$data["bookingDate"]."</td>\n";
			echo "</tr>\n";
			echo "<tr>\n";
			echo "<td style='height:30px'>กิจกรรม :</td>\n";
			echo "<td>".$data["activity"]."</td>\n";
			echo "</tr>\n";
			echo "<tr>\n";
			echo "<td style='height:30px'>อุปกรณ์เสริม :</td>\n";
			echo "<td>".getExistOptional($objO,$data['id'])."</td>\n";
			echo "</tr>\n";
			echo "</table>\n";

		echo "<div>\n";
	}

?>

<script src="<?=$rootPath?>/js/jquery.min.js"></script>    
<script src="<?=$rootPath?>/dist/html2canvas.js"></script> 
<script src="<?=$rootPath?>/js/component.js"></script> 


<script>
function capture2Img(){
     
      var element = $("#dvCapture"); // global variable
      html2canvas(element, { 
              onrendered: function(canvas) { 
                        var getCanvas = canvas; 
                        var imgageData = getCanvas.toDataURL("image/png",1); 
                        var newData = imgageData.replace(/^data:image\/png/, "data:application/octet-stream");
                        var contents=newData;
                        var fileName="P-<?=$id?>.png";
                        var destFolder="../SCREEN";
                        var jsonObj={"contents":contents,"destFolder":destFolder,"fileName":fileName} ;
                        var flag=executeData("<?=$rootPath?>/saveStream/save2img.php",jsonObj,false);

        }
      });
  }

 capture2Img();

</script>


