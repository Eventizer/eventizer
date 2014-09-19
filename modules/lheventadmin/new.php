<?php

$tpl = erLhcoreClassTemplate::getInstance( 'lheventadmin/new.tpl.php');

$event = new erLhcoreClassModelEvents();
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



$tpl->set('event',$event);
$Result['title'] =  __t('eventadmin/new','Create event');
$Result['small_title'] =  '';
$Result['additional_js'] =  '<script type="text/javascript" src="/design/backendtheme/js/ckeditor/ckeditor.js"></script>';
$Result['menu'] = 'events';
$Result['content'] = $tpl->fetch();
$Result['path'] = array(
		array('url' => __url('eventadmin/list'),'title' => __t('eventadmin/list','Events list')),
		array('title' => __t('eventadmin/new','Create event'))
);

?>