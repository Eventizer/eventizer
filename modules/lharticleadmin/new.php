<?php

$tpl = erLhcoreClassTemplate::getInstance( 'lharticleadmin/new.tpl.php');

try {
	$categoryData = erLhcoreClassModelArticleCategory::fetch((int)$Params['user_parameters']['category_id']);
} catch (Exception $e) {
	erLhcoreClassModule::redirect('lharticleadmin/managecategories');
	exit();
}

$articleData = new erLhcoreClassModelArticle();

$_SESSION['has_access_to_editor'] = 1;

if ( isset($_POST['cancelArticleAction']) ) {
 	erLhcoreClassModule::redirect('articleadmin/managecategories','/'.$articleData->category_id);
	exit;
}

if (isset($_POST['saveArticleAction'])) {

	$errors = erLhcoreClassModelArticle::validateInput($articleData);

	if (empty($errors)) {
		
		$articleData->category_id = $categoryData->id;
		$articleData->category_id_parent = ($categoryData->parent) ? $categoryData->parent->id : 0;
		$articleData->mtime = time();
		
 		$articleData->saveThis();

 		erLhcoreClassModule::redirect('articleadmin/managecategories','/'.$categoryData->id);
 		exit;
 		
	} else {
		$tpl->set('errors',$errors);
	}
}

$tpl->set('categoryData',$categoryData);
$tpl->set('articleData',$articleData);

$Result['content'] = $tpl->fetch();
$Result['path'] = array(
	array('url' => __url('articleadmin/managecategories').'/'.$categoryData->id,'title' => __t('articleadmin/list','Articles')),
	array('title' =>  __t('articleadmin/new','New article'))
);