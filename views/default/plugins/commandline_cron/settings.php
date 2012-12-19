<?php

	$plugin = elgg_extract("entity", $vars);
	
	$noyes_options = array(
		"no" => elgg_echo("option:no"),
		"yes" => elgg_echo("option:yes")
	);
	
	echo "<div>";
	echo elgg_echo("commandline_cron:settings:disable_url");
	echo elgg_view("input/dropdown", array("name" => "params[disable_url]", "value" => $plugin->disable_url, "options_values" => $noyes_options, "class" => "mlm"));
	echo "</div>";
	
	// installation instructions
	$install = "<div class='mbm'>" . elgg_echo("commandline_cron:install:description") . "</div>";
	
	// explain commandline
	$cli_path = elgg_get_config("plugins_path") . "commandline_cron/procedures/cli.php";
	$secret = commandline_cron_generate_secret();
	$host = $_SERVER["HTTP_HOST"];
	$memory_limit = ini_get("memory_limit");
	
	$commandline = "php " . $cli_path . " secret=" . $secret . " host=" . $host . " memory_limit=" . $memory_limit;
	
	if(!empty($_SERVER["HTTPS"])){
		$commandline .= " https=" . $_SERVER["HTTPS"];
	}
	
	$commandline .= " interval=minute";
	
	$install .= "<div>";
	$install .= elgg_echo("commandline_cron:install:commandline");
	$install .= "<pre>" . $commandline . "</pre>";
	$install .= "</div>";
	
	// explain interval options
	$intervals = array("reboot", "minute", "fiveminute", "fifteenmin", "halfhour", "hourly", "daily", "weekly", "monthly", "yearly");
	
	$install .= "<div>";
	$install .= elgg_echo("commandline_cron:install:options", array(implode(", ", $intervals)));
	$install .= "</div>";
	
	echo elgg_view_module("inline", elgg_echo("commandline_cron:install:title"), $install);