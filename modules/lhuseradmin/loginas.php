<?php

$user_id = (int)$Params['user_parameters']['user_id'];

try {
	$userData = erLhcoreClassModelUser::fetch($user_id);
} catch (Exception $e) {
	erLhcoreClassModule::redirect('/');
}

erLhcoreClassUser::instance()->setLoggedUserInstantlyFromAdmin($userData->id,'eng');

header('Location: /');
exit;
?>