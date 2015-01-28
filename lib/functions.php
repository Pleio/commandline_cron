<?php
/**
 * All helper functions are bundled here
 */

/**
 * Generate a secret to protect misuse
 *
 * @param int $site_guid the site guid to generate the secret for
 *
 * @return false|string
 */
function commandline_cron_generate_secret($site_guid = 0) {
	$result = false;
	
	$site_guid = sanitise_int($site_guid, false);
	
	if ($site = elgg_get_site_entity($site_guid)) {
		$site_secret = get_site_secret();
		
		$result = md5($site->getGUID() . $site_secret . $site->time_created);
	}
	
	return $result;
}

/**
 * Validate a supplied secret
 *
 * @param string $secret the secret to validate
 *
 * @return bool
 */
function commandline_cron_validate_secret($secret) {
	$result = false;
	
	if (!empty($secret)) {
		if ($correct_secret = commandline_cron_generate_secret()) {
			if ($secret === $correct_secret) {
				$result = true;
			}
		}
	}
	
	return $result;
}