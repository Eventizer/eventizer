<?php

$tpl = erLhcoreClassTemplate::getInstance( 'lhuser/account.tpl.php' );

$userData = erLhcoreClassUser::instance()->getUserData();

if (isset($_POST['updateAction'])) {

	$errors = erLhcoreClassModelUser::validateInput($userData);
	
    if (count($errors) == 0) {

        $userData->updateThis();
        
        $tpl->set('alertSuccessAction', __t('user/account','Account updated'));

    }  else {
        $tpl->set('errors',$errors);
    }
}

if (!isset($userData)) {
    $userData = $currentUser->getUserData();
}

$tpl->set('userData',$userData);

$Result['content'] = $tpl->fetch();
$Result['title'] = __t('user/account','User account');
$Result['path'] = array(
	array('title' => __t('user/account','My account'))
);

?>