<?php

$tpl = erLhcoreClassTemplate::getInstance( 'lhfront/default.tpl.php');
$tpl->set('items', erLhcoreClassModelEvents::getList(array(
		'limit' => 4
)));

$tpl->set('categories', erLhAbstractModelEventCategory::getList(array('limit'=>5)));

$Result['content'] = $tpl->fetch();
$Result['pagelayout'] = 'front';


?>