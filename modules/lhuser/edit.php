<?php

$tpl = erLhcoreClassTemplate::getInstance('lhuser/edit.tpl.php');

$UserData = erLhcoreClassUser::getSession()->load( 'erLhcoreClassModelUser', (int)$Params['user_parameters']['user_id'] );

if (isset($_POST['Update_account']) || isset($_POST['Save_account']))
{
   $definition = array(
        'Password' => new ezcInputFormDefinitionElement(
            ezcInputFormDefinitionElement::OPTIONAL, 'unsafe_raw'
        ),
        'Password1' => new ezcInputFormDefinitionElement(
            ezcInputFormDefinitionElement::OPTIONAL, 'unsafe_raw'
        ),
        'Email' => new ezcInputFormDefinitionElement(
            ezcInputFormDefinitionElement::OPTIONAL, 'validate_email'
        ),
        'Name' => new ezcInputFormDefinitionElement(
            ezcInputFormDefinitionElement::OPTIONAL, 'unsafe_raw'
        ),
        'Surname' => new ezcInputFormDefinitionElement(
            ezcInputFormDefinitionElement::OPTIONAL, 'unsafe_raw'
        ),
        'Username' => new ezcInputFormDefinitionElement(
            ezcInputFormDefinitionElement::OPTIONAL, 'unsafe_raw'
        ),
   		'JobTitle' => new ezcInputFormDefinitionElement(
   				ezcInputFormDefinitionElement::OPTIONAL, 'unsafe_raw'
   		),
        'Skype' => new ezcInputFormDefinitionElement(
            ezcInputFormDefinitionElement::OPTIONAL, 'unsafe_raw'
        ),
        'XMPPUsername' => new ezcInputFormDefinitionElement(
            ezcInputFormDefinitionElement::OPTIONAL, 'unsafe_raw'
        ),
        'UserTimeZone' => new ezcInputFormDefinitionElement(
            ezcInputFormDefinitionElement::OPTIONAL, 'unsafe_raw'
        ),
		'UserDisabled' => new ezcInputFormDefinitionElement(
				ezcInputFormDefinitionElement::OPTIONAL, 'boolean'
		),
		'HideMyStatus' => new ezcInputFormDefinitionElement(
				ezcInputFormDefinitionElement::OPTIONAL, 'boolean'
		),
		'UserInvisible' => new ezcInputFormDefinitionElement(
				ezcInputFormDefinitionElement::OPTIONAL, 'boolean'
		),
		'DefaultGroup' => new ezcInputFormDefinitionElement(
				ezcInputFormDefinitionElement::OPTIONAL, 'int',
				null,
				FILTER_REQUIRE_ARRAY
		)
    );

    if (!isset($_POST['csfr_token']) || !$currentUser->validateCSFRToken($_POST['csfr_token'])) {
   		erLhcoreClassModule::redirect('user/userlist');
   		exit;
    }

    $form = new ezcInputForm( INPUT_POST, $definition );
    $Errors = array();

    if ( !$form->hasValidData( 'Username' ) ) {
        $Errors[] =  erTranslationClassLhTranslation::getInstance()->getTranslation('user/account','Please enter a username!');
    }  elseif ( $form->hasValidData( 'Username' ) && $form->Username != $UserData->username && !erLhcoreClassModelUser::userExists($form->Username) ) {
    	$UserData->username = $form->Username;
    } elseif ( $form->hasValidData( 'Username' ) && $form->Username != $UserData->username) {
    	$Errors[] =  erTranslationClassLhTranslation::getInstance()->getTranslation('user/account','User exists!');
    }

    if ( !$form->hasValidData( 'Email' ) )
    {
        $Errors[] =  erTranslationClassLhTranslation::getInstance()->getTranslation('user/edit','Wrong email address');
    }

    if ( !$form->hasValidData( 'Name' ) || $form->Name == '' )
    {
        $Errors[] =  erTranslationClassLhTranslation::getInstance()->getTranslation('user/edit','Please enter a name');
    }

    if ( $form->hasValidData( 'Surname' ) && $form->Surname != '')
    {
        $UserData->surname = $form->Surname;
    } else {
    	$UserData->surname = '';
    }

	if ( $form->hasValidData( 'UserTimeZone' ) && $form->UserTimeZone != '')
    {
    	$UserData->time_zone = $form->UserTimeZone;
    } else {
    	$UserData->time_zone = '';
    }
    
    if ( $form->hasValidData( 'Skype' ) && $form->Skype != '')
    {
    	$UserData->skype = $form->Skype;
    } else {
    	$UserData->skype = '';
    }
    
    if ( $form->hasValidData( 'XMPPUsername' ) && $form->XMPPUsername != '')
    {
    	$UserData->xmpp_username = $form->XMPPUsername;
    } else {
    	$UserData->xmpp_username = '';
    }
    
    if ( $form->hasValidData( 'UserInvisible' ) && $form->UserInvisible == true ) {
    	$UserData->invisible_mode = 1;
    } else {
    	$UserData->invisible_mode = 0;
    }
    
    if ( $form->hasValidData( 'JobTitle' ) && $form->JobTitle != '')
    {
    	$UserData->job_title = $form->JobTitle;
    } else {
    	$UserData->job_title = '';
    }
    
    if ( $form->hasInputField( 'Password' ) && (!$form->hasInputField( 'Password1' ) || $form->Password != $form->Password1  ) ) // check for optional field
    {
        $Errors[] =  erTranslationClassLhTranslation::getInstance()->getTranslation('user/edit','Passwords mismatch');
    }

    if ( $form->hasValidData( 'DefaultGroup' ) ) {
    	$UserData->user_groups_id = $form->DefaultGroup;
    } else {
    	$Errors[] =  erTranslationClassLhTranslation::getInstance()->getTranslation('user/new','Please choose a default user group');
    }

    if ( $form->hasValidData( 'UserDisabled' ) && $form->UserDisabled == true )
    {
    	$UserData->disabled = 1;
    } else {
    	$UserData->disabled = 0;
    }

    if ( $form->hasValidData( 'HideMyStatus' ) && $form->HideMyStatus == true )
    {
    	$UserData->hide_online = 1;
    } else {
    	$UserData->hide_online = 0;
    }

    if ( isset($_POST['DeletePhoto']) ) {
    	$UserData->removeFile();
    }

    if ( isset($_FILES["UserPhoto"]) && is_uploaded_file($_FILES["UserPhoto"]["tmp_name"]) && $_FILES["UserPhoto"]["error"] == 0 && erLhcoreClassImageConverter::isPhoto('UserPhoto') ) {
    	$UserData->removeFile();

    	$dir = 'var/userphoto/' . date('Y') . 'y/' . date('m') . '/' . date('d') .'/' . $UserData->id . '/';
    	
    	erLhcoreClassChatEventDispatcher::getInstance()->dispatch('user.edit.photo_path', array('dir' => & $dir, 'storage_id' => $UserData->id));
    	
    	erLhcoreClassFileUpload::mkdirRecursive( $dir );

    	$file = qqFileUploader::upload($_FILES,'UserPhoto',$dir);

    	if ( !empty($file["errors"]) ) {
    		foreach ($file["errors"] as $err) {
    			$Errors[] = $err;
    		}
    	} else {

    		$UserData->removeFile();
    		$UserData->filename           = $file["data"]["filename"];
    		$UserData->filepath           = $file["data"]["dir"];

    		erLhcoreClassImageConverter::getInstance()->converter->transform( 'photow_150', $UserData->file_path_server, $UserData->file_path_server );
    		chmod($UserData->file_path_server, 0644);
    	}
    }

    if (count($Errors) == 0)
    {
        // Update password if neccesary
        if ($form->hasInputField( 'Password' ) && $form->hasInputField( 'Password1' ) && $form->Password != '')
        {
            $UserData->setPassword($form->Password);
        }

        $UserData->email   = $form->Email;
        $UserData->name    = $form->Name;


        erLhcoreClassUser::getSession()->update($UserData);

        erLhcoreClassUserDep::setHideOnlineStatus($UserData);

        erLhcoreClassModelGroupUser::removeUserFromGroups($UserData->id);

        foreach ($UserData->user_groups_id as $group_id) {
        	$groupUser = new erLhcoreClassModelGroupUser();
        	$groupUser->group_id = $group_id;
        	$groupUser->user_id = $UserData->id;
        	$groupUser->saveThis();
        }

        $CacheManager = erConfigClassLhCacheConfig::getInstance();
        $CacheManager->expireCache();

        if (isset($_POST['Save_account'])) {
            erLhcoreClassModule::redirect('user/userlist');
            exit;
        } else {
            $tpl->set('updated',true);
        }

    }  else {
        $tpl->set('errors',$Errors);
    }
}


