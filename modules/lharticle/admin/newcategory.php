<?php
$tpl = erLhcoreClassTemplate::getInstance( 'lharticle/newcategory.tpl.php');

$category_id = (int)$Params['user_parameters']['category_id'];

if ( $category_id > 0 ) {
    $categoryParentData = erLhcoreClassModelArticleCategory::fetch($category_id);
} else {
    $categoryParentData = new erLhcoreClassModelArticleCategory();
}

$categoryData = new erLhcoreClassModelArticleCategory();
$categoryData->parent_id = $category_id;

$_SESSION['has_access_to_editor'] = 1;

if ( isset($_POST['cancelCategoryAction']) ) {        
    erLhcoreClassModule::redirect('article/managecategories');
    exit;
}           
        
if (isset($_POST['saveCategoryAction'])) {
	if (!isset($_POST['csfr_token']) || !erLhcoreClassUser::instance()->validateCSFRToken($_POST['csfr_token'])) {
			erLhcoreClassModule::redirect('kernel/csrf-missing');
			exit;
	}
		
	$errors = erLhcoreClassModelArticleCategory::validateInput($categoryData);
	
 	if (empty($errors)) { 	
 		 		 	
        $categoryData->saveThis();
        
        $urlappend = '';
        
        if ($categoryData->parent_id > 0) {
            $urlappend = '/'.$categoryData->parent_id;
        }
        
        erLhcoreClassModule::redirect('article/managecategories',$urlappend);
        exit; 
        	       
	} else {
    	$tpl->set('errors',$errors);
	}
}

$tpl->set('category_id',$category_id);
$tpl->set('categoryParentData',$categoryParentData);
$tpl->set('categoryData',$categoryData);

$Result['path'] = array();

$Result['path'] = array(
	array('url' => __url('article/managecategories'),'title' => __t('article/newcategory', 'Manage categories')),
	array('title' => __t('article/newcategory', 'New category'))
	
);

if ($category_id > 0){
    $Result['path'][] = array('url' => erLhcoreClassDesign::baseurl('article/managecategories/').$categoryParentData->id,'title' => $categoryParentData->name);
}

$Result['content'] = $tpl->fetch();
$Result['menu'] = 'articles';
$Result['title'] = array(
	'title' => __t('article/newcategory',  'Category'),
	'small_title' => __t('article/newcategory', 'Create new category')
);

?>