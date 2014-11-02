<?php

$tpl = erLhcoreClassTemplate::getInstance( 'lhuser/new.tpl.php');

$userData = new erLhcoreClassModelUser();

if ( isset($_POST['cancelAction']) ) {
	erLhcoreClassModule::redirect('user/list');
	exit;
}

if (isset($_POST['saveAction'])) {
	    
	$errors = erLhcoreClassModelUser::validateInput($userData);
	
	$errorsAdmin = erLhcoreClassModelUser::validateInputAdmin($userData);
    
	$errors = array_merge($errors,$errorsAdmin);
    	
    if (count($errors) == 0) {
    	  
		$userData->saveThis();                        
                
		foreach ($userData->user_groups_id as $group_id) {
        	$groupUser = new erLhcoreClassModelGroupUser();
        	$groupUser->group_id = $group_id;
        	$groupUser->user_id = $userData->id;
        	$groupUser->saveThis();
        }
        
        erLhcoreClassModule::redirect('user/list');
        exit;
        
    }  else {
        $tpl->set('errors',$errors);
    }
}

$tpl->set('userData',$userData);

$Result['title'] = array('title' => __t('users/new','New user'),
    'small_title' => ''
);
$Result['submenu_active'] = 'users';
$Result['menu'] = 'settings';
$Result['subsubmenu'] = 'users';
$Result['content'] = $tpl->fetch();

$Result['path'] = array(
	array('url' => __url('system/configuration'),'title' => __t('user/new','System configuration')),
	array('url' => __url('user/list'),'title' => __t('user/new','Users')),
	array('title' => __t('user/new','New user'))
)

?>