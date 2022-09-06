<?php
	use PHPMailer\PHPMailer\PHPMailer; //important, on php files with more php stuff move it to the top
	use PHPMailer\PHPMailer\SMTP; //important, on php files with more php stuff move it to the top

	include_once "vendor/autoload.php"; //important

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
	//$mail->addAddress("chatchai.j@nrru.ac.th", 'Participant');
	$mail->addAddress("chatchai.j@nrru.ac.th", 'Participant');
	//Set the subject line
	$mail->Subject = 'Request NRRU Zoom Meeting.';

	$body="<Table>\n";
	$body.="<tr><td>หัวข้อ :<td></td>xxxxxxxxxxxxx</td></tr>";
	$body.="<tr><td>join url :<td></td>12233333</td></tr>\n";
	$body.="<tr><td>ID :<td></td>cccccccccccc</td></tr>\n";
	$body.="<tr><td>Password :<td></td>1223333</td></tr>\n";
	$body.="</Table>\n";


	$mail->Body     =  $body;

	if (!$mail->send()) {
    		//echo 'Mailer Error: ' . $mail->ErrorInfo;
		echo json_encode(array("message"=>false,"errInfo"=> $mail->ErrorInfo));
	} else
	{
		echo json_encode(array("message"=>true));
	
	}


?>