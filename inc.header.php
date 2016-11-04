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
