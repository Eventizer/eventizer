<?php

if (!$currentUser->validateCSFRToken($Params['user_parameters_unordered']['csfr'])) {
	die('Invalid CSFR Token');
	exit;
}


try {
	$data = erLhcoreClassModelEvents::fetch((int)$Params['user_parameters']['id']);
} catch (Exception $e) {
	erLhcoreClassModule::redirect('event/events');
	exit();
}

$data->removeThis();

header('Location: ' . $_SERVER['HTTP_REFERER']);
exit;