<?php

if (!erLhcoreClassUser::instance()->validateCSFRToken($Params['user_parameters_unordered']['csfr'])) {
	erLhcoreClassModule::redirect('kernel/csrf-missing');
}

try {
	$categoryData = erLhcoreClassModelArticleCategory::fetch((int)$Params['user_parameters']['category_id']);
} catch (Exception $e) {
	erLhcoreClassModule::redirect('lharticleadmin/managecategories');
	exit();
}

$categoryData->removeThis();

header('Location: ' . $_SERVER['HTTP_REFERER']);
exit;