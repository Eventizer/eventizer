<?php

if(erLhcoreClassUser::instance()->isLogged()) {
	erLhcoreClassModule::redirect('/');
}

$tpl = erLhcoreClassTemplate::getInstance( 'lhuser/activate.tpl.php');

$userData = erLhcoreClassModelUser::checkActivateHash($Params['user_parameters']['hash']);

if ( $userData) {					
	$userData->setUserActive();		 		
}	

$tpl->set('userData',$userData);

$Result['content'] = $tpl->fetch();

$Result['path'] = array(
	array('title' => __t('user/activate','Activate account')),
);

?>