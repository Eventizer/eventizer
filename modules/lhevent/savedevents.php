<?php
$tpl = erLhcoreClassTemplate::getInstance('lhevent/savedevents.tpl.php');

$filterParams = erLhcoreClassSearchHandler::getParams(array(
    'module_file' => 'eventlist',
    'module' => 'events',
    'format_filter' => true,
    'use_override' => true,
    'uparams' => $Params['user_parameters_unordered']
));

$append = erLhcoreClassSearchHandler::getURLAppendFromInput($filterParams['input_form'], false, false, array(
    'category'
));

$savedevents = erLhcoreClassModelSavedEvents::getList(array(
    'filter' => array(
        'user_id' => erLhcoreClassUser::instance()->getUserID()
    )
));

$pages = new lhPaginator();

if (! empty($savedevents)) {
    $saved_event_id = array();
    foreach ($savedevents as $saved) {
        $saved_event_id[] = $saved->event_id;
    }
    
    $filterParams['filter']['filterin'] = array(
        'id' => $saved_event_id
    );
    
    
    $pages->serverURL = __url('event/savedevents') . $append;
    $pages->items_total = erLhcoreClassModelEvents::getCount($filterParams['filter']);
    $pages->setItemsPerPage(15);
    $pages->paginate();
    
    if ($pages->items_total > 0) {
        $tpl->set('items', erLhcoreClassModelEvents::getList(array_merge($filterParams['filter'], array(
            'offset' => $pages->low,
            'limit' => $pages->items_per_page
        ))));
    }
    
   
}

$tpl->set('pages', $pages);

$categories = erLhAbstractModelEventCategory::getList();

$Result['sidebar'] = 'event_list';
$Result['sidebartype'] = 'right';

$Result['content'] = $tpl->fetch();
$Result['filterParams'] = $filterParams;
$Result['sidebarData']['categories'] = $categories;
$Result['sidebarData']['append'] = $append;
$Result['sidebarData']['posturl'] = __url('event/savedevents');

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