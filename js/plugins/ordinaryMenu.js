var full = location.pathname;
var res = full.split("/");
var projectPath="/"+res[1];

function clickMenu(link){
    $("#dvMain").css({"display":"block"});
    $("#dvMain1").css({"display":"none"});

    $("#dvMain").load(link);
}

function getHeadMenu(menuPane){
   var url="./tordinarymenu/getData.php";
   var data=queryData(url);
   var row="";
   var i=0;
   $.each(data, function (index, value) {
	     row+="<li class=\"treeview active\">\n";
		     row+="<a href=\"#\" onclick='clickMenu(\""+value.menuLink+"\")'>\n"
			     row+="<i class=\""+value.menuIcon+"\"></i><span>"+value.menuName+"</span>\n";
			     row+="<span class=\"pull-right-container\"></span>\n";
		     row+="</a>\n";
	     row+="</li>\n";
     i++;
   });
   $(menuPane).html(row);
}
