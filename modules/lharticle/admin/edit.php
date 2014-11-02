<?php

$tpl = erLhcoreClassTemplate::getInstance( 'lharticle/edit.tpl.php');

try {
	$articleData = erLhcoreClassModelArticle::fetch((int)$Params['user_parameters']['article_id']);
} catch (Exception $e) {
	erLhcoreClassModule::redirect('lharticle/managecategories');
	exit();
}

$_SESSION['has_access_to_editor'] = 1;

if ( isset($_POST['cancelArticleAction']) ) {
	erLhcoreClassModule::redirect('article/managecategories','/'.$articleData->category_id);
	exit;
}

if (isset($_POST['saveArticleAction']) || isset($_POST['updateArticleAction'])) {

	$errors = erLhcoreClassModelArticle::validateInput($articleData);

	if (empty($errors)) {
		
		$articleData->updateThis();
        
        if (isset($_POST['saveArticleAction'])) {        
        	erLhcoreClassModule::redirect('article/managecategories','/'.$articleData->category_id);
            exit;
        } else {
            $tpl->set('alertSuccessAction', __t('system/message','Updated'));
		}
		
		$articleData = erLhcoreClassModelArticle::fetch($articleData->id);

	} else {
		$tpl->set('errors',$errors);
	}
        
}

$tpl->set('articleData',$articleData);

$Result['content'] = $tpl->fetch();

$Result['path'] = array(
	array('url' => __url('article/managecategories').'/'.$articleData->category->id,'title' => $articleData->category->name),
	array('title' => $articleData->name)
);

$Result['menu'] = 'articles';
$Result['title'] = array(
	'title' => $articleData->name,
	'small_title' => __t('article/newarticle', 'Article edit')
);

?>