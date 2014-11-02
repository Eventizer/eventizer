<?php
$tpl = erLhcoreClassTemplate::getInstance('lhevent/list.tpl.php');
$pages = new lhPaginator();
$pages->serverURL = __url('event/list');
$pages->items_total = erLhcoreClassModelEvents::getCount();
$pages->setItemsPerPage(15);
$pages->paginate();

if ($pages->items_total > 0) {
    $tpl->set('items', erLhcoreClassModelEvents::getList(array(
        'offset' => $pages->low,
        'limit' => $pages->items_per_page
    )));
}

$tpl->set('pages', $pages);
$Result['sidebar'] = 'event_list';
$Result['content'] = $tpl->fetch();

$Result['title'] = array(
    'title' => __t('event/list', 'Events'),
    'small_title' => ''
);

$Result['path'] = array(
    array(
        'title' => __t('event/list', 'Events')
    )
);

?>