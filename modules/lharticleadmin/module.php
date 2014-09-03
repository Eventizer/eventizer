<?php

$Module = array( "name" => "Article admin module",
				 'variable_params' => true );

$ViewList = array();

$ViewList['liststatic'] = array( 
    'script' => 'liststatic.php',
    'params' => array(),    
    'functions' => array( 'edit' )
);

$ViewList['newstatic'] = array( 
    'script' => 'newstatic.php',
    'params' => array(),    
    'functions' => array( 'edit' )
);

$ViewList['editstatic'] = array( 
    'script' => 'editstatic.php',
    'params' => array('static_id'),    
    'functions' => array( 'edit' )
);

$ViewList['managecategories'] = array( 
    'script' => 'managecategories.php',
    'params' => array('category_id'),    
    'functions' => array( 'edit' )
);

$ViewList['newcategory'] = array(
	'script' => 'newcategory.php',
	'params' => array('category_id')
);

$ViewList['editcategory'] = array( 
    'script' => 'editcategory.php',
    'params' => array('category_id'),    
    'functions' => array( 'edit' )
);
    
$ViewList['deletecategory'] = array( 
    'script' => 'deletecategory.php',
    'params' => array('category_id'),
	'uparams' => array('csfr'),
	'functions' => array( 'edit' )
);

$ViewList['new'] = array(
	'script' => 'new.php',
	'params' => array('category_id'),
	'functions' => array( 'edit' )
);

$ViewList['edit'] = array(
	'script' => 'edit.php',
	'params' => array('article_id'),
	'functions' => array( 'edit' )
);

$ViewList['delete'] = array(
	'script' => 'delete.php',
	'params' => array('article_id'),
	'uparams' => array('csfr'),
	'functions' => array( 'edit' )
);
    
$FunctionList = array();  
$FunctionList['edit'] = array('explain' => 'Allow edit articles');  

?>