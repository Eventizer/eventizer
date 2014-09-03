<?php

$Module = array( "name" => "Users, groups management");

$ViewList = array();

$ViewList['list'] = array(
    'script' => 'list.php',
    'params' => array(),
    'functions' => array( 'userlist' )
);

$ViewList['new'] = array(
	'script' => 'new.php',
	'params' => array(),
	'functions' => array( 'createuser' )
);

$ViewList['edit'] = array(
    'script' => 'edit.php',
    'params' => array('user_id'),
	'functions' => array( 'edituser' )
);

$ViewList['delete'] = array(
	'script' => 'delete.php',
	'params' => array('user_id'),
	'uparams' => array('csfr'),
	'functions' => array( 'deleteuser' )
);

$ViewList['grouplist'] = array(
	'script' => 'grouplist.php',
	'params' => array(),
	'functions' => array( 'grouplist' )
);

$ViewList['newgroup'] = array(
	'script' => 'newgroup.php',
	'params' => array(),
	'functions' => array( 'creategroup', 'editgroup' )
);

$ViewList['editgroup'] = array(
	'script' => 'editgroup.php',
	'params' => array('group_id'),
	'functions' => array( 'editgroup' )
);

$ViewList['deletegroup'] = array(
	'script' => 'deletegroup.php',
	'params' => array('group_id'),
	'uparams' => array('csfr'),
	'functions' => array( 'deletegroup' )
);

$ViewList['groupassignuser'] = array(
	'script' => 'groupassignuser.php',
	'params' => array('group_id'),
	'functions' => array( 'groupassignuser' )
);

$ViewList['groupassignrole'] = array(
	'script' => 'groupassignrole.php',
	'params' => array('group_id'),
	'functions' => array( 'groupassignrole' )
);

$ViewList['loginas'] = array(
	'script' => 'loginas.php',
	'params' => array('user_id'),
	'functions' => array( 'loginas' ),
);

$FunctionList = array();
$FunctionList['userlist'] = array('explain' => 'Allow user to list users');
$FunctionList['createuser'] = array('explain' => 'Allow user to create another user');
$FunctionList['edituser'] = array('explain' => 'Allow user to edit another user');
$FunctionList['deleteuser'] = array('explain' => 'Allow user to delete another user');
$FunctionList['grouplist'] = array('explain' => 'Allow user to list group');
$FunctionList['creategroup'] = array('explain' => 'Allow user to create group');
$FunctionList['editgroup'] = array('explain' => 'Allow user to edit group');
$FunctionList['deletegroup'] = array('explain' => 'Allow user to delete group');
$FunctionList['groupassignuser'] = array('explain' => 'Allow user to assign user to group');
$FunctionList['groupassignrole'] = array('explain' => 'Allow user to assign role to group');
$FunctionList['loginas'] = array('explain' => 'Allow user login as another user');

?>