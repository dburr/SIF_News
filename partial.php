<?php
if (!isset($_GET['disp_faulty']) || !isset($_GET['offset'])) { print "Invalid Request<br/>"; exit; }
$args = array(
	"disp_faulty"=>intval($_GET['disp_faulty']),
	"offset"=>intval($_GET['offset'])
);
require_once("./inc.header.php");
$url = $server . "/partial?" . http_build_query($args);
$opts = array(
  'http'=>array(
    'method'=>"GET",
	'header'=> $header
  )
);
$context = stream_context_create($opts);
$a = file_get_contents($url, false, $context);
$a  = str_replace("/webview.php/announce/detail?","./detail.php?",$a);
$a = str_replace("/webview.php/announce/index?disp_faulty=","./?disp_faulty=",$a);
print $a;
