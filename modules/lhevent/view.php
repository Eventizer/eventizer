<?php

$tpl = erLhcoreClassTemplate::getInstance('lhevent/view.tpl.php');

try {
	$item = erLhcoreClassModelEvents::fetch((int)$Params['user_parameters']['id']);
	$tpl->set('item',$item) ;
} catch (Exception $e) {
	
}
$Result['additional_js'] = '<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false"></script>';
$Result['content'] = $tpl->fetch();
$Result['pagelayout'] = 'product_view';

$Result['path'] = array(
    array(
        'title' =>$item->name
    )
);

?>