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

//for admin part
$ViewList['liststatic'] = array(
	'script' => 'admin/liststatic.php',
	'params' => array(),
	'functions' => array( 'edit' )
);

$ViewList['newstatic'] = array(
	'script' => 'admin/newstatic.php',
	'params' => array(),
	'functions' => array( 'edit' )
);

$ViewList['editstatic'] = array(
	'script' => 'admin/editstatic.php',
	'params' => array('static_id'),
	'functions' => array( 'edit' )
);

$ViewList['managecategories'] = array(
	'script' => 'admin/managecategories.php',
	'params' => array('category_id'),
	'functions' => array( 'edit' )
);

$ViewList['newcategory'] = array(
	'script' => 'admin/newcategory.php',
	'params' => array('category_id')
);

$ViewList['editcategory'] = array(
	'script' => 'admin/editcategory.php',
	'params' => array('category_id'),
	'functions' => array( 'edit' )
);

$ViewList['deletecategory'] = array(
	'script' => 'admin/deletecategory.php',
	'params' => array('category_id'),
	'uparams' => array('csfr'),
	'functions' => array( 'edit' )
);

$ViewList['new'] = array(
	'script' => 'admin/new.php',
	'params' => array('category_id'),
	'functions' => array( 'edit' )
);

$ViewList['edit'] = array(
	'script' => 'admin/edit.php',
	'params' => array('article_id'),
	'functions' => array( 'edit' )
);

$ViewList['delete'] = array(
	'script' => 'admin/delete.php',
	'params' => array('article_id'),
	'uparams' => array('csfr'),
	'functions' => array( 'edit' )
);


$FunctionList = array();  

?>