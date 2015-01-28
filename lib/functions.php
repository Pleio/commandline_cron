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
	
	$site_guid = sanitise_int($site_guid, false);
	
	$site = elgg_get_site_entity($site_guid);
	if (empty($site)) {
		return false;
	}
	
	$site_secret = get_site_secret();
	
	return md5($site->getGUID() . $site_secret . $site->time_created);
}

/**
 * Validate a supplied secret
 *
 * @param string $secret the secret to validate
 *
 * @return bool
 */
function commandline_cron_validate_secret($secret) {
	
	if (empty($secret)) {
		return false;
	}
	
	$correct_secret = commandline_cron_generate_secret();
	if (empty($correct_secret)) {
		return false;
	}
	
	return ($secret === $correct_secret);
}