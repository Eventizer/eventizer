<?php

$tpl = erLhcoreClassTemplate::getInstance( 'lhuser/changepassword.tpl.php' );

$userData = erLhcoreClassUser::instance()->getUserData();

if (isset($_POST['updateAction'])) {

	$errors = erLhcoreClassValidateUsers::validatePassword($userData);
	
    if (count($errors) == 0) {

        $userData->updateThis();
        
        $tpl->set('alertSuccessAction', __t('user/account','Password updated'));

    }  else {
        $tpl->set('errors',$errors);
    }
}


$tpl->set('userData',$userData);

$Result['title'] = array('title' =>__t('users/edit','Change password'),
);
$Result['sidebartype'] = 'left';
$Result['active'] = 'pass';
$Result['sidebar'] = 'account';
$Result['content'] = $tpl->fetch();
$Result['path'] = array(
	array('title' => __t('user/account','Change password'))
);

?>