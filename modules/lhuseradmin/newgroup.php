<?php

$tpl = erLhcoreClassTemplate::getInstance( 'lhuseradmin/newgroup.tpl.php');

$groupData = new erLhcoreClassModelGroup();

if ( isset($_POST['cancelAction']) ) {
	erLhcoreClassModule::redirect('useradmin/grouplist');
	exit;
}

if (isset($_POST['saveAction'])) {
	    
	$errors = erLhcoreClassModelGroup::validateInput($groupData);
		
	if (count($errors) == 0) {
		 
		$groupData->saveThis();
						
		erLhcoreClassModule::redirect('useradmin/editgroup','/'.$groupData->id);
			
	}  else {
		$tpl->set('errors',$errors);
	}
	
}

$tpl->set('groupData',$groupData);

$Result['title'] = __t('user/newgroup','New group');
$Result['submenu_active'] = 'users';
$Result['menu'] = 'settings';
$Result['subsubmenu'] = 'users';

$Result['content'] = $tpl->fetch();

$Result['path'] = array(
	array('url' => __url('system/configuration'),'title' => __t('user/newgroup','System configuration')),
	array('url' => __url('useradmin/grouplist'),'title' => __t('user/newgroup','Groups')),
	array('title' => __t('user/newgroup','New group'))
)

?>