<?php

$Module = array( "name" => "System configuration");

$ViewList = array();


$ViewList['configuration'] = array(
    'params' => array(),
    'functions' => array( 'use' )
);

$ViewList['expirecache'] = array(
    'params' => array(),
    'functions' => array( 'expirecache' )
);

$ViewList['smtp'] = array(
    'params' => array(),
    'functions' => array( 'configuresmtp' )
);

$ViewList['timezone'] = array(
    'params' => array(),
    'functions' => array( 'timezone' )
);

$ViewList['languages'] = array(
    'params' => array(),
    'uparams' => array('updated','sa'),
    'functions' => array( 'changelanguage' )
);


$ViewList['developer'] = array(
		'params' => array(),
		'functions' => array( 'developer' )
);

$ViewList['check'] = array(
		'params' => array(),
		'functions' => array( 'developer' )
);

$ViewList['about'] = array(
		'params' => array()
);

$FunctionList['use'] = array('explain' => 'Allow user to see configuration links');
$FunctionList['expirecache'] = array('explain' => 'Allow user to clear cache');
$FunctionList['configuresmtp'] = array('explain' => 'Allow user to configure SMTP');
$FunctionList['configurelanguages'] = array('explain' => 'Allow user to configure languages');
$FunctionList['changelanguage'] = array('explain' => 'Allow user to change his languages');
$FunctionList['developer'] = array('explain' => 'Allow user to view developer zone');

$FunctionList['timezone'] = array('explain' => 'Allow user to change global time zone');

?>