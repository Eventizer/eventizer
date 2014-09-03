<?php

$tpl = erLhcoreClassTemplate::getInstance('lhkernel/csrf-missing.tpl.php');

$Result['content'] = $tpl->fetch();
$Result['path'] = array(array('title' => erTranslationClassLhTranslation::getInstance()->getTranslation('kernel/csrfmissing','CSRF')));

?>