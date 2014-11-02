<?php

$tpl = erLhcoreClassTemplate::getInstance( 'lhuser/registration.tpl.php');

$userData = new erLhcoreClassModelUser();

if (isset($_POST['registerAction'])) { 

	$Errors = erLhcoreClassModelUser::validateInputRegistration( $userData );
	
	if (count($Errors) == 0) {  
		$userData->saveUser();
		
		$userData = new erLhcoreClassModelUser();
		
		$tpl->set('alertSuccessAction', __t('user/account','Account registered'));
		
    } else {   
        $tpl->set('errors',$Errors);
    }
}

$tpl->set('userData',$userData);

$Result['content'] = $tpl->fetch();

?>