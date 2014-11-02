<?php
$tpl = erLhcoreClassTemplate::getInstance('lhsystem/developer.tpl.php');

$Result['submenu'] = 'developer';
$Result['menu'] = 'settings';
$Result['title'] = array(
    'title' => erTranslationClassLhTranslation::getInstance()->getTranslation('system/smtp', 'Developer'),
    'small_title' => __t('system/developer', 'tools')
);

$Result['content'] = $tpl->fetch();
$Result['path'] = array(
    array(
        'url' => __url('system/developer'),
        'title' => __t('system/index', 'Developer tools')
    )
);

?>