<?php

$Module = array( "name" => "Article module",
				 'variable_params' => true );

$ViewList = array();

$ViewList['static'] = array(
	'script' => 'static.php',
	'params' => array('static_id')
);

$ViewList['category'] = array(
	'script' => 'category.php',
	'params' => array('category_id')
);

$ViewList['view'] = array(
	'script' => 'view.php',
	'params' => array('article_id')
);

$FunctionList = array();  

?>