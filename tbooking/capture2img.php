<?php
	header("content-type:text/html;charset=utf-8");
	include_once "../config/config.php";
	include_once "../lib/classAPI.php";
	include_once "../vendor/autoload.php"; //important
	$cnf=new Config();
	$id=isset($_GET["id"])?$_GET["id"]:38;
	$rootPath=$cnf->path;

	$url=$cnf->restURL."trequest/readOneNotify.php?id=".$id;
	//print_r($url);
	$api=new ClassAPI();
	$data=$api->getAPI($url);
	//print_r($data[0]);

	 echo "<div id=\"dvCapture\" style=\"background-color: #e2c6c6;  
                color: brown; width: 500px;  
                padding: 10px;\">\n"; 

	if($data!=""){
		
		echo "<table width='900px'>\n";
		echo "<tr><td width=\"150px\">ผู้แจ้ง:</td><td>".$data["notifyBy"]."</td></tr>\n";
		echo "<tr><td>ประเภทงาน:</td><td>".$data["requestType"]."</td></tr>\n";
		echo "<tr><td>วันที่แจ้ง:</td><td>".$data["createDate"]."</td></tr>\n";
		echo "<tr><td colspan=\"2\">".$data["requestDetail"]."</td></tr>\n";
		echo "</table>\n";
		
	}

	echo "</div>\n";
?>
<script src="../dist/jquery.min.js"></script>    
<script src="../dist/html2canvas.js"></script> 
<script src="../js/component.js"></script> 

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