<?php
$tpl = erLhcoreClassTemplate::getInstance( 'lharticle/editcategory.tpl.php');

try {
	$categoryData = erLhcoreClassModelArticleCategory::fetch((int)$Params['user_parameters']['category_id']);  
} catch (Exception $e) {
	erLhcoreClassModule::redirect('lharticle/managecategories');
	exit();
}



if ( isset($_POST['cancelCategoryAction']) ) {
	erLhcoreClassModule::redirect('article/managecategories');
	exit;
}

$_SESSION['has_access_to_editor'] = 1;

if (isset($_POST['saveCategoryAction']) || isset($_POST['updateCategoryAction'])) {
	
	$errors = erLhcoreClassModelArticleCategory::validateInput($categoryData);
	
	if (empty($errors)) {
		
		$categoryData->updateThis();
		
		if (isset($_POST['saveCategoryAction'])) { 
              
            $append = ''; 
                
            if ($categoryData->parent_id > 0) {
                $append = '/'.$categoryData->id;
            }
            
            erLhcoreClassModule::redirect('article/managecategories',$append);
            exit;
        } else {
            $tpl->set('alertSuccessAction', __t('system/message','Updated'));
        }
        
        $categoryData = erLhcoreClassModelArticleCategory::fetch($categoryData->id);
		
	} else {
		$tpl->set('errors',$errors);
	}
}

$tpl->set('categoryData',$categoryData);

$Result['path'] = array();
$Result['path'][] = array('url' => __url('article/managecategories'), 'title' => __t('article/managecategories','Manage categories'));
$Result['path'][] = array('title' => 'Edit category');
$Result['content'] = $tpl->fetch();
$Result['menu'] = 'articles';
$Result['title'] = array(
	'title' => $categoryData->name,
	'small_title' => __t('article/editcategory', 'Category edit')
);

?>