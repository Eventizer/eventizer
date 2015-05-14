<?php

$tpl = erLhcoreClassTemplate::getInstance('lhevent/view.tpl.php');

try {
	$item = erLhcoreClassModelEvents::fetch((int)$Params['user_parameters']['id']);
	$tpl->set('item',$item) ;
} catch (Exception $e) {
	
}


if (erLhcoreClassUser::instance()->isLogged()) {
    $user_ID = erLhcoreClassUser::instance()->getUserID();
    $issaved = erLhcoreClassModelSavedEvents::getCount(array('filter' => array('user_id' => $user_ID, 'event_id' => $item->id))) ;
} else {
    $issaved = 0;
}
$saved = erLhcoreClassModelSavedEvents::getCount(array('filter' => array('event_id' => $item->id)));

$tpl->set('saved',$saved) ;
$tpl->set('issaved',$issaved) ;
$Result['additional_js'] = '<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false"></script>';
$Result['content'] = $tpl->fetch();
$Result['pagelayout'] = 'product_view';

$Result['path'] = array(
    array(
        'title' =>$item->name
    )
);

?>