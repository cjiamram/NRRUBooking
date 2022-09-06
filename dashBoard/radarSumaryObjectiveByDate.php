<!DOCTYPE html>
<?php
  include_once "../config/config.php";
  $cnf=new Config();
  $rootPath=$cnf->path;
  $cDate=date("Y-m-d");
  $sDate=isset($_GET["sDate"])?$_GET["sDate"]:$cDate;
  $fDate=isset($_GET["fDate"])?$_GET["fDate"]:$cDate;


?>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Sumary Objective By Date</title>
    <link href="<?=$path ?>/assets/styles.css" rel="stylesheet" />
    
    <style>
      
        #radarChart {
      max-width: 550px;
      /*margin: 35px auto;*/
    }
      
    </style>

   


    <script>


      window.Promise ||
        document.write(
          '<script src="https://cdn.jsdelivr.net/npm/promise-polyfill@8/dist/polyfill.min.js"><\/script>'
        )
      window.Promise ||
        document.write(
          '<script src="https://cdn.jsdelivr.net/npm/eligrey-classlist-js-polyfill@1.2.20171210/classList.min.js"><\/script>'
        )
      window.Promise ||
        document.write(
          '<script src="https://cdn.jsdelivr.net/npm/findindex_polyfill_mdn"><\/script>'
        )

      // Replace Math.random() with a pseudo-random number generator to get reproducible results in e2e tests
      // Based on https://gist.github.com/blixt/f17b47c62508be59987b
      var _seed = 42;
      Math.random = function() {
        _seed = _seed * 16807 % 2147483647;
        return (_seed - 1) / 2147483646;
      };
    </script>

    
  </head>

  <body>
     
     <div id="radarChart" class="box"></div>

      <script>


        var dataSumary=[];
        var dataLabels=[];

        function setArray(item) {
          dataSumary.push(item.THr);
          dataLabels.push(item.objective);
        }

        var url="<?=$rootPath?>/dashBoard/sumaryObjectiveByDate.php?sDate=<?=$sDate?>&fDate=<?=$fDate?>";
        //console.log(url);
        if(data!=""){
          data=queryData(url);
          data.forEach(setArray);
        }



        var options = {
          series: [{
          name: 'วัตถุประสงค์',
          data: dataSumary
        }

        ],
          chart: {
          height: 500,
          width :500,
          type: 'radar',
          dropShadow: {
            enabled: true,
            blur: 1,
            left: 1,
            top: 1
          }
        },
        title: {
          text: 'ผลรวมของการจอง Zoom Meeting แยกตามวัตถุประสงค์'
        },

         stroke: {
          width: 2
        },
        fill: {
          opacity: 0.1
        },
        markers: {
          size: 0
        },
        xaxis: {
          categories: dataLabels
        }
        };

    $(document).ready(function(){
        var chart = new ApexCharts(document.querySelector("#radarChart"), options);
        chart.render();
    });
       
    </script>

    
  </body>
</html>
