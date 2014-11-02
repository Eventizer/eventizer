<?php

$tpl = erLhcoreClassTemplate::getInstance( 'lharticle/new.tpl.php');

try {
	$categoryData = erLhcoreClassModelArticleCategory::fetch((int)$Params['user_parameters']['category_id']);
} catch (Exception $e) {
	erLhcoreClassModule::redirect('lharticle/managecategories');
	exit();
}

$articleData = new erLhcoreClassModelArticle();

$_SESSION['has_access_to_editor'] = 1;

if ( isset($_POST['cancelArticleAction']) ) {
 	erLhcoreClassModule::redirect('article/managecategories','/'.$articleData->category_id);
	exit;
}

if (isset($_POST['saveArticleAction'])) {

	$errors = erLhcoreClassModelArticle::validateInput($articleData);

	if (empty($errors)) {
		
		$articleData->category_id = $categoryData->id;
		$articleData->category_id_parent = ($categoryData->parent) ? $categoryData->parent->id : 0;
		$articleData->mtime = time();
		
 		$articleData->saveThis();

 		erLhcoreClassModule::redirect('article/managecategories','/'.$categoryData->id);
 		exit;
 		
	} else {
		$tpl->set('errors',$errors);
	}
}

$tpl->set('categoryData',$categoryData);
$tpl->set('articleData',$articleData);

$Result['content'] = $tpl->fetch();
$Result['path'] = array(
	array('url' => __url('article/managecategories').'/'.$categoryData->id,'title' => __t('article/list','Articles')),
	array('title' =>  __t('article/new','New article'))
);
$Result['menu'] = 'articles';
$Result['title'] = array(
	'title' => __t('article/newarticle',  'Article'),
	'small_title' => __t('article/newarticle', 'Create new article')
);