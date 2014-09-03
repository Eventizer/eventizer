<?php

$tpl = erLhcoreClassTemplate::getInstance( 'lhpermission/roles.tpl.php');

$tpl->set('currentUser',$currentUser);
$Result['content'] = $tpl->fetch();
$Result['title'] = __t('permission/roles','Roles list');
$Result['small_title'] = __t('permission/roles','manage system users roles');
$Result['submenu_active'] = 'users';
$Result['menu'] = 'settings';
$Result['subsubmenu'] = 'roles';
$Result['path'] = array(
	array('url' => __url('system/configuration'),'title' => __t('permission/roles','System configuration')),
	array('title' => __t('permission/roles','List of roles'))
)

?>