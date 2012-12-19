<?php

	require_once(dirname(__FILE__) . "/lib/functions.php");
	require_once(dirname(__FILE__) . "/lib/hooks.php");
	
	elgg_register_event_handler("init", "system", "commandline_cron_init");
	
	function commandline_cron_init(){
		// register plugin hooks
		elgg_register_plugin_hook_handler("route", "cron", "commandline_cron_route_cron_handler");
	}