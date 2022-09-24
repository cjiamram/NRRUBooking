<html>
<head>
<title>NRRU Booking</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<style type="text/css">
.container-main {
  width: 100%;  
  min-height: 100vh;
  display: -webkit-box;
  display: -webkit-flex;
  display: -moz-box;
  display: -ms-flexbox;
  display: flex;
  flex-wrap: wrap;
  justify-content: center;
  align-items: center;
  padding: 15px;
  background: #7C24DD;
  background: -webkit-linear-gradient(-135deg, #7C24DD, #0099B9);
  background: -o-linear-gradient(-135deg, #7C24DD, #0099B9);
  background: -moz-linear-gradient(-135deg, #7C24DD, #0099B9);
  background: linear-gradient(-135deg, #7C24DD, #0099B9);
}
</style>
</head>
<body bgcolor="#7C24DD" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<!-- Save for Web Slices (bg_login.jpg - Slices: 00, 01, 02, 03, 04, 05, 06, 07, 08) -->
<div class="container-main">
<table id="Table_01" width="900" height="544" border="0" cellpadding="0" cellspacing="0">
	<tr>
		<td colspan="6">
			<img src="images/main_1_01.gif" width="900" height="106" alt=""></td>
	</tr>
	<tr>
		<td colspan="6">
			<img src="images/main_1_02.gif" width="900" height="287" alt=""></td>
	</tr>
	<tr>
		<td rowspan="3">
			<img src="images/main_1_03.gif" width="62" height="151" alt=""></td>
		<td colspan="3">
			<img src="images/main_1_04.gif" width="187" height="11" alt=""></td>
		<td rowspan="2">
			<img src="images/main_1_05.gif" width="299" height="84" alt=""></td>
		<td rowspan="3">
			<img src="images/main_1_06.gif" width="352" height="151" alt=""></td>
	</tr>
	<tr>
		<td>
			<img src="images/main_1_07.gif" width="1" height="73" alt=""></td>
		<td>
			<a href='#' onclick='clickSignon()'><img src="images/main_1_08.gif" width="185" height="73" alt="" border='0'></a></td>
		<td>
			<img src="images/main_1_09.gif" width="1" height="73" alt=""></td>
	</tr>
	<tr>
		<td colspan="4">
			<img src="images/main_1_10.gif" width="486" height="67" alt=""></td>
	</tr>
</table>
</div>
<!-- End Save for Web Slices -->
</body>
</html>
<script>
	function clickSignon(){
		//var url="https://cos.nrru.ac.th/php-azure/authen.php?workId=a2a8b0bc331ac58b265474307e87fbc61da977c1";
		var url="http://localhost/NRRUBooking/Tlogin.php";

		window.location.replace(url);
	}
</script>