<?php

$tpl = erLhcoreClassTemplate::getInstance('lharticleadmin/liststatic.tpl.php');
$Result['content'] = $tpl->fetch();

$Result['path'] = array(
	array('url' => __url('articleadmin/liststatic'), 'title' => __t('lharticleadmin/liststatic','Static articles'))
)

?>