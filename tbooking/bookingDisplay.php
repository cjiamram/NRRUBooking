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
<link href='<?=$rootPath?>/js/lib/main.css' rel='stylesheet' />

<script src="<?=$rootPath?>/bower_components/jquery/dist/jquery.min.js"></script>
<script src="<?=$rootPath?>/bower_components/bootstrap/dist/js/bootstrap.js"></script>
<script src='<?=$rootPath?>/js/lib/main.js'></script>
<script src='<?=$rootPath?>/js/lib/locales-all.js'></script>
<script>
  var calendar;
  function getEvent(){
     var bookingRoom ='<?=$bookingRoom?>';
     var url="<?=$rootPath ?>/tbooking/getBookingDateEvent.php?bookingRoom="+bookingRoom+"&bDate=<?=$bDate?>";
     var data=queryData(url);
     return data;
  }
 /*
 customButtons: {
            prev: {
            text: 'ก่อนหน้า',
            click: function() {
              // so something before
              //toastr.warning("PREV button is going to be executed")
              // do the original command
              //calendar.prev();
              // do something after
              //toastr.warning("PREV button executed")
              //alert(date);
            }
          },
      }

      */



  function renderCalendar(currentdate){
    var initialLocaleCode = 'th';
    var calendarEl = document.getElementById('calendar');
    calendar = new FullCalendar.Calendar(calendarEl, {

       eventClick: function(info) {
        var eventObj = info.event;

        if (eventObj.url) {
          alert(
            'Clicked ' + eventObj.title + '.\n' +
            'Will open ' + eventObj.url + ' in a new tab'
          );

          window.open(eventObj.url);

          info.jsEvent.preventDefault(); // prevents browser from following link in current tab.
        } else {

          swal.fire({
              title: "ปฏิทินการจองห้อง",
              text:eventObj.title,
              type: "success",
              buttons: [false, "ปิด"],
              dangerMode: true,
            });
        }
      },

      headerToolbar: {
        left: 'prev,next today',
        center: 'title',
        right: 'timeGridDay,timeGridWeek,dayGridMonth,listMonth'
      },
      initialView: 'timeGridDay',
      initialDate: currentdate,
      locale: 'th',
      buttonIcons: false, // show the prev/next text
      weekNumbers: true,
      navLinks: true, // can click day/week names to navigate views
      editable: true,
      dayMaxEvents: true, // allow "more" link when too many events
      events:getEvent(),
    });

    //calenda.prev();

    calendar.render();

  }

  function initialInput(){
      if($("#link_RoomNo").val()!=""){

      }
  }
  $( document ).ready(function() {
          renderCalendar("<?=$bDate?>");

           $('.fc-prev-button').click(function () {
                        var action = "prevMonth";
                        var cdate = calendar.getDate();
                         var dt= getDate(cdate)
                         $("#obj_bDate").val(dt);

            });

            $('.fc-next-button').click(function () {
                        var action = "prevMonth";
                        var cdate = calendar.getDate();
                        var dt= getDate(cdate)
                         $("#obj_bDate").val(dt);

            });

            $('.fc-today-button').click(function () {
                        var action = "prevMonth";
                        var cdate = calendar.getDate();
                         var dt= getDate(cdate)
                         $("#obj_bDate").val(dt);
            });
    });


</script>
<style>


</style>
</head>
<body>

 



</body>
</html>
