<?php
require_once("./inc.header.php");
if (!isset($_GET['disp_faulty'])){ $_GET['disp_faulty'] = "0"; }

$url = $server["host"]. "?disp_faulty=".$_GET['disp_faulty'];
$html = str_get_html(getDataFromURL($url));

$addedInline = false;
$dp = $_GET['disp_faulty']||'0';
foreach($html->find('script') as &$script){
	if (DEBUG){
		if (strlen($script->src)>=1){
			print "<!-- Found Script: " . $script->src . " -->\n";
		}else{
			print "<!-- Found Inline Script -->\n";
			print "<!-- " . $script->innertext . " -->\n";
		}
	}
	if ($script->src == "//cf-static-prod.lovelive.ge.klabgames.net/resources/js/news/list.js"){
		$script->src = "./js/list.js";
		continue;
	}
	if ($script->src == "//cf-static-prod.lovelive.ge.klabgames.net/resources/js/button.js"){
		$script->src = "./js/jquery-3.1.1.min.js";
		continue;
	}
	if (strlen($script->src)==0 && !$addedInline){
		$script->innertext = "const DISP_FAULTY=" . (isset($_GET['disp_faulty'])?$_GET['disp_faulty']:"0") . ";";
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
	if ($link->href == "//cf-static-prod.lovelive.ge.klabgames.net/resources/css/news/list.css"){
		$link->href = "./css/list.css";
		continue;
	}
	if (DEBUG){
		print "<!-- Removed Link: " . $link->href . " -->\n";
	}
	$link->outertext = '';	
}

foreach($html->find('a') as &$link){
	if (DEBUG){
		print "<!-- Found 'A': " . $link->href . " -->\n";
	}
	if (substr($link->href,0,27) == "/webview.php/announce/index"){
		$link->href = str_replace("/webview.php/announce/index","./",$link->href);
	}	
}
print $html;