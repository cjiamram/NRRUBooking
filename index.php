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
<table id="Table_01" width="1001" height="604" border="0" cellpadding="0" cellspacing="0">
	<tr>
		<td rowspan="6">
			<img src="images_cos/COS_1_1000_01.gif" width="107" height="604" alt=""></td>
		<td rowspan="2">
			<img src="images_cos/COS_1_1000_02.gif" width="419" height="335" alt=""></td>
		<td colspan="2">
			<img src="images_cos/COS_1_1000_03.gif" width="474" height="185" alt=""></td>
		<td>
			<img src="images_cos/spacer.gif" width="1" height="185" alt=""></td>
	</tr>
	<tr>
		<td colspan="2" rowspan="2">
			<img src="images_cos/COS_1_1000_04.gif" width="474" height="240" alt=""></td>
		<td>
			<img src="images_cos/spacer.gif" width="1" height="150" alt=""></td>
	</tr>
	<tr>
		<td>
			<img src="images_cos/COS_1_1000_05.gif" width="419" height="90" alt=""></td>
		<td>
			<img src="images_cos/spacer.gif" width="1" height="90" alt=""></td>
	</tr>
	<tr>
		<td rowspan="2">
			<img src="images_cos/COS_1_1000_06.gif" width="419" height="119" alt=""></td>
		<td rowspan="3">
			<img src="images_cos/COS_1_1000_07.gif" width="247" height="179" alt=""></td>
		<td>
			<img src="images_cos/COS_1_1000_08.gif" width="227" height="89" alt=""></td>
		<td>
			<img src="images_cos/spacer.gif" width="1" height="89" alt=""></td>
	</tr>
	<tr>
		<td rowspan="2"><a href='#' onclick='clickSignon()'>
			<img src="images_cos/COS_1_1000_09.gif" border='0' width="227" height="90" alt="">
				</a>
		</td>
		<td>
			<img src="images_cos/spacer.gif" width="1" height="30" alt=""></td>
	</tr>
	<tr>
		<td>
			<img src="images_cos/COS_1_1000_10.gif" width="419" height="60" alt=""></td>
		<td>
			<img src="images_cos/spacer.gif" width="1" height="60" alt=""></td>
	</tr>
</table>
</div>
<!-- End Save for Web Slices -->
</body>
</html>
<script>
	function clickSignon(){
		var url="https://cos.nrru.ac.th/php-azure/authen.php?workId=a2a8b0bc331ac58b265474307e87fbc61da977c1";
		//var url="http://localhost/NRRUBooking/TLogin.php";

		window.location.replace(url);
	}
</script>