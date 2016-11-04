<?php
require_once("./inc.header.php");
$url = $server["host"].'/detail?' . $_SERVER['QUERY_STRING'];
$opts = array(
  'http'=>array(
    'method'=>"GET",
    'header'=>$header)
	);
$context = stream_context_create($opts);
$a = file_get_contents($url, false, $context);
if (strlen($a) == 0){ exit; }
$html = str_get_html($a);
foreach($html->find('script') as &$script){
	if (DEBUG){
		if (strlen($script->src)>=1){
			print "<!-- Found Script: " . $script->src . " -->\n";
		}else{
			print "<!-- Found Inline Script -->\n";
			print "<!-- " . $script->innertext . " -->\n";
		}
	}
	if ($script->src == "//cf-static-prod.lovelive.ge.klabgames.net/resources/js/button.js"){
		$script->src = "./js/jquery-3.1.1.min.js";
		continue;
	}
	if (DEBUG){
		if (strlen($script->src)>=1){
			print "<!-- Removed Script: " . $script->src . " -->\n";
		}else{
			print "<!-- Removed Inline Script -->\n";
		}
	}
	$script->outertext = '';
}

foreach($html->find('link') as &$link){
	if (DEBUG){
		print "<!-- Found Link: " . $link->href . " -->\n";
	}
	if ($link->href == "//cf-static-prod.lovelive.ge.klabgames.net/resources/css/news/detail.css"){
		$link->href = "./css/detail.css";
		continue;
	}
	if (DEBUG){
		print "<!-- Removed Link: " . $link->href . " -->\n";
	}
	$link->outertext = '';	
}
$html->find("head",0)->innertext .= '<script src="./js/detail.js"></script><script>const DISP_FAULTY=' . $_GET['disp_faulty'] . ";</script>";
print $html;