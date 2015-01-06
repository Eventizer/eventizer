<?php
$tpl = erLhcoreClassTemplate::getInstance('lhevent/edit.tpl.php');
$_SESSION['has_access_to_editor'] = 1;

$event = erLhcoreClassModelEvents::fetch((int) $Params['user_parameters']['event_id']);
if (isset($_POST['saveAction'])) {
    
    $errors = erLhcoreClassValidateEvents::validateInput($event);
    
    if (count($errors) == 0) {
        $event->saveThis();
        erLhcoreClassModule::redirect('event/events');
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
    'title' => __t('event/new', 'Edit event'),
    'small_title' => ''
);
$Result['additional_js'] = '<script type="text/javascript" src="/design/backendtheme/js/ckeditor/ckeditor.js"></script>';
$Result['menu'] = 'events';
$Result['content'] = $tpl->fetch();
$Result['path'] = array(
    array(
        'url' => __url('event/events'),
        'title' => __t('event/events', 'Events list')
    ),
    array(
        'title' => __t('event/new', 'Edit event')
    )
);

?>