if (isset($_POST['UpdatePending_account']))
{
	if (!isset($_POST['csfr_token']) || !$currentUser->validateCSFRToken($_POST['csfr_token'])) {
		erLhcoreClassModule::redirect('user/account');
		exit;
	}

	$definition = array(
			'showAllPendingEnabled' => new ezcInputFormDefinitionElement(
					ezcInputFormDefinitionElement::OPTIONAL, 'boolean'
			)
	);

	$form = new ezcInputForm( INPUT_POST, $definition );
	$Errors = array();

	if ( $form->hasValidData( 'showAllPendingEnabled' ) && $form->showAllPendingEnabled == true )
	{
		erLhcoreClassModelUserSetting::setSetting('show_all_pending',1,$UserData->id);
	} else {
		erLhcoreClassModelUserSetting::setSetting('show_all_pending',0,$UserData->id);
	}

	$tpl->set('account_updated','done');
	$tpl->set('tab','tab_pending');
}


if (isset($_POST['UpdateDepartaments_account']))
{
	if (!isset($_POST['csfr_token']) || !$currentUser->validateCSFRToken($_POST['csfr_token'])) {
		erLhcoreClassModule::redirect('user/userlist');
		exit;
	}

   $globalDepartament = array();
   if (isset($_POST['all_departments']) && $_POST['all_departments'] == 'on') {
       $UserData->all_departments = 1;
       $globalDepartament[] = 0;
   } else {
       $UserData->all_departments = 0;
       $globalDepartament[] = -1;
   }

   erLhcoreClassUser::getSession()->update($UserData);

   if (isset($_POST['UserDepartament']) && count($_POST['UserDepartament']) > 0)
   {
       $globalDepartament = array_merge($_POST['UserDepartament'],$globalDepartament);
   }

   if (count($globalDepartament) > 0)
   {
       erLhcoreClassUserDep::addUserDepartaments($globalDepartament,$Params['user_parameters']['user_id'],$UserData);
   } else {
       erLhcoreClassUserDep::addUserDepartaments(array(),$Params['user_parameters']['user_id'],$UserData);
   }

   $tpl->set('account_updated_departaments','done');
}


$tpl->set('user',$UserData);

$Result['content'] = $tpl->fetch();

$Result['path'] = array(
array('url' => erLhcoreClassDesign::baseurl('system/configuration'),'title' => erTranslationClassLhTranslation::getInstance()->getTranslation('user/edit','System configuration')),
array('url' => erLhcoreClassDesign::baseurl('user/userlist'),'title' => erTranslationClassLhTranslation::getInstance()->getTranslation('user/edit','Users')),
array('title' => erTranslationClassLhTranslation::getInstance()->getTranslation('user/edit','User edit').' - '.$UserData->name.' '.$UserData->surname));

?>