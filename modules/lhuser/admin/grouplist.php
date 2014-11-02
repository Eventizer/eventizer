<?php

$tpl = erLhcoreClassTemplate::getInstance('lhuser/grouplist.tpl.php');

$pages = new lhPaginator();
$pages->items_total = erLhcoreClassModelGroup::getCount();
$pages->setItemsPerPage(10);
$pages->serverURL = erLhcoreClassDesign::baseurl('user/grouplist');
$pages->paginate();

$tpl->set('pages',$pages);

if ($pages->items_total > 0) {
    $tpl->set('groups',erLhcoreClassModelGroup::getList(array('offset' => $pages->low, 'limit' => $pages->items_per_page )));
} else {
    $tpl->set('groups',array());
}

$Result['title'] = array('title' => __t('user/listgroups','Group list'),
    'small_title' => __t('user/listgroups','manage system users groups')
);
$Result['submenu_active'] = 'users';
$Result['menu'] = 'settings';
$Result['subsubmenu'] = 'groups';
$Result['content'] = $tpl->fetch();

$Result['path'] = array(
	array('title' => __t('user/grouplist','Groups')
))

?>