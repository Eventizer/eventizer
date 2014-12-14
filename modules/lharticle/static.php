<?php

$tpl = new erLhcoreClassTemplate( 'lharticle/static.tpl.php');

try {
	$articleStaticData = erLhcoreClassModelArticleStatic::fetch((int)$Params['user_parameters']['static_id']);
} catch (Exception $e) {
	erLhcoreClassModule::redirect('/');
	exit();
}

$tpl->set('articleStaticData',$articleStaticData);

$Result['sidebartype'] = 'right';

$Result['content'] = $tpl->fetch();
$Result['path'] = array(array('title' => $articleStaticData->name));

?>