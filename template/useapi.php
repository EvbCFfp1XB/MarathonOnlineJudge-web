<?php

function run_cmd($cmd)
{
	$shell_user = preg_replace('/\A\/home\/([0-9a-z-]+)\/MarathonOnlineJudge-judge\/www.*\z/', '$1', __DIR__);
	return shell_exec("sudo su -l $shell_user -c '" . $cmd . "'");
}

function run_cmd_exec($cmd, &$output, &$return_var)
{
	$shell_user = preg_replace('/\A\/home\/([0-9a-z-]+)\/MarathonOnlineJudge-judge\/www.*\z/', '$1', __DIR__);
	return exec("sudo su -l $shell_user -c '" . $cmd . "'", $output, $return_var);
}
