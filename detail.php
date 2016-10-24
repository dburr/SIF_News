<?php
require_once("./inc.header.php");
$url = $server.'/detail?' . $_SERVER['QUERY_STRING'];
$opts = array(
  'http'=>array(
    'method'=>"GET",
    'header'=>$header)
	);
$context = stream_context_create($opts);
$a = file_get_contents($url, false, $context);
$a = str_replace("/webview.php/announce/index?0=","../",$a);
$a = str_replace("/webview.php/announce/index?disp_faulty=","./?disp_faulty=",$a);
$a = str_replace("/webview.php/announce/index?disp_faulty=","./?disp_faulty=",$a);
$a = str_replace("/webview.php/announce/detail?announce_id=","./detail.php?announce_id=",$a);
$a = str_replace("native://browser?url=","",$a);
$a = str_replace("<p>","<div style='white-space: pre-wrap;'>",$a);
$a = str_replace("<br>","",$a);
$a = str_replace("id=\"wrapper\"","id=\"wrapper\" style=\"margin:0 auto;\"",$a);
$a = str_replacE("</p>","",$a);
print $a;
