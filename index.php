<?php
require_once("./inc.header.php");
$url = $server. "?" . $_SERVER['QUERY_STRING'];
$opts = array(
  'http'=>array(
    'method'=>"GET",
    'header'=>$header)
);
$context = stream_context_create($opts);
$a = file_get_contents($url, false, $context);
$a  = str_replace("/webview.php/announce/detail?","./detail.php?",$a);
$a = str_replace("/webview.php/announce/index?disp_faulty=","./?disp_faulty=",$a);
$a = str_replace("</head>","<style>#tabs >.fs30{width:320px !important;}body{margin:0 auto;}.title_news_all_tab img{display:none;}#load-next{display:none}.goog-te-combo{height:32px;width:100%;}.google-te-combo option{font-size:1.2em;}#google_translate select{text-align-last:center;margin-left:5%;margin-right:5%;width:90%;}</style></head>",$a);
$a = str_replace("/webview.php/announce/partial","./partial.php",$a);
$a = str_replace("offset=' + offset;","offset=' + offset; console.log(url);",$a);
$a = str_replace("id=\"load-next\"","id=\"load-next\" style='display: block;'",$a);
print $a;
