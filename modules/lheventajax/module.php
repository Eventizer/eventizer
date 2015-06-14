<?php
$Module = array (
		"name" => "Event ajax modules",
		'variable_params' => true 
);

$ViewList = array ();

$ViewList ['saveevent'] = array (
		'script' => 'saveevent.php',
		'params' => array ('id'),
		'functions' => array (
				'use' 
		) 
);

$ViewList ['removesavedevent'] = array (
		'script' => 'removesavedevent.php',
		'params' => array ('id'),
		'functions' => array (
				'use' 
		) 
);

$ViewList ['removemyevent'] = array (
		'script' => 'removemyevent.php',
		'params' => array ('id'),
		'functions' => array (
				'use' 
		),
        'limitations' => array('self' => array('method' => 'erLhcoreClassModelEvents::isOwner','param' => 'id'),'global' =>'administrate'),
    
);

$FunctionList = array ();
$FunctionList ['use'] = array (
		'explain' => 'Allow use ajax modules' 
);
?>