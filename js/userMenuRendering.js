var full = location.pathname;
var res = full.split("/");
var rootPath="/"+res[1];

function clickMenu(link){
  $("#dvMain").load(link);
}

function getUserMenu(menuPane){
   var url=rootPath+"/tusermenu/getData.php";
   var data=queryData(url);
   var row="";
   var i=0;
   $.each(data, function (index, value) {
     row+="<li class=\"treeview\">\n";
     row+="<a href=\"#\" onclick='clickMenu(\""+value.link+"\")'>\n"
     row+="<i class=\""+value.icon+"\"></i><span>"+value.menuName+"</span>\n";
     row+="<span class=\"pull-right-container\">\n";
     row+="<i class=\"fa fa-angle-left pull-right\"></i>\n";
     row+="</span></a>\n";
     row+="</li>\n";
     i++;
   });

 

  $(menuPane).html(row);
}

/*
 row+="<li>\n";
  row+="<a href=\"#\" onclick='logout()'>\n"
  row+="<i class=\"fa fa-sign-out\"></i><span>ออกจากระบบ</span>\n";
  row+="<span class=\"pull-right-container\">\n";
  row+="</span></a>\n";
  row+="</li>\n";
*/