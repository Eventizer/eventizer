<?php
$tpl = erLhcoreClassTemplate::getInstance('lhuser/editgroup.tpl.php');

try {
    $groupData = erLhcoreClassModelGroup::fetch((int) $Params['user_parameters']['group_id']);
} catch (Exception $e) {
    erLhcoreClassModule::redirect('user/grouplist');
}

if (isset($_POST['cancelAction'])) {
    erLhcoreClassModule::redirect('user/grouplist');
    exit();
}

if (isset($_POST['saveAction']) || isset($_POST['updateAction'])) {
    
    $errors = erLhcoreClassModelGroup::validateInput($groupData);
    
    if (count($errors) == 0) {
        
        $groupData->updateThis();
        
        if (isset($_POST['saveAction'])) {
            erLhcoreClassModule::redirect('user/grouplist');
        } else {
            $groupData = erLhcoreClassModelGroup::fetch($groupData->id);
            $tpl->set('alertSuccessAction', __t('system/message', 'Updated'));
        }
    } else {
        $tpl->set('errors', $errors);
    }
}

if (isset($_POST['assignUsersAction'])) {
    
    if (! isset($_POST['csfr_token']) || ! erLhcoreClassUser::instance()->validateCSFRToken($_POST['csfr_token'])) {
        erLhcoreClassModule::redirect('kernel/csrf-missing');
    }
    
    if (isset($_POST['UserID']) && count($_POST['UserID']) > 0) {
        
        foreach ($_POST['UserID'] as $UserID) {
            $groupUserData = new erLhcoreClassModelGroupUser();
            $groupUserData->group_id = $groupData->id;
            $groupUserData->user_id = $UserID;
            $groupUserData->saveThis();
        }
        
        $tpl->set('assignUsersAlertSuccessAction', __t('system/message', 'Users assigned'));
    } else {
        $tpl->set('errorsAssignUsers', array(
            __t('system/message', 'Select users to assign')
        ));
    }
}

if (isset($_POST['removeUserFromGroupAction'])) {
    
    if (! isset($_POST['csfr_token']) || ! erLhcoreClassUser::instance()->validateCSFRToken($_POST['csfr_token'])) {
        erLhcoreClassModule::redirect('kernel/csrf-missing');
    }
    
    if (isset($_POST['AssignedID']) && count($_POST['AssignedID']) > 0) {
        
        foreach ($_POST['AssignedID'] as $AssignedID) {
            $groupUserData = erLhcoreClassModelGroupUser::fetch($AssignedID);
            $groupUserData->removeThis();
        }
        
        $tpl->set('assignUsersAlertSuccessAction', __t('system/message', 'Removed assigned users'));
    } else {
        $tpl->set('errorsAssignUsers', array(
            __t('system/message', 'Select assigned users')
        ));
    }
}

if (isset($_POST['assignRolesAction'])) {
    
    if (! isset($_POST['csfr_token']) || ! erLhcoreClassUser::instance()->validateCSFRToken($_POST['csfr_token'])) {
        erLhcoreClassModule::redirect('kernel/csrf-missing');
    }
    
    if (isset($_POST['RoleID']) && count($_POST['RoleID']) > 0) {
        
        foreach ($_POST['RoleID'] as $RoleID) {
            $groupRoleData = new erLhcoreClassModelGroupRole();
            $groupRoleData->group_id = $groupData->id;
            $groupRoleData->role_id = $RoleID;
            $groupRoleData->saveThis();
        }
        
        $tpl->set('assignRolesAlertSuccessAction', __t('system/message', 'Roles assigned'));
    } else {
        $tpl->set('errorsAssignRoles', array(
            __t('system/message', 'Select roles to assign')
        ));
    }
}

if (isset($_POST['removeRoleFomGroupAction'])) {
    
    if (! isset($_POST['csfr_token']) || ! erLhcoreClassUser::instance()->validateCSFRToken($_POST['csfr_token'])) {
        erLhcoreClassModule::redirect('kernel/csrf-missing');
    }
    
    if (isset($_POST['AssignedID']) && count($_POST['AssignedID']) > 0) {
        
        foreach ($_POST['AssignedID'] as $AssignedID) {
            $roleGroup = erLhcoreClassModelGroupRole::fetch($AssignedID);
            $roleGroup->removeThis();
        }
        
        $tpl->set('assignRolesAlertSuccessAction', __t('system/message', 'Removed assigned roles'));
    } else {
        $tpl->set('errorsAssignRoles', array(
            __t('system/message', 'Select assigned roles')
        ));
    }
}

$pages = new lhPaginator();
$pages->items_total = erLhcoreClassModelGroupUser::getCount(array(
    'filter' => array(
        'group_id' => $groupData->id
    )
));
$pages->setItemsPerPage(20);
$pages->serverURL = erLhcoreClassDesign::baseurl('user/editgroup') . '/' . $groupData->id;
$pages->paginate();

$tpl->set('pages', $pages);

if ($pages->items_total > 0) {
    $tpl->set('assignedUers', erLhcoreClassModelGroupUser::getList(array(
        'filter' => array(
            'group_id' => $groupData->id
        ),
        'offset' => $pages->low,
        'limit' => $pages->items_per_page
    )));
} else {
    $tpl->set('assignedUers', array());
}

$tpl->set('groupRoles', erLhcoreClassGroupRole::getGroupRoles($groupData->id));

$tpl->set('groupData', $groupData);

$Result['title'] = array(
    'title' => __t('user/editgroups', 'Group edit'),
    'small_title' => $groupData->name
);
$Result['submenu_active'] = 'users';
$Result['menu'] = 'settings';
$Result['subsubmenu'] = 'groups';
$Result['content'] = $tpl->fetch();

$Result['path'] = array(
    array(
        'url' => __url('user/grouplist'),
        'title' => __t('user/editgroup', 'Groups')
    ),
    array(
        'title' => __t('user/editgroup', 'Group edit') . ' - ' . $groupData->name
    )
)?>

