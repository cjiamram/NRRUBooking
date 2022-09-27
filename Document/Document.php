<!DOCTYPE html>
<html>
  <head>
    <title>Document</title>
  </head>
  <body>
  	<?php
  		include_once "../config/config.php";
  		$cnf=new Config();
  		$url=$cnf->restURL."Document/Document.pdf";
  	?>
    
    <iframe src="<?=$url?>" width="100%" height="700px">
  </body>
</html>