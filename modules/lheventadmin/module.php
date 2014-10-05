<?php

$Module = array( "name" => "Event administration module",
				 'variable_params' => true );

$ViewList = array();
   
$ViewList['list'] = array( 
    'params' => array(),
    'functions' => array('use')
);

$ViewList['new'] = array( 
    'params' => array(),
    'functions' => array('use')
);

$ViewList['edit'] = array( 
    'params' => array('event_id'),
    'functions' => array('use')
);

$ViewList['widget'] = array( 
    'params' => array(),
    'functions' => array('use')
);
   
$FunctionList['use'] = array('explain' => 'Allow user to manage events');
?>