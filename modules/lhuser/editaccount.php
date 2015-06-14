<?php

$tpl = erLhcoreClassTemplate::getInstance( 'lhuser/editaccount.tpl.php' );

$userData = erLhcoreClassUser::instance()->getUserData(true);

if (isset($_POST['updateAction'])) {

	$errors = erLhcoreClassValidateUsers::validateInput($userData, false);
	
    if (count($errors) == 0) {

        $userData->updateThis();
        
        $tpl->set('alertSuccessAction', __t('user/account','Account updated'));

    }  else {
        $tpl->set('errors',$errors);
    }
}


$tpl->set('userData',$userData);

$Result['title'] = array('title' =>__t('users/edit','Account edit'),
);
$Result['sidebartype'] = 'left';
$Result['sidebar'] = 'account';
$Result['active'] = 'edit';
$Result['content'] = $tpl->fetch();
$Result['path'] = array(
	array('title' => __t('user/account','My account'))
);

?>