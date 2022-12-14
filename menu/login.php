<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>ENDU WMS| EWMS</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="plugins/iCheck/square/blue.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition login-page">
<div class="login-box">
 <div class="login-logo">
  <!---->
  
  <div class="col-sm-2">
    <img src="img/logo.png">
  </div>
  <div class="col-sm-10">
    <a href="#"><b>NRRU</b> Booking Room</a>
  </div>

</div>
 <div class="login-box-body">
    <p class="login-box-msg">Sign in to start your session</p>

    
      <div class="form-group has-feedback">
        <input type="text" id="txtUser" class="form-control" >
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" id="txtPassword" class="form-control" >
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-xs-8">
          
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="button" id="btnLogin" class="btn btn-primary btn-block btn-flat">Sign In</button>
        </div>
        <!-- /.col -->
      </div>
  </div>
</div>
</body>
</html>

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
      var url="/NRRUBooking/user/getUser.php";
      var jsonObj= {
        userName:$("#txtUser").val(),
        password:$("#txtPassword").val()        
      };
      var jsonData=JSON.stringify (jsonObj);
      console.log(jsonData);
      var data=executeData(url,jsonObj);
      console.log(data);


      if(data.flag==true){
        $(location).attr('href','index.php');
      }
      else
      {
         
            
            url="/NRRUBooking/api/nrruCredential.php";
            data=executeData(url,jsonObj);
            if(data.message===true){
                url="/NRRUBooking/menu/setMenuDefault.php?UserCode="+$("#txtUser").val();
                flag=executeGet(url);
                $(location).attr('href','index.php');
            }
      }
    }

    $("#btnLogin").click(function(){
      validLogin();
    });
 
</script>
