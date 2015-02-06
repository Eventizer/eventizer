<?php

$tpl = erLhcoreClassTemplate::getInstance( 'lhuser/account.tpl.php' );

$userData = erLhcoreClassUser::instance()->getUserData();

if (isset($_POST['updateAction'])) {

	$errors = erLhcoreClassValidateUsers::validateInput($userData);
	
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

$Result['title'] = array('title' =>__t('users/edit','User edit'),
    'small_title' => $userData->name.' '.$userData->surname
);
$Result['sidebartype'] = 'left';
$Result['content'] = $tpl->fetch();
$Result['path'] = array(
	array('title' => __t('user/account','My account'))
);

?>