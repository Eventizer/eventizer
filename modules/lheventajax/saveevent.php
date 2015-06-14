<?php
if (! isset($_SERVER['HTTP_X_CSRFTOKEN']) || ! erLhcoreClassUser::instance()->validateCSFRToken($_SERVER['HTTP_X_CSRFTOKEN'])) {
    echo json_encode(array(
        'error' => 'true',
        'result' => 'Invalid CSRF Token'
    ));
    exit();
}
;

if (isset($Params['user_parameters']['id']) && $Params['user_parameters']['id'] != '' && erLhcoreClassUser::instance()->isLogged()) {
    
    $userID = erLhcoreClassUser::instance()->getUserID();
	$eventID = $Params['user_parameters']['id'];
	
	if (erLhcoreClassModelSavedEvents::getCount(array('filter' => array('user_id' => $userID, 'event_id' => $eventID))) == 0) {
	   $savedEvent = new erLhcoreClassModelSavedEvents();
	   $savedEvent->user_id = $userID;
	   $savedEvent->event_id = $eventID;
	   $savedEvent->saveThis();
	   echo json_encode(array('error' => false, 'msg' => __t('event/saved','You saved event to your favourite events list'), 'html' => '<a href="'.__url('event/savedevents').'" id="save_event" class="btn btn-default btn-lg btn-block">'.__t('event/view','View saved events').'</a>'));
	   exit;
	} 
}

echo json_encode(array('error' => true, 'msg' => __t('event/saved','You can not save event to your events list')));
exit();
?>