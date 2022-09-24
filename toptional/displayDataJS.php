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
	$bookingId=isset($_GET["bookingId"])?$_GET["bookingId"]:"";
	//$path="toptional/getData.php?bookingId=".$bookingId;
	$url=$rootPath."/toptional/getData.php?bookingId=".$bookingId;;
/*$api=new ClassAPI();
$data=$api->getAPI($url);
echo "<thead>";
		echo "<tr>";
			echo "<th>No.</th>";
			echo "<th>".$objLbl->getLabel("t_optional","template","TH")."</th>";
			echo "<th>".$objLbl->getLabel("t_optional","description","TH")."</th>";
			echo "<th>".$objLbl->getLabel("t_optional","quantity","TH")."</th>";
			echo "<th>จัดการ</th>";
		echo "</tr>";
echo "</thead>";
if($data!=""){
echo "<tbody>";
$i=1;
foreach ($data as $row) {
		echo "<tr>";
			echo '<td>'.$i++.'</td>';
			echo '<td>'.$row["template"].'</td>';
			echo '<td>'.$row["description"].'</td>';
			echo '<td>'.$row["quantity"].'</td>';
			echo "<td>
			<button type='button' class='btn btn-info'
				data-toggle='modal' data-target='#modal-input'
				onclick='readOne(".$row['id'].")'>
				<span class='fa fa-edit'></span>
			</button>
			<button type='button'
				class='btn btn-danger'
				onclick='confirmDelete(".$row['id'].")'>
				<span class='fa fa-trash'></span>
			</button></td>";
			echo "</tr>";
}


}*/
?>
<table width="100%" class="table table-bordered table-hover" id="tblExtend">
	<?php
		echo "<thead>";
		echo "<tr>";
			echo "<th>No.</th>";
			echo "<th>".$objLbl->getLabel("t_optional","template","TH")."</th>";
			echo "<th>".$objLbl->getLabel("t_optional","description","TH")."</th>";
			echo "<th>".$objLbl->getLabel("t_optional","quantity","TH")."</th>";
			echo "<th>จัดการ</th>";
		echo "</tr>";
		echo "</thead>";
	?>

	<tbody id="tbExtend">

	</tbody>

</table>

<script>
	function extendRendering(){
		var url='<?=$url?>';
		var data=queryData(url);
		if(data.length>0){
			var strT="";
			jQuery.each( data, function( i, val ) {
			
  				strT+="<tr>\n";
  				strT+="<td>"+(i+1)+"</td>\n";
  				strT+="<td>"+val.template+"</td>\n";
  				strT+="<td>"+val.description+"</td>\n";
  				strT+="<td>"+val.quantity+"</td>\n";
  				strT+="<td>\n";
  				strT+="<button type='button'\n";
  				strT+="class='btn btn-danger'\n";
  				strT+="onclick='confirmDelete("+val.id+")'>";
  				strT+="<span class='fa fa-trash'></span>\n";
  				strT+="</button>\n";
  				strT+="</td>\n";
  				strT+="</tr>\n";
			});

			$("#tbExtend").html(strT);
 

		}
	}

	extendRendering();
</script>
