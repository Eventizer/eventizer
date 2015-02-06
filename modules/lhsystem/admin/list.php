<?php

$tpl = erLhcoreClassTemplate::getInstance( 'lhsystem/list.tpl.php');

$Result['submenu'] = 'general';
$Result['menu'] = 'settings';
$Result['title'] =  array('title' => erTranslationClassLhTranslation::getInstance()->getTranslation('system/list','General settings'),
    'small_title' =>  '');
$Result['content'] = $tpl->fetch();

$Result['path'] = array(
    array('title' => erTranslationClassLhTranslation::getInstance()->getTranslation('system/list','General settings'))
)
?>