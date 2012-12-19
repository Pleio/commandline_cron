<?php

	function commandline_cron_generate_secret($site_guid = 0){
		$result = false;
		
		$site_guid = sanitise_int($site_guid, false);
		
		$site = elgg_get_site_entity($site_guid);
		
		if(!empty($site) && elgg_instanceof($site, "site", null, "ElggSite")){
			$site_secret = get_site_secret();
			
			$result = md5($site->getGUID() . $site_secret . $site->time_created);
		}
		
		return $result;
	}

	function commandline_cron_validate_secret($secret){
		$result = false;
		
		if(!empty($secret)){
			if($correct_secret = commandline_cron_generate_secret()){
				if($secret === $correct_secret){
					$result = true;
				}
			}
		}
		
		return $result;
	}