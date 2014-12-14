<?php

$tpl = erLhcoreClassTemplate::getInstance( 'lhfront/default.tpl.php');
$tpl->set('items', erLhcoreClassModelEvents::getList(array(
		'limit' => 4
)));

$tpl->set('categories', erLhAbstractModelEventCategory::getList(array('limit'=>5)));

$Result['additional_js'] = '<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false"></script>';
$Result['content'] = $tpl->fetch();
$Result['pagelayout'] = 'front';


?>