<?php
if (! isset($_SERVER['HTTP_X_CSRFTOKEN']) || ! erLhcoreClassUser::instance()->validateCSFRToken($_SERVER['HTTP_X_CSRFTOKEN'])) {
    echo json_encode(array(
        'error' => 'true',
        'result' => 'Invalid CSRF Token'
    ));
    exit();
}

if (isset($Params['user_parameters']['id']) && $Params['user_parameters']['id'] != '' && erLhcoreClassUser::instance()->isLogged()) {
    
	$saved = $Params['user_object'];
	if ($saved !== false) {
	   $saved->removeThis();
	} 
}
echo json_encode(array('result'=>true));
exit;
?>