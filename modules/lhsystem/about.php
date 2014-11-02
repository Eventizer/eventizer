<?php

$tpl = erLhcoreClassTemplate::getInstance( 'lhsystem/about.tpl.php');

$Result['title'] =  array('title'=>erTranslationClassLhTranslation::getInstance()->getTranslation('system/about','About system'),
    'small_title'=>''
);
$Result['menu'] = 'about';
$Result['content'] = $tpl->fetch();
$Result['path'] = array(
		array('title' => __t('system/about','About system'))
);

?>