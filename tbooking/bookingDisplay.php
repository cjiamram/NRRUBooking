<!DOCTYPE html>
<?php
  include_once '../lib/classAPI.php';
  include_once '../config/config.php';
  include_once "../objects/manage.php";
  $cnf=new Config();
  $api=new ClassAPI();
  $rootPath=$cnf->path;
  $bDate=isset($_GET["bDate"])?Format::getSystemDate($_GET["bDate"]):date("Y-m-d");
  $bookingRoom=isset($_GET["bookingRoom"])?$_GET["bookingRoom"]:"27.01.01";
?>

<html>
<head>
<meta charset='utf-8' />
<div id="dvEvent" style="display: none">
 
</div>
<script src="<?=$rootPath?>/bower_components/jquery/dist/jquery.min.js"></script>
<script src="<?=$rootPath?>/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<link href='<?=$rootPath?>/js/lib/main.css' rel='stylesheet' />
<script src='<?=$rootPath?>/js/lib/main.js'></script>
<script src='<?=$rootPath?>/js/lib/locales-all.js'></script>
<script>

  function getEvent(){
     var bookingRoom ='<?=$bookingRoom?>';
     //var url="<?=$rootPath ?>/tbooking/getBookingEvent.php?bookingRoom="+bookingRoom;
     var url="<?=$rootPath ?>/tbooking/getBookingDateEvent.php?bookingRoom="+bookingRoom+"&bDate=<?=$bDate?>";
     //console.log(url);
     var data=queryData(url);
     return data;
  }
 

  function renderCalendar(currentdate){

    var initialLocaleCode = 'th';
    var calendarEl = document.getElementById('calendar');
    var calendar = new FullCalendar.Calendar(calendarEl, {
      headerToolbar: {
        left: 'prev,next today',
        center: 'title',
        right: 'timeGridWeek,timeGridDay,dayGridMonth,listMonth'
      },
      initialView: 'timeGridWeek',
      initialDate: currentdate,
      locale: 'th',
      buttonIcons: false, // show the prev/next text
      weekNumbers: true,
      navLinks: true, // can click day/week names to navigate views
      editable: true,
      dayMaxEvents: true, // allow "more" link when too many events
      events:getEvent()

    });

    calendar.render();

  }

  function initialInput(){
      if($("#link_RoomNo").val()!=""){

      }
  }
  $( document ).ready(function() {
      renderCalendar("<?=date('Y-m-d')?>");
  });


</script>
<style>


</style>
</head>
<body>

 



</body>
</html>
