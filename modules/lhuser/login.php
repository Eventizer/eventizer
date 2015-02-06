<?php

$currentUser = erLhcoreClassUser::instance();

$instance = erLhcoreClassSystem::instance();


$tpl = erLhcoreClassTemplate::getInstance( 'lhuser/login.tpl.php');

$redirect = '';
if (isset($_POST['redirect'])){
	$redirect = $_POST['redirect'];
	$tpl->set('redirect_url',$redirect);
} else {
	$redirect = rawurldecode($Params['user_parameters_unordered']['r']);
	$tpl->set('redirect_url',$redirect);
}

if (isset($_POST['Login']))
{    
    if (!$currentUser->authenticate($_POST['Username'], $_POST['Password'], isset($_POST['rememberMe']) && $_POST['rememberMe'] == 1 ? true : false))
    {
        $Error = erTranslationClassLhTranslation::getInstance()->getTranslation('user/login','Incorrect User ID or password');
        $tpl->set('errors',array($Error));
    } else {
    	if ($redirect != '') {
    		erLhcoreClassModule::redirect(base64_decode($redirect));
    	} else {
	        erLhcoreClassModule::redirect();
	        exit;
    	}
    }
}

$pagelayout = erConfigClassLhConfig::getInstance()->getOverrideValue('site','login_pagelayout');
if ($pagelayout != null)
    $Result['pagelayout'] = 'login';

$Result['content'] = $tpl->fetch();