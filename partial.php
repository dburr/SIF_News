<?php
if (!isset($_GET['disp_faulty']) || !isset($_GET['offset'])) { exit; }
$args = array(
	"disp_faulty"=>intval($_GET['disp_faulty']),
	"offset"=>intval($_GET['offset'])
);
require_once("./inc.header.php");
$url = $server["host"] . "/partial?" . http_build_query($args);
print getDataFromURL($url);