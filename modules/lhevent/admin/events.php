<?php
$tpl = erLhcoreClassTemplate::getInstance('lhevent/events.tpl.php');

$pages = new lhPaginator();
$pages->serverURL = __url('event/events');
$pages->items_total = erLhcoreClassModelEvents::getCount();
$pages->setItemsPerPage(25);
$pages->paginate();

if ($pages->items_total > 0) {
    $tpl->set('items', erLhcoreClassModelEvents::getList(array(
        'offset' => $pages->low,
        'limit' => $pages->items_per_page
    )));
}

$tpl->set('pages', $pages);

$Result['title'] = array(
    'title' => __t('event/list', 'Events list'),
    'small_title' => ''
);
$Result['menu'] = 'events';
$Result['submenu'] = 'events';
$Result['content'] = $tpl->fetch();
$Result['path'] = array(
    array(
        'title' => __t('event/list', 'Events list')
    )
);

?>