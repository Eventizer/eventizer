<?php
$tpl = erLhcoreClassTemplate::getInstance('lhsystem/developer.tpl.php');

$extensions = erLhcoreClassEventDispatcher::getInstance()->dispatch('system.developer_view_extenshions_block',array());
$tpl->set('extensions', $extensions);

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