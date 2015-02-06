<?php

$tpl = erLhcoreClassTemplate::getInstance('lhsystem/edit.tpl.php');

// If already set during account update
$ConfigData = erLhcoreClassSystemConfig::getSession()->load( 'erLhcoreClassModelSystemConfig', $Params['user_parameters']['config_id'] );

if (isset($_POST['UpdateConfig']) || isset($_POST['UpdateConfigAndExit']))
{
    if (!isset($_POST['csfr_token']) || !$currentUser->validateCSFRToken($_POST['csfr_token'])) {
        erLhcoreClassModule::redirect('system/list');
        exit;
    }
    
	switch ($ConfigData->type) {
		case erLhcoreClassModelSystemConfig::SITE_ACCESS_PARAM_ON:
			
				$data = array();
				foreach (erConfigClassLhConfig::getInstance()->conf->getSetting('site','available_site_access') as $siteaccess)
				{
					$data[$siteaccess] = $_POST['Value'.$siteaccess];
				}					
				$ConfigData->value = serialize($data);
			break;
			
		case erLhcoreClassModelSystemConfig::SITE_ACCESS_PARAM_OFF:
				$ConfigData->value = $_POST['ValueParam'];
			break;
	
		default:
			break;
	}
		

	$ConfigData->updateThis();
	$tpl->set('alertSuccessAction',__t('system/edit','Setting updated successful'));
	
	if (isset($_POST['UpdateConfigAndExit'])) {
	    erLhcoreClassModule::redirect('system/list');
	}
}

$tpl->set('systemconfig',$ConfigData);

$Result['submenu'] = 'general';
$Result['menu'] = 'settings';
$Result['title'] =  array('title' => erTranslationClassLhTranslation::getInstance()->getTranslation('system/edit','Edit setting'),
    'small_title' =>  $ConfigData->explain);

$Result['content'] = $tpl->fetch();

$Result['path'] = array(
    array('url' => erLhcoreClassDesign::baseurl('system/list'),'title' => erTranslationClassLhTranslation::getInstance()->getTranslation('system/edit','General settings')),
    array('title' => erTranslationClassLhTranslation::getInstance()->getTranslation('system/edit','Edit setting'))
)

?>