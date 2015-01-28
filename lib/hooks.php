<?php
/**
 * All plugin hook handlers are bundled here
 */

/**
 * There is a plugin setting to disable the URL based cron, so check it
 *
 * @param string $hook        the name of the hook
 * @param string $type        the type of the hook
 * @param mixed  $returnvalue current return value
 * @param array  $params      supplied params
 *
 * @return void|false
 */
function commandline_cron_route_cron_handler($hook, $type, $returnvalue, $params) {
	
	if (elgg_get_plugin_setting("disable_url", "commandline_cron") == "yes") {
		return false;
	}
}
