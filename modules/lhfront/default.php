<?php

$tpl = erLhcoreClassTemplate::getInstance( 'lhfront/default.tpl.php');
$tpl->set('items', erLhcoreClassModelEvents::getList(array(
		'limit' => 4
)));

$Result['content'] = $tpl->fetch();
$Result['pagelayout'] = 'front';


?>