<?php

$tpl = erLhcoreClassTemplate::getInstance( 'lhuseradmin/list.tpl.php');

if(isset($_POST['exportCSV'])){
	erLhcoreClassModelUser::exportCSV();
}

$pages = new lhPaginator();
$pages->serverURL = erLhcoreClassDesign::baseurl('useradmin/list');
$pages->items_total = erLhcoreClassModelUser::getUserCount();
$pages->setItemsPerPage(20);
$pages->paginate();

$userlist = erLhcoreClassModelUser::getUserList(array('offset' => $pages->low, 'limit' => $pages->items_per_page,'sort' => 'id ASC'));

$tpl->set('userlist',$userlist);
$tpl->set('pages',$pages);

$Result['title'] = __t('users/list','Users list');
$Result['small_title'] = __t('users/list','manage system users');
$Result['submenu_active'] = 'users';
$Result['menu'] = 'settings';
$Result['subsubmenu'] = 'users';
$Result['content'] = $tpl->fetch();

$Result['path'] = array(
	array('title' => __t('user/userlist','Users'))
);

?>