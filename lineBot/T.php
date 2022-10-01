<?php
include_once "../config/database.php";
include_once "../objects/tbooking.php";
include_once "../objects/manage.php";


$database=new Database();
$db=$database->getConnection();
$obj=new tbooking($db);

$id=isset($_GET["id"])?$_GET["id"]:0;

$stmt=$obj->getBookingNotify($id);
$stmt1=$obj->getBookingDetail($id);
//$objArr=array();
$msgT="";
$i=1;
if($stmt1->rowCount()>0){
    while($row1=$stmt1->fetch(PDO::FETCH_ASSOC)){
      extract($row1);
     
      $msgT.=" ".$i." ".$templateOption."\n";
      $i++;
    }
  } 


$objItem="";
if($stmt->rowCount()>0){
   $row=$stmt->fetch(PDO::FETCH_ASSOC);
    extract($row);
    $objItem=array("id"=>$id,
        "BookingName"=>$BookingName,
        "BookingRoom"=>$BookingRoom,
        "BookingDate"=>Format::getTextDate($BookingDate)." เวลา ".$startTime."-".$finishTime,
        "Activity"=>$Activity

      );
}



//$token = "mBKdqpUEr07RcnksZmdrQSrlUlSbU0pECJn70uPRuZc" ; // LINE Token
$token="H1KLTWtcV25z838W91Y06Jv2yl2NVxYtBtqtGpmc5cw";
/*if($objItem!==""){
  $msg = "\nผู้จอง: ".$objItem["BookingName"]." \n";
  $msg .= "กิจกรรม: ".$objItem["BookingRoom"]." \n";
  $msg .= "ห้อง: ".$objItem["BookingRoom"]." \n";
  $msg .= "วันที่จอง: ".$objItem["BookingDate"]." \n";
  $msg .= "อุปกรณ์: "."\n".$msgT." \n";

}*/

$msg="TEST By Programer.";



$sticker_package_id = '2';  // Package ID sticker
$sticker_id = '34';    // ID sticker
  $dataMsg = array (
    'message'=>$msg,
    'stickerPackageId' => $sticker_package_id,
    'stickerId' => $sticker_id
  );
  $chOne = curl_init();
  curl_setopt( $chOne, CURLOPT_URL, "https://notify-api.line.me/api/notify");
  curl_setopt( $chOne, CURLOPT_SSL_VERIFYHOST, 0);
  curl_setopt( $chOne, CURLOPT_SSL_VERIFYPEER, 0);
  curl_setopt( $chOne, CURLOPT_POST, 1);
  curl_setopt( $chOne, CURLOPT_POSTFIELDS, $dataMsg);
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