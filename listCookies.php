<?php
session_start();
ob_start();

$user_id = 'chatchai.j@nrru.ac.th';
$timing_clock = "";

if(isset($_COOKIE["timing_type"])){
  // cookie's value  
  $timing_clock = setcookie("timing_type");
 // how to get cookie's name?
} else {
   echo("0");
}
?>