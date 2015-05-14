<?php

$tpl = erLhcoreClassTemplate::getInstance( 'lhuser/registration.tpl.php');
$destination = $Params['user_parameters_unordered']['d'];
$userData = new erLhcoreClassModelUser();

if (isset($_POST['registerAction'])) { 

	$Errors = erLhcoreClassModelUser::validateInputRegistration( $userData );
	
	if (count($Errors) == 0) {
	    if ($destination != '') {  
		  $userData->redirect_url = $destination;
	    }
		$userData->saveUser();
		
		$tpl->set('alertSuccessAction', __t('user/account','Account registered, please check your email for registration confirmation'));
		
    } else {   
        $tpl->set('errors',$Errors);
    }
}

$tpl->set('redirect_url',$destination);
$tpl->set('userData',$userData);

$Result['content'] = $tpl->fetch();

?>