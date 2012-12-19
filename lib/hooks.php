<?php

	/**
	 * There is a plugin setting to disable the URL based cron, so check it
	 * 
	 * @param string $hook
	 * @param string $type
	 * @param bool $returnvalue
	 * @param array $params
	 * @return boolean
	 */
	function commandline_cron_route_cron_handler($hook, $type, $returnvalue, $params){
		
		if(elgg_get_plugin_setting("disable_url", "commandline_cron") == "yes"){
			return false;
		}
	}