<?php

$tpl = erLhcoreClassTemplate::getInstance('lhorganizer/profile.tpl.php');

$tab = (isset ( $Params['user_parameters_unordered']['tab'] )) ? $Params['user_parameters_unordered']['tab'] : '';

$item = erLhcoreClassModelUser::fetch((int)$Params['user_parameters']['id']);

if ( !in_array( $tab, array ('live', 'past'))) {
    erLhcoreClassModule::redirect ( 'organizer/profile','/'.$item->id.'/(tab)/live');
}

if ($item) {
    
    $filterParams = erLhcoreClassSearchHandler::getParams ( array (
        'module_file' => 'eventlist',
        'module' => 'events',
        'format_filter' => true,
        'use_override' => true,
        'uparams' => $Params ['user_parameters_unordered']
    ) );
    
    $append = erLhcoreClassSearchHandler::getURLAppendFromInput ( $filterParams ['input_form'],false,false,array('category') );
    
    if ($tab == 'live') {
        $filterParams ['filter']['filtergt'] = array('end_date' => time());
    } else {
        $filterParams ['filter']['filterlt'] = array('end_date' => time());
    }
    
    $pages = new lhPaginator ();
    $pages->serverURL = __url ( 'organizer/profile' ).'/'.$item->id.$append;
    $pages->items_total = erLhcoreClassModelEvents::getCount ( $filterParams ['filter'] );
    $pages->setItemsPerPage ( 15 );
    $pages->paginate ();
    
    if ($pages->items_total > 0) {
    	$tpl->set ( 'items', erLhcoreClassModelEvents::getList ( array_merge($filterParams ['filter'], array (
    			'offset' => $pages->low,
    			'limit' => $pages->items_per_page 
    	))));
    }
    
    $live_count = erLhcoreClassModelEvents::getCount ( array('filtergt'=>array('end_date' => time())) );
    $past_count = erLhcoreClassModelEvents::getCount ( array('filterlt'=>array('end_date' => time())) );
	
	$tpl->set('pages',$pages);
	$tpl->set('item',$item);
	$tpl->set('live_count', $live_count);
	$tpl->set('past_count', $past_count);
	$tpl->set('tab', $tab);
	
	$Result['organizer'] = $item;
	$Result['content'] = $tpl->fetch();
	
	
	$Result ['sidebar'] = 'organizer_profile';
	$Result['sidebartype'] = 'right';
	$Result['path'] = array(
	    array(
	        'title' => $item->name.' '.__t('organizer/profile','profile')
	    )
	);
	
} else {
    $Result = erLhcoreClassModule::Error404();
}

?>