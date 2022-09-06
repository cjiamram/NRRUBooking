<!DOCTYPE html>
	<?php
  		include_once "../config/config.php";
  		$cDate=date("Y-m-d");
  		$sDate=isset($_GET["sDate"])?$_GET["sDate"]:$cDate;
  		$fDate=isset($_GET["fDate"])?$_GET["fDate"]:$cDate;
  		$cnf=new Config();
  		$rootPath=$cnf->path;

  	?>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Basic Column - Grouped</title>

    <link href="<?=$rootPath?>/assets/styles.css" rel="stylesheet" />

    <style>
      
        #colChart {
      max-width: 900px;
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
  

    <div id="colChart"></div>

    <script>

    	var dataUsage=[];
    	var dataFree=[];
        var labels=[];

        function setArray(item) {
        	dataUsage.push(item.usage);
        	dataFree.push(item.free);
        	labels.push(item.currDate);
        }

        var url="<?=$rootPath?>/dashBoard/getLicenseUsageByDate.php?sDate=<?=$sDate?>&fDate=<?=$fDate?>";
        
        data=queryData(url);
        //console.log(data);
        if(data!=""){
          data.forEach(setArray);
        }

        //console.log(dataUsage);
        
		

      
        var options = {
          series: [{
          name: 'License ที่ถูกใช้งาน',
          data: dataUsage
        }, {
          name: 'License ที่ไม่ถูกใช้งาน',
          data: dataFree
        }
        ],
          chart: {
          type: 'bar',
          height: 350
        },
        plotOptions: {
          bar: {
            horizontal: false,
            columnWidth: '55%',
            endingShape: 'rounded'
          },
        },
        dataLabels: {
          enabled: false
        },
        stroke: {
          show: true,
          width: 2,
          colors: ['transparent']
        },
        xaxis: {
          categories: labels,
        },
        yaxis: {
          title: {
            text: 'จำนวนครั้ง'
          }
        },
        fill: {
          opacity: 1
        },
        tooltip: {
          y: {
            formatter: function (val) {
              return  val 
            }
          }
        }
        };

        var chart = new ApexCharts(document.querySelector("#colChart"), options);
        chart.render();
      
      
    </script>

    
  </body>
</html>
