<?php

$Module = array( "name" => "Users, groups management");

$ViewList = array();

$ViewList['login'] = array(
    'params' => array(),
    'uparams' => array('r'),
);

$ViewList['logout'] = array(
    'params' => array()
    );

$ViewList['account'] = array(
    'params' => array(),
    'uparams' => array('msg','action','csfr','tab'),
    'functions' => array( 'selfedit' )
);

$ViewList['userlist'] = array(
    'script' => 'userlist.php',
    'params' => array(),
    'functions' => array( 'userlist' )
    );

$ViewList['forgotpassword'] = array(
    'params' => array(),
);

$ViewList['remindpassword'] = array(
    'params' => array('hash'),
);


$ViewList['registration'] = array (
	'params' => array(),
);

//admin part
$ViewList['list'] = array(
    'script' => 'admin/list.php',
    'params' => array(),
    'functions' => array( 'userlist' )
);

$ViewList['new'] = array(
    'script' => 'admin/new.php',
    'params' => array(),
    'functions' => array( 'createuser' )
);

$ViewList['edit'] = array(
    'script' => 'admin/edit.php',
    'params' => array('user_id'),
    'functions' => array( 'edituser' )
);

$ViewList['delete'] = array(
    'script' => 'admin/delete.php',
    'params' => array('user_id'),
    'uparams' => array('csfr'),
    'functions' => array( 'deleteuser' )
);

$ViewList['grouplist'] = array(
    'script' => 'admin/grouplist.php',
    'params' => array(),
    'functions' => array( 'grouplist' )
);

$ViewList['newgroup'] = array(
    'script' => 'admin/newgroup.php',
    'params' => array(),
    'functions' => array( 'creategroup', 'editgroup' )
);

$ViewList['editgroup'] = array(
    'script' => 'admin/editgroup.php',
    'params' => array('group_id'),
    'functions' => array( 'editgroup' )
);

$ViewList['deletegroup'] = array(
    'script' => 'admin/deletegroup.php',
    'params' => array('group_id'),
    'uparams' => array('csfr'),
    'functions' => array( 'deletegroup' )
);

$ViewList['groupassignuser'] = array(
    'script' => 'admin/groupassignuser.php',
    'params' => array('group_id'),
    'functions' => array( 'groupassignuser' )
);

$ViewList['groupassignrole'] = array(
    'script' => 'admin/groupassignrole.php',
    'params' => array('group_id'),
    'functions' => array( 'groupassignrole' )
);

$ViewList['loginas'] = array(
    'script' => 'admin/loginas.php',
    'params' => array('user_id'),
    'functions' => array( 'loginas' ),
);

$FunctionList['groupassignuser'] = array('explain' => 'Allow user to assign user to group');
$FunctionList['groupassignrole'] = array('explain' => 'Allow user to assign role to group');
$FunctionList['editgroup'] = array('explain' => 'Allow user to edit group');
$FunctionList['creategroup'] = array('explain' => 'Allow user to create group');
$FunctionList['deletegroup'] = array('explain' => 'Allow user to delete group');
$FunctionList['createuser'] = array('explain' => 'Allow user to create another user');
$FunctionList['deleteuser'] = array('explain' => 'Allow user to delete another user');
$FunctionList['edituser'] = array('explain' => 'Allow user to edit another user');
$FunctionList['grouplist'] = array('explain' => 'Allow user to list group');
$FunctionList['userlist'] = array('explain' => 'Allow user to list users');
$FunctionList['selfedit'] = array('explain' => 'Allow user to edit his own data');
$FunctionList['loginas'] = array('explain' => 'Allow user to login as other user');
$FunctionList['authenticate'] = array('explain' => 'Allow user to register, login and other authentication system functions');

?>