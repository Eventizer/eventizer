<?php
$tpl = new erLhcoreClassTemplate('lharticle/category.tpl.php');

$categoryData = erLhcoreClassModelArticleCategory::fetch((int) $Params['user_parameters']['category_id']);

if ($categoryData != false) {
    $filter = array(
        'filter' => array(
            'category_id' => $categoryData->id
        )
    );
    
    $pages = new lhPaginator();
    $pages->serverURL = $categoryData->url_path;
    $pages->items_total = erLhcoreClassModelArticle::getCount($filter);
    $pages->setItemsPerPage(2);
    $pages->paginate();
    
    if ($pages->items_total > 0) {
        $tpl->set('items', erLhcoreClassModelArticle::getList(array_merge($filter, array(
            'offset' => $pages->low,
            'limit' => $pages->items_per_page
        ))));
    }
    
    $tpl->set('pages', $pages);
    $tpl->set('categoryData', $categoryData);
    
    $Result['sidebartype'] = 'right';
    
    $Result['content'] = $tpl->fetch();
    $Result['path'] = array(
        array(
            'title' => $categoryData->name
        )
    );
    $Result['path_base'] = $categoryData->url_path_base;
} else {
     $Result = erLhcoreClassModule::Error404();
}

?>