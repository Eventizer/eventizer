<?php
if (! isset($_SERVER['HTTP_X_CSRFTOKEN']) || ! erLhcoreClassUser::instance()->validateCSFRToken($_SERVER['HTTP_X_CSRFTOKEN'])) {
    echo json_encode(array(
        'error' => 'true',
        'result' => 'Invalid CSRF Token'
    ));
    exit();
}

if (isset($Params['user_parameters']['id']) && $Params['user_parameters']['id'] != '' && erLhcoreClassUser::instance()->isLogged()) {
    
    $userID = erLhcoreClassUser::instance()->getUserID();
	$eventID = $Params['user_parameters']['id'];
	$saved = erLhcoreClassModelSavedEvents::findOne(array('filter' => array('user_id' => $userID, 'event_id' => $eventID)));
	if ($saved !== false) {
	   $saved->removeThis();
	} 
}
echo json_encode(array('result'=>true));
exit;
?>