<?php
$tpl = erLhcoreClassTemplate::getInstance( 'lharticleadmin/newcategory.tpl.php');

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
    erLhcoreClassModule::redirect('articleadmin/managecategories');
    exit;
}           
        
if (isset($_POST['saveCategoryAction'])) {
	
	$errors = erLhcoreClassModelArticleCategory::validateInput($categoryData);
	
 	if (empty($errors)) { 	
 		 		 	
        $categoryData->saveThis();
        
        $urlappend = '';
        
        if ($categoryData->parent_id > 0) {
            $urlappend = '/'.$categoryData->parent_id;
        }
        
        erLhcoreClassModule::redirect('articleadmin/managecategories',$urlappend);
        exit; 
        	       
	} else {
    	$tpl->set('errors',$errors);
	}
}

$tpl->set('category_id',$category_id);
$tpl->set('categoryParentData',$categoryParentData);
$tpl->set('categoryData',$categoryData);

$Result['path'] = array();

if ($category_id > 0){
    $Result['path'][] = array('url' => erLhcoreClassDesign::baseurl('articleadmin/managecategories/').$categoryParentData->id,'title' => $categoryParentData->name);
}

$Result['path'][] = array('title' => 'New category');
$Result['content'] = $tpl->fetch();

?>