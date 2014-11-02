<?php

$tpl = erLhcoreClassTemplate::getInstance( 'lhuser/newgroup.tpl.php');

$groupData = new erLhcoreClassModelGroup();

if ( isset($_POST['cancelAction']) ) {
	erLhcoreClassModule::redirect('user/grouplist');
	exit;
}

if (isset($_POST['saveAction'])) {
	    
	$errors = erLhcoreClassModelGroup::validateInput($groupData);
		
	if (count($errors) == 0) {
		 
		$groupData->saveThis();
						
		erLhcoreClassModule::redirect('user/editgroup','/'.$groupData->id);
			
	}  else {
		$tpl->set('errors',$errors);
	}
	
}

$tpl->set('groupData',$groupData);

$Result['title'] = array('title'=>__t('user/newgroup','New group'),
    'submenu_active' => 'users'
);
$Result['menu'] = 'settings';
$Result['subsubmenu'] = 'groups';

$Result['content'] = $tpl->fetch();

$Result['path'] = array(
	array('url' => __url('system/configuration'),'title' => __t('user/newgroup','System configuration')),
	array('url' => __url('user/grouplist'),'title' => __t('user/newgroup','Groups')),
	array('title' => __t('user/newgroup','New group'))
)

?>