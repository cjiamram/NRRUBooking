<?php
$date1=date_create("2022-03-15");
$date2=date_create("2022-12-12");
$diff=date_diff($date1,$date2);
$d=$diff->format("%a");
//print_r(intval($d));
//print_r($date1->format('Y-m-d'));

$cdate=$date1->format('Y-m-d');
//print_r($cdate);
//$cdate=$date1;
$timestamp = strtotime($cdate);
$day = date('D', $timestamp);

print_r($day);
$cdate=date_create($cdate);
date_add($cdate,date_interval_create_from_date_string("1 days"));
print_r($cdate);
?>