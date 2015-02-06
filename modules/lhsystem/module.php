<?php

$Module = array( "name" => "System configuration");

$ViewList = array();


$ViewList['configuration'] = array(
    'script' => 'admin/configuration.php',
    'params' => array(),
    'functions' => array( 'use' )
);

$ViewList['expirecache'] = array(
    'script' => 'admin/expirecache.php',
    'params' => array(),
    'functions' => array( 'expirecache' )
);

$ViewList['smtp'] = array(
    'script' => 'admin/smtp.php',
    'params' => array(),
    'functions' => array( 'configuresmtp' )
);

$ViewList['timezone'] = array(
    'script' => 'admin/timezone.php',
    'params' => array(),
    'functions' => array( 'timezone' )
);

$ViewList['languages'] = array(
    'script' => 'admin/languages.php',
    'params' => array(),
    'uparams' => array('updated','sa'),
    'functions' => array( 'changelanguage' )
);


$ViewList['developer'] = array(
        'script' => 'admin/developer.php',
		'params' => array(),
		'functions' => array( 'developer' )
);

$ViewList['check'] = array(
        'script' => 'admin/check.php',
		'params' => array(),
		'uparams' => array('action'),
		'functions' => array( 'developer' )
);

$ViewList['list'] = array(
    'script' => 'admin/list.php',
    'params' => array(),
    'functions' => array( 'general_settings' )
);

$ViewList['edit'] = array(
    'script' => 'admin/edit.php',
    'params' => array('config_id'),
    'functions' => array( 'general_settings' )
);

$ViewList['about'] = array(
        'script' => 'admin/about.php',
		'params' => array()
);

$FunctionList['use'] = array('explain' => 'Allow user to see configuration links');
$FunctionList['expirecache'] = array('explain' => 'Allow user to clear cache');
$FunctionList['configuresmtp'] = array('explain' => 'Allow user to configure SMTP');
$FunctionList['configurelanguages'] = array('explain' => 'Allow user to configure languages');
$FunctionList['changelanguage'] = array('explain' => 'Allow user to change his languages');
$FunctionList['developer'] = array('explain' => 'Allow user to view developer zone');
$FunctionList['general_settings'] = array('explain' => 'Allow user to view general settings');

$FunctionList['timezone'] = array('explain' => 'Allow user to change global time zone');

?>