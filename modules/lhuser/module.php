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

$ViewList['grouplist'] = array(
    'params' => array(),
    'functions' => array( 'grouplist' )
    );

$ViewList['edit'] = array(
    'params' => array('user_id'),
    'functions' => array( 'edituser' )
    );

$ViewList['delete'] = array(
    'params' => array('user_id'),
    'uparams' => array('csfr'),
    'functions' => array( 'deleteuser' )
    );

$ViewList['new'] = array(
    'params' => array(),
    'functions' => array( 'createuser' )
    );

$ViewList['newgroup'] = array(
    'params' => array(),
    'functions' => array( 'creategroup', 'editgroup' )
    );

$ViewList['editgroup'] = array(
    'params' => array('group_id'),
    'functions' => array( 'editgroup' )
    );

$ViewList['groupassignuser'] = array(
    'params' => array('group_id'),
    'functions' => array( 'groupassignuser' )
    );

$ViewList['deletegroup'] = array(
    'params' => array('group_id'),
	'uparams' => array('csfr'),
    'functions' => array( 'deletegroup' )
    );

$ViewList['forgotpassword'] = array(
    'params' => array(),
);

$ViewList['remindpassword'] = array(
    'params' => array('hash'),
);

$ViewList['setsetting'] = array (
		'params' => array('identifier','value')
);

$ViewList['setsettingajax'] = array (
		'params' => array('identifier','value'),
		'uparams' => array('indifferent')
);

$ViewList['setoffline'] = array (
		'functions' => array( 'changeonlinestatus' ),
		'params' => array('status')
);

$ViewList['setinvisible'] = array (
		'functions' => array( 'changevisibility' ),
		'params' => array('status')
);

$FunctionList['groupassignuser'] = array('explain' => 'Allow user to assign user to group');
$FunctionList['editgroup'] = array('explain' => 'Allow user to edit group');
$FunctionList['creategroup'] = array('explain' => 'Allow user to create group');
$FunctionList['deletegroup'] = array('explain' => 'Allow user to delete group');
$FunctionList['createuser'] = array('explain' => 'Allow user to create another user');
$FunctionList['deleteuser'] = array('explain' => 'Allow user to delete another user');
$FunctionList['edituser'] = array('explain' => 'Allow user to edit another user');
$FunctionList['grouplist'] = array('explain' => 'Allow user to list group');
$FunctionList['userlist'] = array('explain' => 'Allow user to list users');
$FunctionList['selfedit'] = array('explain' => 'Allow user to edit his own data');
$FunctionList['editdepartaments'] = array('explain' => 'Allow user to edit his responsible departaments');
$FunctionList['userlistonline'] = array('explain' => 'Allow user to see logged operators list, only from his department');
$FunctionList['userlistonlineall'] = array('explain' => 'Allow user to see logged operators list, not only from his department');
$FunctionList['changeonlinestatus'] = array('explain' => 'Allow user to change his online status');
$FunctionList['changeskypenick'] = array('explain' => 'Allow user to change/enter his skype nick');
$FunctionList['personalcannedmsg'] = array('explain' => 'Allow user to have personal canned messages');
$FunctionList['changevisibility'] = array('explain' => 'Allow user to change his visibility mode');
$FunctionList['change_visibility_list'] = array('explain' => 'Allow user to choose what list should be visible by him, pending/active/unread/closed');
$FunctionList['see_assigned_departments'] = array('explain' => 'Allow user to see departments assigned to him');
$FunctionList['allowtochoosependingmode'] = array('explain' => 'Allow user to choose what pending chats he can see, only assigned to him or all.');

?>