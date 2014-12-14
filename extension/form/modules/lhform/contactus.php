<?php

$tpl = erLhcoreClassTemplate::getInstance( 'lhform/contactus.tpl.php');

$formData = array(
'FormName' => '',
'FormEmail' => '',
'FormText' => ''
);

$messageSend = false;

if (isset($_POST['SendRequest']))
{    
	$data = new erLhcoreformClassValidation();
	$Errors = erLhcoreformClassValidation::validateContactUs($data);
	
    if (count($Errors) == 0)
    {
    	
    	erLhcoreClassFormEmails::sendContactUsEmail($data);      
        $messageSend = true;
        $tpl->set('alertSuccessAction', __t('form/contactus','Feedback was send!'));
        
    } else {
        
        $formData['FormName'] = $data->FormName;
        $formData['FormText'] = $data->FormText;
        $formData['FormEmail'] = $data->FormEmail;
        
        if (erLhcoreClassForm::getInstance()->getSetting('nature_of_query','enabled') === true)
        	$formData['QueryNature'] = $data->QueryNature;
          
        $tpl->set('errors',$Errors);
    }

}

$tpl->set('messageSend', $messageSend);
$tpl->set('form_data',$formData);

$Result['sidebartype'] = 'right';
$Result['content'] = $tpl->fetch();

?>