<?php if (erConfigClassLhConfig::getInstance()->getSetting( 'site', 'debug_output' ) == true) {
    $debug_ip = erConfigClassLhConfig::getInstance()->getSetting( 'site', 'debug_ip' );

    if(count($debug_ip) == 0 || in_array($_SERVER['REMOTE_ADDR'], $debug_ip)) {
		$debug = ezcDebug::getInstance();
		echo $debug->generateOutput();
    }
} ?>