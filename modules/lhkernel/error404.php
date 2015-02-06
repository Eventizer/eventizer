<?php

$tpl = erLhcoreClassTemplate::getInstance('lhkernel/error404.tpl.php');

$Result['content'] = $tpl->fetch();
$Result['path'] = array(array('title' => erTranslationClassLhTranslation::getInstance()->getTranslation('kernel/error404','404 Page Not Found')));

?>