<?php

@ini_set('error_reporting', E_ALL);
@ini_set('display_errors', 1);

require_once "ezcomponents/Base/src/base.php"; // dependent on installation method, see below

function __autoload( $className ) {
	ezcBase::autoload( $className );
}

ezcBase::addClassRepository( './','./lib/autoloads');
erLhcoreClassSystem::init();

// Include global functions
include_once "lib/core/lhcore/lhglobalfunctions.php";

// your code here
ezcBaseInit::setCallback(
	'ezcInitDatabaseInstance',
	'erLhcoreClassLazyDatabaseConfiguration'
);

$Result = erLhcoreClassModule::moduleInit();

$tpl = erLhcoreClassTemplate::getInstance('pagelayouts/main.php');
$tpl->set('Result',$Result);

if (isset($Result['pagelayout'])) {
	$tpl->setFile('pagelayouts/'.$Result['pagelayout'].'.php');
}

echo $tpl->fetch();
