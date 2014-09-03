<?php
$Module = array (
		"name" => "Ajax modules",
		'variable_params' => true 
);

$ViewList = array ();

$ViewList ['eventizernews'] = array (
		'script' => 'eventizernews.php',
		'params' => array (),
		'functions' => array (
				'use' 
		) 
);

$FunctionList = array ();
$FunctionList ['use'] = array (
		'explain' => 'Allow use ajax modules' 
);
?>