<?php
$tpl = erLhcoreClassTemplate::getInstance('lhevent/create.tpl.php');

$event = new erLhcoreClassModelEvents();
if (isset($_POST['saveAction'])) {
    
    $errors = erLhcoreClassValidateEvents::validateInput($event);
    
    if (count($errors) == 0) {
        $event->org_id = erLhcoreClassUser::instance()->getUserID();
        $event->saveThis();
        erLhcoreClassModule::redirect('event/myevents');
        exit();
    } else {
        $tpl->set('errors', $errors);
    }
}

if (isset($_POST['cancelAction'])) {
    erLhcoreClassModule::redirect('event/events');
    exit();
}

$tpl->set('event', $event);
$Result['title'] = array(
    'title' => __t('event/new', 'Create event'),
    'small_title' => ''
);

$Result['additional_css'] = '<link rel="stylesheet" type="text/css" href="' . erLhcoreClassDesign::designCSS('css/plugins/datepicker/datepicker3.css') . '" />';
$Result['additional_js'] = '<script type="text/javascript" src="'.erLhcoreClassDesign::designJS('js/ckeditor/ckeditor.js;js/jquery-ui-1.10.3.min.js;js/bootstrap/bootstrap-datepicker.js', false).'"></script>';
$Result['menu'] = 'events';
$Result['content'] = $tpl->fetch();
$Result['path'] = array(
    array(
        'url' => __url('event/events'),
        'title' => __t('event/events', 'Events list')
    ),
    array(
        'title' => __t('event/new', 'Create event')
    )
);

?>