<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NRRU E-portfolio</title>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <link href="eportfolio_t/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">

</head>

<body style="background:url(https://static.pexels.com/photos/33972/pexels-photo.jpg);background: -webkit-linear-gradient(to bottom, #FFB88C, #DE6262);width:100%;height: auto;padding : 150px 0;">
<?php
    session_start();
?>
<div class="container">
    <div class="row">
        <div class="col-md-4 login-sec">
            <h2 class="text-center"><img src="eportfolio_t/imgs/eport-banner.png"></h2>
            <div class="form-group">
                <label for="txtuser" class="text-uppercase">ชื่อผู้ใช้งาน</label>
                <input type="text" class="form-control" placeholder="ชื่อผู้ใช้งาน" name="email" id="txtuser" autofocus>

            </div>
            <div class="form-group">
                <label for="txtpass" class="text-uppercase">รหัสผ่าน</label>
                <input type="password" class="form-control" placeholder="รหัสผ่าน" name="password" id="txtpass">
            </div>


            <div class="form-check">
				<a hres="#"><button type="button" class="btn btn-primary float-left" id="btnEvaluateLogin">ระบบผู้ประเมิน</button></a>
                <button type="submit" class="btn btn-success float-right" id="butlogin">ล็อกอินเข้าสู่ระบบ</button>
            </div><br><br>
            <div class="form-check">
				<a href="http://eportfolio.nrru.ac.th/edocnew/index.php"><button type="button" class="btn btn-info  float-left">ระบบเอกสาร</button></a>
            </div>

            <!--<div class="copy-text">Created with by <a href="#">สำนักคอมพิวเตอร์ มหาวิทยาลัยราชภัฏนครราชสีมา</a>
            </div> -->
        </div>
        <div class="col-md-8 banner-sec">
            <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators">
                    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                </ol>
                <div class="carousel-inner" role="listbox">
                    <div class="carousel-item active">
                        <img class="d-block img-fluid" src="eportfolio_t/imgs/pexels-photo.jpg" alt="First slide">
                        <div class="carousel-caption d-none d-md-block">
                            <div class="banner-text">
                                <h2 style="color:black;">E-Portfolio</h2>
                                <p style="color:black;">E-Portfolio เป็นระบบที่ช่วยในการสร้างและเผยแพร่แฟ้มผลงานของตนเอง ในรูปแบบของระบบออนไลน์ผ่านทางอินเทอร์เน็ต โดย E-Portfolio จะลดการใช้ทรัพยากรสำนักงาน เช่น กระดาษ หมึกพิมพ์ สะดวกต่อการบริหารจัดการ
                                    เข้าถึงผลงานได้สะดวก เก็บสะสมผลงานได้หลายรูปแบบ</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- jQuery 3 -->
<script src="eportfolio_t/bower_components/jquery/dist/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="eportfolio_t/bower_components/jquery-ui/jquery-ui.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/promise-polyfill@8/dist/polyfill.js"></script>
<script src="eportfolio/js/plugins/sweetalert/sweetalert2.all.min.js"></script>
<script>
    $(document).ready(function () {

        $("#btnEvaluateLogin").click(function(){
            const Toast = Swal.mixin({
                position: 'center',
                width:'50%',
                showConfirmButton: false
            });
            Toast.fire("กรุณารอสักครู่...");
            $.post("./eportfolio_t/pages/service/nrruWebServiceClient_userLogin.php", {
                    username: $("#txtuser").val(),
                    password: $("#txtpass").val()
                },
                function (data, status) {
                    var valData = data;
                    var valNew = valData.split('|');
                    if (valNew[0] != 0) {
                        if (valNew[1] == 2) {
                            Toast.fire({
                                title:"เข้าสู่ระบบสำเร็จ",
                                type:'success',
                                timer:2000
                            }).then(function () {
                                $.redirectPost('./S-Eportfolio/authentication.php', {
                                    'staffid': valNew[0],
                                    'username': $("#txtuser").val(),
                                    'password': $("#txtpass").val()
                                });
                            });

                        } else {
                            Toast.fire({
                                title:"เข้าสู่ระบบสำเร็จ",
                                type:'success',
                                timer:2000
                            }).then(function () {
                                $.redirectPost('./S-Eportfolio/authentication.php', {
                                    'staffid': valNew[0]
                                });
                            });
                        }
                    } else {
                        Toast.fire({
                            title:"เข้าสู่ระบบผิดพลาด",
                            text:'กรุณาตรวจสอบ ชื่อผู้ใช้งานและรหัสผ่านอีกครั้ง ',
                            type:'error',
                            showConfirmButton: true
                        })
                    }
                });
        });

        $("#butlogin").click(function () {
            const Toast = Swal.mixin({
                position: 'center',
                width:'50%',
                showConfirmButton: false
            });
            Toast.fire("กรุณารอสักครู่...");

            $.post("./eportfolio_t/pages/service/nrruWebServiceClient_userLogin.php", {
                    username: $("#txtuser").val(),
                    password: $("#txtpass").val()
                },
                function (data, status) {
                    var valData = data;
                    var valNew = valData.split('|');
                    if (valNew[0] != 0) {
                        if (valNew[1] == 2) {
                            Toast.fire({
                                title:"เข้าสู่ระบบสำเร็จ",
                                type:'success',
                                timer:2000
                            }).then(function () {
                                /*$.redirectPost('./A-Eportfolio/page-authentication.php', {
                                    'staffid': valNew[0],
                                    'username': $("#txtuser").val(),
                                    'password': $("#txtpass").val()
                                });*/
                            $.redirectPost('./eportnew/index.php', {
                                    'staffid': valNew[0],
                                    'username': $("#txtuser").val(),
                                    'password': $("#txtpass").val()
                                });

                            });

                        } else {
                            Toast.fire({
                                title:"เข้าสู่ระบบสำเร็จ",
                                type:'success',
                                timer:2000
                            }).then(function () {
                                $.redirectPost('./S-Eportfolio/authentication.php', {
                                    'staffid': valNew[0]
                                });
                            });
                        }
                    } else {
                        Toast.fire({
                            title:"เข้าสู่ระบบผิดพลาด",
                            text:'กรุณาตรวจสอบ ชื่อผู้ใช้งานและรหัสผ่านอีกครั้ง ',
                            type:'error',
                            showConfirmButton: true
                        })
                    }
                });
        });
        $.extend({
            redirectPost: function (location, args) {
                var form = '';
                $.each(args, function (key, value) {
                    form += '<input type="hidden" name="' + key + '" value="' + value + '">';
                });
                $('<form action="' + location + '" method="POST">' + form + '</form>').appendTo('body').submit();
            }
        });
    });
</script>

</body>

</html>