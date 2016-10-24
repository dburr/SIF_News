<?php

if (!file_exists("./config.php")){
	print "No Config";
	exit;
}

require_once("./config.php");

$server = "http://prod-jp.lovelive.ge.klabgames.net/webview.php/announce";

$header = implode("\r\n",[
	"user-id: $user_id",
	"authorize: consumerKey=lovelive_test&token=$token&version=1.1&timeStamp=". time(). "&nonce=WV0",
	"application-id: 626776655",
	"bundle-version: 4.0.3",
	"client-version: 19.6"
]);
