<?php


$tpl = erLhcoreClassTemplate::getInstance( 'lheventadmin/widget.tpl.php');

$cfgSite = erConfigClassLhConfig::getInstance();

$tpl->set('locales',$cfgSite->getSetting( 'site', 'available_site_access' ));

if (isset($_POST['saveAction'])) {
   
    
    $errors = erLhcoreClassValidateEvents::validateInput( $event);
    
    if(count($errors) == 0) {
        $event->saveThis();
        erLhcoreClassModule::redirect('eventadmin/list');
        exit;
    } else {
        $tpl->set('errors',$errors);
    }
}

if (isset($_POST['cancelAction'])) {
    erLhcoreClassModule::redirect('eventadmin/list');
    exit;
}



$Result['content'] = $tpl->fetch();
?>