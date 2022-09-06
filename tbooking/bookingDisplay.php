<!DOCTYPE html>
<?php
  include_once '../lib/classAPI.php';
  include_once '../config/config.php';
  $cnf=new Config();
  $api=new ClassAPI();
  $rootPath=$cnf->path;
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
     var bookingRoom ='<?php
        $bookingRoom=isset($_GET["bookingRoom"])?$_GET["bookingRoom"]:"27.01.01";
        echo $bookingRoom;
     ?>';

     var url="<?=$rootPath ?>/tbooking/getBookingEvent.php?bookingRoom="+bookingRoom;
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
        //$('#modal-reserve').modal('toggle');
        //var url="<?=$rootPath?>/tbooking/input.php";
        //$("#dvModalContain").load(url);
      }
}

 var currentdate = new Date();
      currentdate=getSystemDate(currentdate);
      renderCalendar(currentdate);

/*$( document ).ready(function() {
      var currentdate = new Date();
      currentdate=getSystemDate(currentdate);
      renderCalendar(currentdate);
      //initialInput();
});*/

</script>
<style>


</style>
</head>
<body>

 

  <!--<div id='calendar' style="width:100%"></div>-->

</body>
</html>
