<?php

$tpl = new erLhcoreClassTemplate( 'lharticle/view.tpl.php');

try {
	$articleData = erLhcoreClassModelArticle::fetch((int)$Params['user_parameters']['article_id']);
} catch (Exception $e) {
	erLhcoreClassModule::redirect('/');
	exit();
}

$tpl->set('articleData',$articleData);

$Result['sidebartype'] = 'right';
$Result['content'] = $tpl->fetch();
$Result['path'] = array(array('title' => $articleData->name));

?>