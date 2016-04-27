<?php
$config_path = $argv[1];
//set error_reporting auf ein böses level
error_reporting(E_ALL & ~E_STRICT & ~E_DEPRECATED);

//import autoloader für InstILIAS
require __DIR__ . '/../vendor/autoload.php';

$cmds = array("php ".__DIR__."/install_ilias.php $config_path"
			, "php ".__DIR__."/configure_ilias.php $config_path");

foreach ($cmds as $cmd) {
	while (@ob_end_flush()); // end all output buffers if any
	$proc = popen($cmd, 'r');

	while (!feof($proc)) {
		echo fread($proc, 4096);
		@flush();
	}
}
die(0);