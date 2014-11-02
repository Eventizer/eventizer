<?php
$tpl = erLhcoreClassTemplate::getInstance('lhdashboard/dashboard.tpl.php');

$Result['content'] = $tpl->fetch();
$Result['menu'] = 'dashboard';
$Result['title'] = array(
    'title' => __t('dashboard/dashboard', 'Dashboard'),
    'small_title' => __t('dashboard/dashboard', 'Control panel')
);
$Result['path'] = array(
    array(
        'title' => __t('dashboard/dashboard', 'Dashboard')
    )
);
?>