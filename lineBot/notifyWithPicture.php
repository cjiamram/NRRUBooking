<?php
include_once "../config/config.php";
include_once "../lib/classAPI.php";

$cnf=new Config();
$api=new classAPI();
$restURL=$cnf->restURL;
$id=isset($_GET["id"])?$_GET["id"]:0;
$path="tbooking/getBookingNotify.php?id=".$id;


$url=$cnf->restURL.$path;

$data=$api->getAPI($url);
//print_r($data);
$id=isset($_GET["id"])?$_GET["id"]:0;
//$picture=$restURL."/SCREEN/P-".$id.".png";
$token = "mBKdqpUEr07RcnksZmdrQSrlUlSbU0pECJn70uPRuZc" ; // LINE Token

if(!isset($data["message"])){
  $msg = "\nผู้จอง: ".$data["BookingName"]." \n";
  $msg .= "ห้อง: ".$data["BookingRoom"]." \n";
  $msg .= "วันที่จอง: ".$data["BookingDate"]." \n";
}



//$imageFile = new CURLFILE($picture); // Local Image file Path
//'imageFile' => $imageFile,
$sticker_package_id = '2';  // Package ID sticker
$sticker_id = '34';    // ID sticker
  $data = array (
    'message'=>$msg,
    'stickerPackageId' => $sticker_package_id,
    'stickerId' => $sticker_id
  );
  $chOne = curl_init();
  curl_setopt( $chOne, CURLOPT_URL, "https://notify-api.line.me/api/notify");
  curl_setopt( $chOne, CURLOPT_SSL_VERIFYHOST, 0);
  curl_setopt( $chOne, CURLOPT_SSL_VERIFYPEER, 0);
  curl_setopt( $chOne, CURLOPT_POST, 1);
  curl_setopt( $chOne, CURLOPT_POSTFIELDS, $data);
  curl_setopt( $chOne, CURLOPT_FOLLOWLOCATION, 1);
  $headers = array( 'Method: POST', 'Content-type: multipart/form-data', 'Authorization: Bearer '.$token, );
  curl_setopt($chOne, CURLOPT_HTTPHEADER, $headers);
  curl_setopt( $chOne, CURLOPT_RETURNTRANSFER, 1);
  $result = curl_exec( $chOne );
  //Check error
  if(curl_error($chOne)) { echo 'error:' . curl_error($chOne); }
  else { $result_ = json_decode($result, true);
  echo "status : ".$result_['status']."\n";  
  echo  "message : ". $result_['message']; 
  }
  //Close connection
  curl_close( $chOne );

  ?>