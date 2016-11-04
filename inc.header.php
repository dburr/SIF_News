<?php

if (!file_exists("./config.php")){
	print "No Config";
	exit;
}

require_once("./config.php");
require_once("./lib/simple_html_dom.php");

$servers = [
	"jp"=>[
		"appId"=>"626776655",
		"bundleVersion"=>"4.1.0",
		"clientVersion"=>"20.1",
		"host"=>"http://prod-jp.lovelive.ge.klabgames.net/webview.php/announce"
	]
];

if (!isset($servers[SERVER])){
	print "Invalid Server ID";
	exit;
}
$server = $servers[SERVER];

$header = implode("\r\n",[
	"user-id: " . USER_ID,
	"authorize: consumerKey=lovelive_test&token=". TOKEN ."&version=1.1&timeStamp=". time(). "&nonce=WV0",
	"application-id: $server[appId]",
	"bundle-version: $server[bundleVersion]",
	"client-version: $server[clientVersion]"
]);

if (CACHE && !file_exists("./cache")){
	mkdir(CACHE_DIR);
}

function cleanCache(){
	foreach(scandir(CACHE_DIR) as $file){
		if (!is_dir($file)){
			if (filemtime(CACHE_DIR . "/" . $file) < (time()-CACHE_MAX_AGE)){
				unlink(CACHE_DIR . "/" . $file);
			}
		}
	}	
}

function getDataFromURL($url){
	global $header;
	$cacheFile = CACHE_DIR . "/" . sha1(CACHE_DIR . $url) . ".cache";
	if (file_exists($cacheFile)){
		$a = gzdecode(file_get_contents($cacheFile));
		if (filemtime($cacheFile) > (time()-CACHE_MAX_AGE)){
			return $a;
		}
	}
	$opts = array(
	  'http'=>array(
		'method'=>"GET",
		'header'=>$header)
	);
	$context = stream_context_create($opts);
	$a = file_get_contents($url, false, $context);
	//Strip ID Information from cache
	$a = str_replace(TOKEN,"x",$a);
	$a = str_replace(USER_ID,"0",$a);
	
	file_put_contents($cacheFile,gzencode($a));
	
	return $a;
}

if (rand(1,max(5,ceil(CACHE_MAX_AGE/10))) == 3){
	cleanCache();
}
