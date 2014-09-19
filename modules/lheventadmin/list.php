<?php

$tpl = erLhcoreClassTemplate::getInstance( 'lheventadmin/list.tpl.php');

$pages = new lhPaginator();
$pages->serverURL = __url('eventadmin/list');
$pages->items_total = erLhcoreClassModelEvents::getCount();
$pages->setItemsPerPage(25);
$pages->paginate();

if ($pages->items_total > 0) {
    $tpl->set('items',erLhcoreClassModelEvents::getList( array('offset' => $pages->low, 'limit' => $pages->items_per_page)));
}

$tpl->set('pages',$pages);

$Result['title'] =  __t('eventadmin/list','Events list');
$Result['small_title'] =  '';
$Result['menu'] = 'events';
$Result['content'] = $tpl->fetch();
$Result['path'] = array(
		array('title' => __t('eventadmin/list','Events list'))
);

?>