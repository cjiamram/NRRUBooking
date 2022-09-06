<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type,Access-Control-Allow-Headers, Authorization, X-Requested-With");
use PHPMailer\PHPMailer\PHPMailer; //important, on php files with more php stuff move it to the top
use PHPMailer\PHPMailer\SMTP; //important, on php files with more php stuff move it to the top
date_default_timezone_set('Etc/UTC');

include_once "../vendor/autoload.php"; //important
include_once "../config/config.php";
include_once "../lib/classAPI.php";
include_once "../config/database.php";
include_once "../objects/tzoombooking.php";
include_once "../objects/manage.php";

$database=new Database();
$db=$database->getConnection();
$obj=new tzoombooking($db);

$cnf=new Config();
$api=new ClassAPI();

$id=isset($_GET["id"])?$_GET["id"]:0;
$licenseId=isset($_GET["licenseId"])?$_GET["licenseId"]:"";

$url=$cnf->redirectURI."/zoomCreate.php?licenseId=".$licenseId."&id=".$id;

//print_r($url);

$data=$api->getAPI($url);

//echo json_encode($data);

if($data["flag"]===true){
	$res=$obj->getRequest($id);

	//print_r($res);

	$mail = new PHPMailer(true); //important
	$mail->CharSet = 'UTF-8';  //not important
	$mail->isSMTP(); //important
	$mail->Host = 'smtp.office365.com'; //important
	$mail->Port       = 587; //important
	$mail->SMTPSecure = 'tls'; //important
	$mail->SMTPAuth   = true; //important, your IP get banned if not using this
	$mail->IsHTML(true);  

	$mail->Username = 'NRRUBot@nrru.ac.th';
	$mail->Password = 'Nrru2021';

	//Set who the message is to be sent from, you need permission to that email as 'send as'
	$mail->SetFrom('NRRUBot@nrru.ac.th', 'Zoom meeting Admin Group.'); //you need "send to" permission on that account, if dont use yourname@mail.org

	//Set an alternative reply-to address
	//$mail->addReplyTo($lineNo, 'First Last');

	//Set who the message is to be sent to
	$mail->addAddress($res["lineNo"], 'Participant');
	//Set the subject line
	$mail->Subject = 'Request NRRU Zoom Meeting.';

	$body="<Table>\n";
	$body.="<tr><td>หัวข้อ :</td><td>".$res["activity"]."</td></tr>";
	$body.="<tr><td>วันที่จอง :</td><td>".$res["sDate"]."</td></tr>";
	$body.="<tr><td>สิ้นสุด :</td><td>".$res["fDate"]."</td></tr>";
	$body.="<tr><td>join url :</td><td>".$data["joinURL"]."</td></tr>\n";
	$body.="<tr><td>ID :</td><td>".$data["id"]."</td></tr>\n";
	$body.="<tr><td>Password :</td><td>".$data["password"]."</td></tr>\n";
	$body.="</Table>\n";


	$mail->Body     =  $body;

	if (!$mail->send()) {
		echo json_encode(array("message"=>false,"errInfo"=> $mail->ErrorInfo));
	} else
	{
		echo json_encode(array("message"=>true));
	
	}



	//echo json_encode(array("flag"=>true));
}


?>