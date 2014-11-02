<?php

$tpl = erLhcoreClassTemplate::getInstance('lharticle/managecategories.tpl.php');

$category_id = (int) $Params['user_parameters']['category_id'];
if ($category_id > 0) {
	$category = erLhcoreClassModelArticleCategory::fetch($category_id);
} else {
	$category = new erLhcoreClassModelArticleCategory();
}

$category_new = new erLhcoreClassModelArticleCategory();
$category_new->parent_id = $category_id;

$pages = new lhPaginator();
$pages->serverURL = erLhcoreClassDesign::baseurl('articleadmin/managecategories') . '/' . $category->id;
$pages->items_total = erLhcoreClassModelArticle::getCount(array(
	'filter' => array(
		'category_id' => $category->id
	)
));
$pages->setItemsPerPage(10);
$pages->paginate();

$list = array();
if ($pages->items_total > 0) {
	$list = erLhcoreClassModelArticle::getList(array(
		'filter' => array(
			'category_id' => $category->id
		),
		'offset' => $pages->low,
		'limit' => $pages->items_per_page
	));
}

$tpl->set('category', $category);
$tpl->set('list', $list);
$tpl->set('pages', $pages);
$Result['content'] = $tpl->fetch();

$Result['path'] = array(
	array(
		'url' => __url('article/managecategories'),
		'title' => __t('article/managecategories', 'Manage categories')
	)
);

if ($category->parent_id > 0) {
	$Result['path'][] = array(
		'url' => __url('articleadmin/managecategories') . '/' . $category->parent_id,
		'title' => $category->parent->name
	);
}
;

$Result['menu'] = 'articles';
$Result['title'] = array(
	'title' => erTranslationClassLhTranslation::getInstance()->getTranslation('article/managecategories',  'Articles'),
	'small_title' => __t('article/managecategories', 'Manage article categories')
);

?>