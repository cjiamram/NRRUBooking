<?php
		header("content-type:text/html;charset=UTF-8");
		include_once "../config/config.php";
		include_once "../lib/classAPI.php";
		$cnf=new Config();
		$rootPath=$cnf->path;
		$userCode=isset($_GET["userCode"])?$_GET["userCode"]:"";
		$url =$rootPath."/menu/listAuthorizeMenu.php?userName=".$userCode;
		//print_r($url);

?>
<table class="table table-bordered table-hover" id="tblMenu">
 </table>

 <script>
 	function authorizeRendering(){
 		var url='<?=$url?>';
 		var data=queryData(url);

 		if(data.length>0){
 			var strT="";
 			jQuery.each(data, function( i, val ) {
 				strT+="<tr>\n";
 				//console.log(val.IsExist);
 				if(val.IsExist>=1)	
 					strT1="<input type='checkbox' onchange=\"setAuthen('"+val.MenuId+"','#id-"+i+"')\" checked id='id-"+i+"'>\n";
 				else
 					strT1="<input type='checkbox' onchange=\"setAuthen('"+val.MenuId+"','#id-"+i+"')\"  id='id-"+i+"'>\n";
 				//console.log(val.LevelNo);	
 				if(val.LevelNo===0)
 					strT+="<td>&nbsp;&nbsp;&nbsp;&nbsp;"+strT1+val.MenuName+"<input type='hidden' id='menuId-"+i+"' value='"+val.MenuId+"'></td>\n";
 				else
 					strT+="<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"+strT1+val.MenuName+"<input type='hidden' id='menuId-"+i+"' value='"+val.MenuId+"'></td>\n";
 				strT+="</tr>\n";
			});
			
			$("#tblMenu").html(strT);
			//console.log(strT);
			
 
 		}
 	}
 	authorizeRendering();
 </script>