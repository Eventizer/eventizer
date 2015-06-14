<?php

$tpl = erLhcoreClassTemplate::getInstance('lhuser/edit.tpl.php');

try {
	$userData = erLhcoreClassModelUser::fetch((int)$Params['user_parameters']['user_id']);
} catch (Exception $e) {
	erLhcoreClassModule::redirect('user/list');
}

if ( isset($_POST['cancelAction']) ) {
	erLhcoreClassModule::redirect('user/list');
	exit;
}

if (isset($_POST['saveAction']) || isset($_POST['updateAction'])) {

	$errors = erLhcoreClassValidateUsers::validateInput($userData);
	
	$errorsAdmin = erLhcoreClassModelUser::validateInputAdmin($userData);
    
	$errors = array_merge($errors,$errorsAdmin);
	
    if (count($errors) == 0) {
    	
        $userData->updateThis();

        erLhcoreClassModelGroupUser::removeUserFromGroups($userData->id);

        foreach ($userData->user_groups_id as $group_id) {
        	$groupUser = new erLhcoreClassModelGroupUser();
        	$groupUser->group_id = $group_id;
        	$groupUser->user_id = $userData->id;
        	$groupUser->saveThis();
        }

        if (isset($_POST['saveAction'])) {
            erLhcoreClassModule::redirect('user/list');
            exit;
        } else {
        	$userData = erLhcoreClassModelUser::fetch($userData->id);
			$tpl->set('alertSuccessAction', __t('user/account','Account updated'));
        }

    }  else {
        $tpl->set('errors',$errors);
    }
}

$tpl->set('userData',$userData);

$Result['title'] = array('title' =>__t('users/edit','User edit'),
    'small_title' => $userData->name.' '.$userData->surname
);
$Result['submenu_active'] = 'users';
$Result['menu'] = 'settings';
$Result['subsubmenu'] = 'users';
$Result['sidemenu_data']['user'] = $userData;
$Result['content'] = $tpl->fetch();

$Result['path'] = array(
	array('url' => __url('user/list'),'title' => __t('user/edit','Users')),
	array('title' => __t('user/edit','User edit').' - '.$userData->name.' '.$userData->surname));

?>