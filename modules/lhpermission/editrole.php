<?php

$tpl = erLhcoreClassTemplate::getInstance( 'lhpermission/editrole.tpl.php');

$Role = erLhcoreClassRole::getSession()->load( 'erLhcoreClassModelRole', (int)$Params['user_parameters']['role_id'] );

$Result['title'] = array('title'=>__t('permission/editrole','Role edit'));


if (isset($_POST['Cancel_role']))
{
    erLhcoreClassModule::redirect('permission/roles' );
    exit ;
}

if (isset($_POST['Update_role']))
{
   $definition = array(
        'Name' => new ezcInputFormDefinitionElement(
            ezcInputFormDefinitionElement::REQUIRED, 'unsafe_raw'
        )
    );

   if (!isset($_POST['csfr_token']) || !$currentUser->validateCSFRToken($_POST['csfr_token'])) {
   		erLhcoreClassModule::redirect();
   		exit;
   }

    $form = new ezcInputForm( INPUT_POST, $definition );
    $Errors = array();

    if ( !$form->hasValidData( 'Name' ) || $form->Name == '' )
    {
        $Errors[] =  erTranslationClassLhTranslation::getInstance()->getTranslation('permission/editrole','Please enter role name');
    }

    if (count($Errors) == 0)
    {
        $Role->name = $form->Name;



        erLhcoreClassRole::getSession()->update($Role);

        erLhcoreClassModule::redirect('permission/roles');
        exit ;

    }  else {
        $tpl->set('errors',$Errors);
    }
}

$tpl->set('role',$Role);

if (isset($_POST['New_policy']) || isset($_GET['newPolicy']))
{
    $tpl->setFile( 'lhpermission/newpolicy.tpl.php');
}


if (isset($_POST['Store_policy']))
{
    $definition = array(
        'Module' => new ezcInputFormDefinitionElement(
            ezcInputFormDefinitionElement::REQUIRED, 'string'
        ),
       'ModuleFunction' => new ezcInputFormDefinitionElement(
				ezcInputFormDefinitionElement::OPTIONAL, 'string'
				
		)
    );

    if (!isset($_POST['csfr_token']) || !$currentUser->validateCSFRToken($_POST['csfr_token'])) {
    	erLhcoreClassModule::redirect();
    	exit;
    }

    $form = new ezcInputForm( INPUT_POST, $definition );
    $Errors = array();

    if ( !$form->hasValidData( 'Module' ) || $form->Module == '' )
    {
        $Errors[] =  erTranslationClassLhTranslation::getInstance()->getTranslation('permission/editrole','Please choose module');
    }

    if ( !$form->hasValidData( 'ModuleFunction' ) || $form->ModuleFunction == '' )
    {
        $Errors[] =  erTranslationClassLhTranslation::getInstance()->getTranslation('permission/editrole','Please choose module function');
    }

    if (count($Errors) == 0)
    {
    		$RoleFunction = new erLhcoreClassModelRoleFunction();
    		$RoleFunction->role_id = $Role->id;
    		$RoleFunction->module = $form->Module;
    		$RoleFunction->function = $form->ModuleFunction;    		
    		erLhcoreClassRole::getSession()->save($RoleFunction);
            
    } else {
    	$tpl->set( 'errors', $Errors);
        $tpl->setFile( 'lhpermission/newpolicy.tpl.php');
    }
}

if (isset($_POST['Delete_policy']))
{
	if (!isset($_POST['csfr_token']) || !$currentUser->validateCSFRToken($_POST['csfr_token'])) {
		erLhcoreClassModule::redirect();
		exit;
	}

    if (isset($_POST['PolicyID']) && count($_POST['PolicyID']) > 0)
    {
        foreach ($_POST['PolicyID'] as $PolicyID)
        {
            erLhcoreClassRoleFunction::deleteRolePolicy($PolicyID);
        }
    } else {
    	$Errors[] =  erTranslationClassLhTranslation::getInstance()->getTranslation('permission/editrole','Select functions to remove');
    	$tpl->set( 'errorsAssignFunctions', $Errors);
    }
}

if (isset($_POST['Remove_group_from_role']))
{
	if(isset($_POST['AssignedID']) && count($_POST['AssignedID']) > 0) {
		if (!isset($_POST['csfr_token']) || !$currentUser->validateCSFRToken($_POST['csfr_token'])) {
			erLhcoreClassModule::redirect();
			exit;
		}
	
	    foreach ($_POST['AssignedID'] as $AssignedID)
	    {
	        erLhcoreClassGroupRole::deleteGroupRole($AssignedID);
	    }
    } else {
    	$Errors[] =  erTranslationClassLhTranslation::getInstance()->getTranslation('permission/editrole','Select roles to remove');
    	$tpl->set( 'errorsAssignUsers', $Errors);
    }
}

if (isset($_POST['AssignGroups'])  )
{
	if(isset($_POST['GroupID']) && count($_POST['GroupID']) > 0) {
		if (!isset($_POST['csfr_token']) || !$currentUser->validateCSFRToken($_POST['csfr_token'])) {
			erLhcoreClassModule::redirect();
			exit;
		}
	
	    foreach ($_POST['GroupID'] as $GroupID)
	    {
	        $GroupRole = new erLhcoreClassModelGroupRole();
	        $GroupRole->group_id =$GroupID;
	        $GroupRole->role_id = $Role->id;;
	        erLhcoreClassRole::getSession()->save($GroupRole);
	    }
	} else {
    	$Errors[] =  erTranslationClassLhTranslation::getInstance()->getTranslation('permission/editrole','Select roles to assign');
    	$tpl->set( 'errorsAssignUsers', $Errors);
    }
} 


$Result['submenu_active'] = 'users';
$Result['menu'] = 'settings';
$Result['subsubmenu'] = 'roles';
$Result ['content'] = $tpl->fetch ();

$Result['content'] = $tpl->fetch();

$Result['path'] = array(
array('url'=>erLhcoreClassDesign::baseurl('permission/roles'),'title' => erTranslationClassLhTranslation::getInstance()->getTranslation('permission/editrole','List of roles')),
array('title' => erTranslationClassLhTranslation::getInstance()->getTranslation('permission/editrole','Role edit').' - '.$Role->name)
)

?>