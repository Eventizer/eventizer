<?php

$tpl = erLhcoreClassTemplate::getInstance('lhabstract/edit.tpl.php');
$ObjectData = erLhcoreClassAbstract::getSession()->load( 'erLhAbstractModel'.$Params['user_parameters']['identifier'], (int)$Params['user_parameters']['object_id'] );

if (isset($_POST['CancelAction'])) {
    erLhcoreClassModule::redirect('abstract/list','/'.$Params['user_parameters']['identifier']);
    exit;
}

$object_trans = $ObjectData->getModuleTranslations();

if (isset($object_trans['permission']) && !$currentUser->hasAccessTo($object_trans['permission']['module'],$object_trans['permission']['function'])) {
	erLhcoreClassModule::redirect();
	exit;
}

if ( method_exists($ObjectData,'checkPermission') ) {
	if ( $ObjectData->checkPermission() === false ) {
		erLhcoreClassModule::redirect();
		exit;
	}
}

if (isset($_POST['SaveClient']) || isset($_POST['UpdateClient']))
{
	if (!isset($_POST['csfr_token']) || !$currentUser->validateCSFRToken($_POST['csfr_token'])) {
		erLhcoreClassModule::redirect();
		exit;
	}

    $Errors = erLhcoreClassAbstract::validateInput($ObjectData);
    if (count($Errors) == 0)
    {
        if ( method_exists($ObjectData,'updateThis') ) {
            $ObjectData->updateThis();
        } else {
            erLhcoreClassAbstract::getSession()->update($ObjectData);
        }

        $cache = CSCacheAPC::getMem();
        $cache->increaseCacheVersion('site_attributes_version');

		if (isset($_POST['SaveClient'])){
	        erLhcoreClassModule::redirect('abstract/list','/'.$Params['user_parameters']['identifier']);
	        exit;
		}

		$tpl->set('updated',true);

    }  else {
        $tpl->set('errors',$Errors);
    }
}


$tpl->set('object',$ObjectData);
$tpl->set('identifier',$Params['user_parameters']['identifier']);

if (method_exists($ObjectData,'customForm')) {
	$tpl->set('custom_form',$ObjectData->customForm());
}

$tpl->set('object_trans',$object_trans);

$Result['submenu'] = 'etemplate';
$Result['menu'] = 'settings';
$Result['title'] =  
    array(
         'title'=>erTranslationClassLhTranslation::getInstance()->getTranslation('abstract/edit','Edit'),
         'small_title'=>$object_trans ['name']
);
$Result['content'] = $tpl->fetch();


if (method_exists($ObjectData,'dependCss')) {
	$Result['additional_header_css'] = $ObjectData->dependCss();
}

if (method_exists($ObjectData,'dependJs')) {
	$Result['additional_header_js'] = $ObjectData->dependJs();
}

$Result['submenu'] = $Params['user_parameters']['identifier'];
if (isset($object_trans['path'])){
	$Result['path'][] = $object_trans['path'];
	$Result['path'][] = array('url' => erLhcoreClassDesign::baseurl('abstract/list').'/'.$Params['user_parameters']['identifier'], 'title' => $object_trans['name']);
	$Result['path'][] = array('title' =>erTranslationClassLhTranslation::getInstance()->getTranslation('system/buttons','Edit'));
} else {
	$Result['path'] = array(
			array('url' => erLhcoreClassDesign::baseurl('abstract/list').'/'.$Params['user_parameters']['identifier'], 'title' => $object_trans['name']),
			array('title' => erTranslationClassLhTranslation::getInstance()->getTranslation('system/buttons','Edit'))
	);
}