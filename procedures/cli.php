<?php

if (!isset($argv) || !is_array($argv)) {
	echo "This script can only be run from the commandline";
	exit();
}

$secret = "";
$interval = "";
$memory_limit = "64M";

foreach ($argv as $index => $arg) {
	if (($index > 0) && !empty($arg)) {
		
		list($key, $value) = explode("=", $arg);
		
		switch ($key) {
			case "host":
				$_SERVER["HTTP_HOST"] = $value;
				break;
			case "https":
				$_SERVER["HTTPS"] = $value;
				break;
			default:
				$$key = $value;
				break;
		}
	}
}

if (empty($secret) || empty($interval)) {
	echo "Wrong input to run this script, please provide an interval and secret.";
	exit();
}

ini_set("memory_limit", $memory_limit);

require_once(dirname(dirname(dirname(dirname(__FILE__)))) . "/engine/start.php");

if (!commandline_cron_validate_secret($secret)) {
	echo elgg_echo("commandline_cron:cli:error:secret");
	exit();
}

// make sure we have the correct context
elgg_set_context("cron");

// this would normaly be handled by the page_handler
$page = array($interval);

try {
	// trigger the cron
	_elgg_cron_page_handler($page);
} catch (Exception $e) {
	// something went wrong
	echo $e->getMessage();
}
