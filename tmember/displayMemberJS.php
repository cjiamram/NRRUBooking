<?php
	include_once "../config/config.php";
	include_once "../lib/classAPI.php";
	include_once "../config/database.php";
	include_once "../objects/classLabel.php";
	header("Access-Control-Allow-Origin: *");
	header("Content-Type: application/json; charset=UTF-8");
	header("Access-Control-Allow-Methods: POST");
	header("Access-Control-Max-Age: 3600");
	header("Access-Control-Allow-Headers: Content-Type,Access-Control-Allow-Headers, Authorization, X-Requested-With");
	$database = new Database();
	$db = $database->getConnection();
	$objLbl = new ClassLabel($db);
	$cnf=new Config();
	$rootPath=$cnf->path;
	$keyword=isset($_GET["keyWord"])?$_GET["keyWord"]:"";
	$url=$rootPath."/tmember/getData.php?keyWord=".$keyword;

?>
<table  id="tblSearchMember" class="table table-bordered table-hover">
<?php
		echo "<thead>";
		echo "<tr>";
			echo "<th>No.</th>";
			echo "<th>".$objLbl->getLabel("t_member","member","TH")."</th>";
			echo "<th>".$objLbl->getLabel("t_member","department","TH")."</th>";
			echo "<th>".$objLbl->getLabel("t_member","telNo","TH")."</th>";
			echo "<th>".$objLbl->getLabel("t_member","lineNo","TH")."</th>";
			echo "<th>".$objLbl->getLabel("t_member","email","TH")."</th>";
			echo "<th>จัดการ</th>";
		echo "</tr>";
		echo "</thead>";
?>
<tbody id="tbMember">

</tbody>

</table>

<script>
	function memberRendering(){
		var url='<?=$url?>';
		var data=queryData(url);
		if(data.length>0){
			var strT=""
			jQuery.each( data, function( i, val ) {
  				strT+="<tr>\n";
  					strT+="<td>"+(i+1)+"</td>\n";
  				
  					strT+="<td>"+val.title+' '+val.firstName+' '+val.lastName+"</td>\n";
  					strT+="<td>"+val.department+"</td>\n";
  					strT+="<td>"+val.telNo+"</td>\n";
  					strT+="<td>"+val.lineNo+"</td>\n";
  					strT+="<td>"+val.email+"</td>\n";
  					
  					strT+="<td>\n";
  					strT+="<button type='button' class='btn btn-info'\n";
  					strT+="data-toggle='modal' data-target='#modal-input'\n";
  					strT+="onclick='readOneMember("+val.id+")' data-dismiss='modal'>\n";
  					strT+="<span class='fa fa-hand-o-up'></span>\n";
  					strT+="</button></td>\n";
  				strT+="</tr>\n";
			});

			$("#tbMember").html(strT);
 
		}
	}

	memberRendering();

</script>
