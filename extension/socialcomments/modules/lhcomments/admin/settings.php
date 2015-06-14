<?php

$tpl = erLhcoreClassTemplate::getInstance( 'lhcomments/admin/settings.tpl.php');

try {
    $commentData = erLhcoreClassModelSystemConfig::fetch('event_comments_code');
} catch (Exception $e) {
    $settings = include 'extension/socialcomments/settings/settings.ini.php';
    $commentData = new erLhcoreClassModelSystemConfig();
    $commentData->identifier = 'event_comments_code';
    $commentData->explain = $settings['description'];
    $commentData->value = '';
    $commentData->hidden = 1;
    $commentData->type = 0;
    $commentData->saveThis();
}



if ( isset($_POST['UpdateSettings'])) {

	$definition = array(
			'code' => new ezcInputFormDefinitionElement(
					ezcInputFormDefinitionElement::OPTIONAL, 'unsafe_raw'
			)
	);

	if (!isset($_POST['csfr_token']) || !$currentUser->validateCSFRToken($_POST['csfr_token'])) {
		erLhcoreClassModule::redirect('comments/settings');
		exit;
	}

	$Errors = array();

	$form = new ezcInputForm( INPUT_POST, $definition );
	$Errors = array();

	if ( $form->hasValidData( 'code' )) {
		$commentData->value = $form->code;
	} else {
		$commentData->value = '';
	}

	$commentData->saveThis();
	
	$tpl->set('alertSuccessAction',__t('comments/settings','Comment widget code updated'));
	$tpl->set('updated','done');
}

$tpl->set('code', $commentData->value);

$Result['submenu'] = 'developer';
$Result['menu'] = 'settings';
$Result['title'] =  array('title' => erTranslationClassLhTranslation::getInstance()->getTranslation('system/smtp','Comments'),
                          'small_title' =>  __t('system/smtp','Change your social comments settings'));
$Result['content'] = $tpl->fetch();
$Result['path'] = array(
array('title' => erTranslationClassLhTranslation::getInstance()->getTranslation('system/smtp','Social comments settings')));

?>