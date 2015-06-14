<?php
$tpl = erLhcoreClassTemplate::getInstance ( 'lhevent/myevents.tpl.php' );

$filterParams = erLhcoreClassSearchHandler::getParams ( array (
		'module_file' => 'eventlist',
		'module' => 'events',
		'format_filter' => true,
		'use_override' => true,
		'uparams' => $Params ['user_parameters_unordered'] 
) );

$append = erLhcoreClassSearchHandler::getURLAppendFromInput ( $filterParams ['input_form'],false,false,array('category') );

$filterParams ['filter']['filter'] = array('org_id' => erLhcoreClassUser::instance()->getUserID()); 

$pages = new lhPaginator ();
$pages->serverURL = __url ( 'event/myevents' ).$append;
$pages->items_total = erLhcoreClassModelEvents::getCount ( $filterParams ['filter'] );
$pages->setItemsPerPage ( 15 );
$pages->paginate ();

if ($pages->items_total > 0) {
	$tpl->set ( 'items', erLhcoreClassModelEvents::getList ( array_merge($filterParams ['filter'], array (
			'offset' => $pages->low,
			'limit' => $pages->items_per_page 
	))));
}

$categories = erLhAbstractModelEventCategory::getList();

$tpl->set ( 'pages', $pages );

$Result ['sidebar'] = 'myevents_list';
$Result['sidebartype'] = 'right';

$Result ['content'] = $tpl->fetch ();
$Result['filterParams'] = $filterParams;
$Result['sidebarData']['categories'] = $categories;
$Result['sidebarData']['append'] = $append;

$Result ['title'] = array (
		'title' => __t ( 'event/list', 'Events' ),
		'small_title' => '' 
);

$Result ['path'] = array (
	array (
		'title' => __t ( 'event/list', 'Events' ) 
	) 
);

?>