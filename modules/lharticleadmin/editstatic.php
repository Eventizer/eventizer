<?php

$tpl = erLhcoreClassTemplate::getInstance( 'lharticleadmin/editstatic.tpl.php');

try {
	$articleStaticData = erLhcoreClassModelArticleStatic::fetch($Params['user_parameters']['static_id']);
} catch (Exception $e) {
	erLhcoreClassModule::redirect('articleadmin/liststatic');
	exit();
}

$_SESSION['has_access_to_editor'] = 1;

if ( isset($_POST['cancelArticleStaticAction']) ) {
 	erLhcoreClassModule::redirect('articleadmin/liststatic');
 	exit;
}

if ( isset($_POST['saveArticleStaticAction']) || isset($_POST['updateArticleStaticAction']) ) {
	
 	$errors = erLhcoreClassModelArticleStatic::validateInput($articleStaticData);
	
 	if (empty($errors)) { 
 		
		$articleStaticData->updateThis();
				
		if (isset($_POST['saveArticleStaticAction'])) {
			erLhcoreClassModule::redirect('articleadmin/liststatic');
			exit;
		} else {
			$tpl->set('alertSuccessAction', __t('system/message','Updated'));
		}
		
		$articleStaticData = erLhcoreClassModelArticleStatic::fetch($articleStaticData->id);
		
	} else {
		$tpl->set('errors',$errors);
	}
	
}

$tpl->set('articleStaticData',$articleStaticData);

$Result['content'] = $tpl->fetch();
$Result['path'] = array(
	array('url' => __url('articleadmin/liststatic'),'title' => __t('lharticleadmin/liststatic','Static articles')),
	array('title' =>  $articleStaticData->name)
)

?>