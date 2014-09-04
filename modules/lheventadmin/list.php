<?php

$tpl = erLhcoreClassTemplate::getInstance( 'lheventadmin/list.tpl.php');

$Result['title'] =  __t('eventadmin/list','Events list');
$Result['small_title'] =  '';
$Result['menu'] = 'event';
$Result['content'] = $tpl->fetch();
$Result['path'] = array(
		array('title' => __t('eventadmin/list','Events list'))
);

?>