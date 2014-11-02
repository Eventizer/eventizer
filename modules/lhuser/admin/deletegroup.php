<?php

if (!erLhcoreClassUser::instance()->validateCSFRToken($Params['user_parameters_unordered']['csfr'])) {
	erLhcoreClassModule::redirect('kernel/csrf-missing');
}

try {

	$groupData = erLhcoreClassModelGroup::fetch((int)$Params['user_parameters']['group_id']);

	if($groupData->system == 0) {
		$groupData->removeThis();
	}

} catch (Exception $e) {
	erLhcoreClassModule::redirect('user/grouplist');
	exit();
}

erLhcoreClassModule::redirect('user/grouplist');
exit;

?>