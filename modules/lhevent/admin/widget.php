<?php


$tpl = erLhcoreClassTemplate::getInstance( 'lhevent/widget.tpl.php');

$cfgSite = erConfigClassLhConfig::getInstance();

$tpl->set('locales',$cfgSite->getSetting( 'site', 'available_site_access' ));

if (isset($_POST['saveAction'])) {
   
    
    $errors = erLhcoreClassValidateEvents::validateInput( $event);
    
    if(count($errors) == 0) {
        $event->saveThis();
        erLhcoreClassModule::redirect('event/events');
        exit;
    } else {
        $tpl->set('errors',$errors);
    }
}

if (isset($_POST['cancelAction'])) {
    erLhcoreClassModule::redirect('event/events');
    exit;
}

$Result['title'] = array(
    'title' => __t('event/widget', 'Create event widget'),
    'small_title' => ''
);

$Result['content'] = $tpl->fetch();
?>