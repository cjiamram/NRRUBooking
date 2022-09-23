<!DOCTYPE html>
<html lang="en">
<?php 
	include_once "config/config.php";
	$cnf=new Config();
	$rootPath=$cnf->path;


?>
<head>
	<title>NRRU Booking</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="Login Template/image.png" href="images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="Login Template/vendor/bootstrap/css/bootstrap.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="Login Template/fonts/font-awesome-4.7.0/css/font-awesome.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="Login Template/fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="Login Template/vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="Login Template/vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="Login Template/vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="Login Template/vendor/select2/select2.min.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="Login Template/vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="Login Template/css/util.css">
	<link rel="stylesheet" type="text/css" href="Login Template/css/main.css">
<!--===============================================================================================-->

<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="Login Template/css/custom_css.css">



</head>
<body>

	
	 <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-5 col-md-6 col-xs-12 marpad_login">
                                <div class="card shadow-lg border-0 rounded-lg">
                                    <div class="card-body">
                                    	
                                    	<div class="row mb-3">
                                    		<div class="col-lg-3 col-xs-12 text-center">
                                    			<div class="row">
                                    				<div class="col-lg-12 col-xl-12 col-xs-12 ">
                                    					<img class="img-responsive logo_nrru" id="NRRULogo" src="images/Nrru.png" alt="" />
                                    				</div>
                                    				
                                    			</div>
                                    		</div>
                                    		<div class="col-lg-9  col-xs-12">
                                    			<div class="row text-center">
		                                    		<div class="col-lg-12 col-xl-12 col-xs-12 font_loginH mt-3">ระบบบริการจองห้องออนไลน์</div>
		                                    		<div class="col-lg-12 col-xl-12 col-xs-12 font_loginH2">NRRU Room Reservotion Sysytem</div>
		                                    		
                                    	</div>
                                    		</div>
                                    	</div>
                                    	<div class="row text-center">
                                    		<div class="col-lg-12 col-xs-12 font_loginB">ลงชื่อเข้าใช้ระบบ</div>
                                    		<div class="col-lg-12 col-xs-12 font_loginB2">ใช้รหัสเดียวกันกับเข้าระบบ MIS มหาวิทยาลัย</div>
                                    	</div>
                                    	
                                    </div>
                                    <div class="card-body">
                                       
										<div class="row mb-3 ">
										  <label for="colFormLabel" class="col-xs-2 col-lg-2 col-form-label icon_u"><i class="fa fa-user fa-2x txt_iconLogin" aria-hidden="true"> </i> </label>
										  <div class="col-xs-10 col-lg-10 css_inputBox">
										    <input type="text" id="txtUser" name="username" class="form-control" placeholder="username">
										  </div>
										</div>
										
										<div class="row mb-3 ">
										  <label for="colFormLabel" class="col-xs-2 col-lg-2 col-form-label icon_u"><i class="fa fa-unlock-alt fa-2x txt_iconLogin" aria-hidden="true"> </i> </label>
										  <div class="col-xs-10 col-lg-10 css_inputBox">
										    <input type="password" id="txtPassword" name="pass" class="form-control " placeholder="password">
										  </div>
										</div>
										<div class="row mb-3">
											<div class="col-lg-12 col-xs-12 ">
												<button id="btnLogin"class="btn btn-block btn_login_B">LOGIN</button>							
											</div>
										</div>
										
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
            
            
        </div>
	
	
	
<!--===============================================================================================-->
	<script src="Login Template/vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="Login Template/vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
	<script src="Login Template/vendor/bootstrap/js/popper.js"></script>
	<script src="Login Template/vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="Login Template/vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="Login Template/vendor/daterangepicker/moment.min.js"></script>
	<script src="Login Template/vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
	<script src="Login Template/vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
	<script src="Login Template/js/main.js"></script>
<script src="js/plugins/sweetalert/sweetalert2.all.min.js"></script>
<script src="bower_components/jquery/dist/jquery.min.js"></script>
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="plugins/iCheck/icheck.min.js"></script>

<script>

    function executeData(url,jsonObj){
    console.log(url);
    var result;
    var jsonData=JSON.stringify (jsonObj);
      $.ajax({
        //**************
          url: url,
          contentType: "application/json; charset=utf-8",
          type: "POST",
          dataType: "json",
          data:jsonData,
          async:false,
          success: function(data){
              result = data;
          } 
        //**************
      });
      return result;
  }

  function executeGet(url){
    var result;
    $.ajax({
      type:'GET',
      url:url,
      dataType:'json',
      async:false,
      success:function(data){
 
       result=data;
      }
    });
    return result;
  }


    function validLogin(){
      var url="<?=$rootPath?>/user/getUser.php";
      var jsonObj= {
        userName:$("#txtUser").val(),
        password:$("#txtPassword").val()        
      };
      var jsonData=JSON.stringify (jsonObj);
      var data=executeData(url,jsonObj);


     if(data.flag==true){
        $(location).attr('href','page.php');
      }
      else
      {
         
            
            url="<?=$rootPath?>/api/nrruCredential.php";
            data=executeData(url,jsonObj);
            if(data.message===true){
                //$(location).attr('href','userIndex.php');
                var url="<?=$rootPath?>/menu/setMenuDefault.php?userCode="+$("#txtUser").val();
                console.log(url);
                var flag=executeGet(url);
                $(location).attr('href','page.php');
            }else{

            		swal.fire({
                            title: "รหัสผ่านไม่ถูกต้อง",
                            type: "error",
                            buttons: [false, "ปิด"],
                            dangerMode: true,
                        });
            }
      }
    }

    $("#btnLogin").click(function(){
      validLogin();
    });
 
</script>
</body>
</html>