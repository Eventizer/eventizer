<?php
$tpl = erLhcoreClassTemplate::getInstance('lhpermission/roles.tpl.php');

$tpl->set('currentUser', $currentUser);
$Result['content'] = $tpl->fetch();
$Result['title'] = array(
    'title' => __t('permission/roles', 'Roles list'),
    'small_title' => __t('permission/roles', 'manage system users roles')
);

$Result['submenu_active'] = 'users';
$Result['menu'] = 'settings';
$Result['subsubmenu'] = 'roles';
$Result['path'] = array(
    array(
        'title' => __t('permission/roles', 'List of roles')
    )
)?>

