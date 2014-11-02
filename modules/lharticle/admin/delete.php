<?php

if (!erLhcoreClassUser::instance()->validateCSFRToken($Params['user_parameters_unordered']['csfr'])) {
	erLhcoreClassModule::redirect('kernel/csrf-missing');
}

try {
	$articleData = erLhcoreClassModelArticle::fetch((int)$Params['user_parameters']['article_id']);
} catch (Exception $e) {
	erLhcoreClassModule::redirect('article/managecategories');
	exit();
}

$articleData->removeThis();

header('Location: ' . $_SERVER['HTTP_REFERER']);
exit;