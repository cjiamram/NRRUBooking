<?php
	$user="chatchai.j";
	print_r(urlencode($user));
	$query=http_build_query(['userName'=>'chatchai.j','fullName'=>'chatchai jiamram']);
	header("location:"."testReceive.php?".$query)

?>