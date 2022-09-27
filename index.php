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
<table id="Table_01" width="1001" height="605" border="0" cellpadding="0" cellspacing="0">
	<tr>
		<td rowspan="2">
			<img src="images_cos/T_01.gif" width="152" height="332" alt=""></td>
		<td rowspan="2">
			<img src="images_cos/T_02.gif" width="326" height="332" alt=""></td>
		<td colspan="4">
			<img src="images_cos/T_03.gif" width="522" height="112" alt=""></td>
		<td>
			<img src="images_cos/spacer.gif" width="1" height="112" alt=""></td>
	</tr>
	<tr>
		<td colspan="2" rowspan="3">
			<img src="images_cos/T_04.gif" width="430" height="391" alt=""></td>
		<td colspan="2" rowspan="3">
			<img src="images_cos/T_05.gif" width="92" height="391" alt=""></td>
		<td>
			<img src="images_cos/spacer.gif" width="1" height="220" alt=""></td>
	</tr>
	<tr>
		<td colspan="2">
			<img src="images_cos/T_06.gif" width="478" height="96" alt=""></td>
		<td>
			<img src="images_cos/spacer.gif" width="1" height="96" alt=""></td>
	</tr>
	<tr>
		<td colspan="2" rowspan="3">
			<img src="images_cos/T_07.gif" width="478" height="144" alt=""></td>
		<td>
			<img src="images_cos/spacer.gif" width="1" height="75" alt=""></td>
	</tr>
	<tr>
		<td rowspan="4">
			<img src="images_cos/T_08.gif" width="245" height="101" alt=""></td>
		<td colspan="3">
			<img src="images_cos/T_09.gif" width="277" height="22" alt=""></td>
		<td>
			<img src="images_cos/spacer.gif" width="1" height="22" alt=""></td>
	</tr>
	<tr>
		<td colspan="2" rowspan="2"><a href='#' onclick='clickSignon()'>
			<img border='0' src="images_cos/T_10.gif" width="210" height="61" alt=""><a></td>
		<td rowspan="2">
			<img src="images_cos/T_11.gif" width="67" height="61" alt=""></td>
		<td>
			<img src="images_cos/spacer.gif" width="1" height="47" alt=""></td>
	</tr>
	<tr>
		<td colspan="2" rowspan="2">
			<img src="images_cos/T_12.gif" width="478" height="32" alt=""></td>
		<td>
			<img src="images_cos/spacer.gif" width="1" height="14" alt=""></td>
	</tr>
	<tr>
		<td colspan="3">
			<img src="images_cos/T_13.gif" width="277" height="18" alt=""></td>
		<td>
			<img src="images_cos/spacer.gif" width="1" height="18" alt=""></td>
	</tr>
	<tr>
		<td>
			<img src="images_cos/spacer.gif" width="152" height="1" alt=""></td>
		<td>
			<img src="images_cos/spacer.gif" width="326" height="1" alt=""></td>
		<td>
			<img src="images_cos/spacer.gif" width="245" height="1" alt=""></td>
		<td>
			<img src="images_cos/spacer.gif" width="185" height="1" alt=""></td>
		<td>
			<img src="images_cos/spacer.gif" width="25" height="1" alt=""></td>
		<td>
			<img src="images_cos/spacer.gif" width="67" height="1" alt=""></td>
		<td></td>
	</tr>
</table>
</div>
<!-- End Save for Web Slices -->
</body>
</html>
<script>

	function deleteAllCookies(){
		   var cookies = document.cookie.split(";");
		   //console.log(cookies);
		   for (var i = 0; i < cookies.length; i++){
		     //console.log(i);
		     deleteCookie(cookies[i].split("=")[0]);
		    }
	}

	function setCookie(name, value, expirydays) {
		 var d = new Date();
		 d.setTime(d.getTime() + (expirydays*24*60*60*1000));
		 var expires = "expires="+ d.toUTCString();
		 document.cookie = name + "=" + value + "; " + expires;
	}

	function deleteCookie(name){
		  setCookie(name,"",-0.01);
	}

	function clickSignon(){
		var url="https://cos.nrru.ac.th/php-azure/authen.php?workId=a2a8b0bc331ac58b265474307e87fbc61da977c1";
		//var url="http://localhost/NRRUBooking/TLogin.php";

		window.location.replace(url);
	}
	 deleteAllCookies();
</script>