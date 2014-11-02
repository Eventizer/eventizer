<?php

if (!erLhcoreClassUser::instance()->validateCSFRToken($Params['user_parameters_unordered']['csfr'])) {
	erLhcoreClassModule::redirect('kernel/csrf-missing');
}

try {
	
 	$userData = erLhcoreClassModelUser::fetch((int)$Params['user_parameters']['user_id']);
 	
 	if($userData->system == 0) {
 		$userData->removeThis();
 	}
 	
 } catch (Exception $e) { 	
 	erLhcoreClassModule::redirect('user/list');
 	exit(); 	
}

erLhcoreClassModule::redirect('user/list');
exit;

?>