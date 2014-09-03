<?php

$tpl = erLhcoreClassTemplate::getInstance('lhuseradmin/grouplist.tpl.php');

$pages = new lhPaginator();
$pages->items_total = erLhcoreClassModelGroup::getCount();
$pages->setItemsPerPage(10);
$pages->serverURL = erLhcoreClassDesign::baseurl('useradmin/grouplist');
$pages->paginate();

$tpl->set('pages',$pages);

if ($pages->items_total > 0) {
    $tpl->set('groups',erLhcoreClassModelGroup::getList(array('offset' => $pages->low, 'limit' => $pages->items_per_page )));
} else {
    $tpl->set('groups',array());
}

$Result['title'] = __t('useradmin/listgroups','Group list');
$Result['small_title'] = __t('useradmin/listgroups','manage system users groups');
$Result['submenu_active'] = 'users';
$Result['menu'] = 'settings';
$Result['subsubmenu'] = 'groups';
$Result['content'] = $tpl->fetch();

$Result['path'] = array(
	array('url' => __url('system/configuration'),'title' => __t('user/grouplist','System configuration')),
	array('title' => __t('user/grouplist','Groups')
))

?>