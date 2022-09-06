<!DOCTYPE html>
<?php
	header("content-type:text/html;charset=UTF-8");
	include_once "../config/config.php";
	include_once "../config/database.php";
	include_once "../objects/troom.php";
	$database=new Database();
	$db=$database->getConnection();
	$obj=new troom($db); 
	$cnf=new Config();
	$rootPath=$cnf->path;

	$roomNo=isset($_GET["roomNo"])?$_GET["roomNo"]:"";

	$stmt=$obj->getImages($roomNo);

	if($stmt->rowCount()>0){
		$row=$stmt->fetch(PDO::FETCH_ASSOC);
		extract($row);
		$panoURL=$cnf->restURL.$pano;
		//$planURL=$cnf->restURL.$plan;
	}

?>

<html>
	<head>
		<meta http-equiv="content-type" content="text/html; charset=UTF-8">
		<title>Room PANO</title>
		<style>
		html,body {
			height: 100%;
		}
		.pano {
			width: 100%;
			height: 100%;
			margin: 0 auto;
			cursor: move;
		}
		.pano .controls {
			position: relative;
			top: 40%;
		}
		.pano .controls a {
			position: absolute;
			display: inline-block;
			text-decoration: none;
			color: #eee;
			font-size: 3em;
			width: 20px;
			height: 20px;
		}
		.pano .controls a.left {
			left: 10px;
		}
		.pano .controls a.right {
			right: 10px;
		}
		.pano.moving .controls a {
			opacity: 0.4;
			color: #eee;
		}
		</style>
	</head>
	<body>
	<div id="myPano" class="pano">
			<div class="controls">
				<a href="#" class="left">&laquo;</a>
				<a href="#" class="right">&raquo;</a>
			</div>
		</div>

		
		
		<script src="<?=$rootPath?>/js/jquery-3.5.1.js"></script>
		<script src="<?=$rootPath?>/js/jquery.pano.js"></script>

		
		<script>
		/* jshint jquery: true */
		jQuery(function($){
			var panoImg='<?=$panoURL?>';
			//console.log(panoImg);
			$("#myPano").pano({
				img: panoImg
			});
		});
		</script>
	</body>
</html>
