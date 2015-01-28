<?php

require_once(dirname(__FILE__) . "/lib/functions.php");
require_once(dirname(__FILE__) . "/lib/hooks.php");

// register for default Elgg events
elgg_register_event_handler("init", "system", "commandline_cron_init");

/**
 * Called during system init
 *
 * @return void
 */
function commandline_cron_init() {
	// register plugin hooks
	elgg_register_plugin_hook_handler("route", "cron", "commandline_cron_route_cron_handler");
}
