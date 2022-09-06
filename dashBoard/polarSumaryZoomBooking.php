<!DOCTYPE html>
<?php
  include_once "../config/config.php";
  $cnf=new Config();
  $rootPath=$cnf->path;

?>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Simple PolarArea</title>

    <style>
      
      #polarChart {
      max-width: 500px;
      margin: 35px auto;
      padding: 0;
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



   <div id="polarChart" class="chart"></div>

    <script>
       
       var dataSumary=[];
        var dataLabels=[];
        var colors=[];

        function setArray(item) {
          dataSumary.push(item.THr);
          dataLabels.push(item.licenseType);
        }

        var url="<?=$rootPath?>/tzoombooking/sumaryZoomBooking.php";
        data=queryData(url);
        data.forEach(setArray);
        
        

        var options = {
          series: dataSumary,
          chart: {
          type: 'polarArea',
        },
        labels:dataLabels,
        stroke: {
          colors: ['#fff']
        },
        fill: {
          opacity: 0.8
        },
        responsive: [{
          breakpoint: 480,
          options: {
            chart: {
              width: 500
            },
            legend: {
              position: 'bottom'
            }
          }
        }]
        };

        var chart = new ApexCharts(document.querySelector("#polarChart"), options);
        chart.render();
      
      
    </script>

    
  </body>
</html>
