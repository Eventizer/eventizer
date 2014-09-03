<?php

$tpl = erLhcoreClassTemplate::getInstance( 'lhsystem/configuration.tpl.php');

$Result['content'] = $tpl->fetch();
$Result['path'] = array(
	array('url' => __url('system/configuration'),'title' => __t('system/configuration','System configuration'))
)

?>