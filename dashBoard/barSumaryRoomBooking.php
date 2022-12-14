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
    <title>Bar Sumary Room Booking</title>

    <link href="<?=$rootPath?>/assets/styles.css" rel="stylesheet" />

    <style>
      
        #barChart {
      max-width: 650px;
      margin: 35px auto;
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
    </script>

    
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    

    <script>
      var _seed = 42;
      Math.random = function() {
        _seed = _seed * 16807 % 2147483647;
        return (_seed - 1) / 2147483646;
      };
    </script>

    
  </head>

  <body>
  <div id="barChart"></div>

    <script>

        var dataSumary=[];
        var dataLabels=[];
        var colors=[];

        function setArray(item) {
          dataSumary.push(item.THr);
          dataLabels.push(item.bookingRoom);
          colors.push(item.color);
        }

        var url="<?=$rootPath?>/tbooking/sumaryRoomBooking.php";
        data=queryData(url);
        data.forEach(setArray);
      
        var options = {
          series: [{
          data: dataSumary
        }],
          chart: {
          type: 'bar',
          height: 380
        },
        plotOptions: {
          bar: {
            barHeight: '100%',
            distributed: true,
            horizontal: true,
            dataLabels: {
              position: 'bottom'
            },
          }
        },
        colors: colors,
        dataLabels: {
          enabled: true,
          textAnchor: 'start',
          style: {
            colors: ['#fff']
          },
          formatter: function (val, opt) {
            return opt.w.globals.labels[opt.dataPointIndex] + ":  " + val
          },
          offsetX: 0,
          dropShadow: {
            enabled: true
          }
        },
        stroke: {
          width: 1,
          colors: ['#fff']
        },
        xaxis: {
          categories: dataLabels,
        },
        yaxis: {
          labels: {
            show: false
          }
        },
        title: {
            text: '????????????????????????????????????????????????????????????????????????????????????',
            align: 'center',
            floating: true
        },
        subtitle: {
            text: '',
            align: 'center',
        },
        tooltip: {
          theme: 'dark',
          x: {
            show: false
          },
          y: {
            title: {
              formatter: function () {
                return ''
              }
            }
          }
        }
        };

        var barChart = new ApexCharts(document.querySelector("#barChart"), options);
        barChart.render();
      
      
    </script>

    
  </body>
</html>
