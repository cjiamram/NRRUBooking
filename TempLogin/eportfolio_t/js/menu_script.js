// JavaScript Document
setTimeout(function(){
	profiles();
},200);
function profiles(){
	$("#div_main").load('../pages/profiles.php?staffid=' + $("#staffid").val());
}
function research(){
	$("#div_main").load('../pages/research2.php?staffid=' + $("#staffid").val());
}
function present(){
	$("#div_main").load('../pages/present.php?staffid=' + $("#staffid").val());
}
function journal(){
	$("#div_main").load('../pages/journal.php?staffid=' + $("#staffid").val());
}
function books(){
	$("#div_main").load('../pages/book.php?staffid=' + $("#staffid").val());
}
function elearning(){
	$("#div_main").load('../pages/elearning.php?staffid=' + $("#staffid").val());
}
function lecturer(){
	$("#div_main").load('../pages/lecturer.php?staffid=' + $("#staffid").val());
}
function thesis(){
	$("#div_main").load('../pages/thesis.php?staffid=' + $("#staffid").val());
}
function reading(){
	$("#div_main").load('../pages/reading.php?staffid=' + $("#staffid").val());
}
function cycle_port(){
	$("#div_main").load('../pages/cycle_port.php?staffid=' + $("#staffid").val());
}
function around(id){
	//alert(id);
	$("#div_main").load('../pages/management_port.php?staffid=' + $("#staffid").val() + '&cyc_id=' + id);
}
function teaching(id){
	//alert(id);
	$("#div_main").load('../pages/teaching.php?staffid=' + $("#staffid").val() + '&cyc_id=' + id);
}
function academic(id){
	//alert(id);
	$("#div_main").load('../pages/academic.php?staffid=' + $("#staffid").val() + '&cyc_id=' + id);
}
function researching(id){
	//alert(id);
	$("#div_main").load('../pages/researching.php?staffid=' + $("#staffid").val() + '&cyc_id=' + id);
}
function research_others(id){
	//alert(id);
	$("#div_main").load('../pages/research_others.php?staffid=' + $("#staffid").val() + '&cyc_id=' + id);
}
function academic_art(id){
	//alert(id);
	$("#div_main").load('../pages/academic_art.php?staffid=' + $("#staffid").val() + '&cyc_id=' + id);
}
function management(id){
	//alert(id);
	$("#div_main").load('../pages/management.php?staffid=' + $("#staffid").val() + '&cyc_id=' + id);
}
function other_job(id){
	//alert(id);
	$("#div_main").load('../pages/other_job.php?staffid=' + $("#staffid").val() + '&cyc_id=' + id);
}
function reportAll(id){
	//alert(id);
	$("#div_main").load('../pages/reportAll.php?staffid=' + $("#staffid").val() + '&cyc_id=' + id);
}
function tc_experience(){
	//alert(id);
	$("#div_main").load('../pages/tc_experience.php?staffid=' + $("#staffid").val());
}