<?php 
// Translator function
function __t()
{
	$args = func_get_args();
	
	if (count($args) == 2) {
		return erTranslationClassLhTranslation::getInstance()->getTranslation($args[0],$args[1]);
	} 
	
	return '';
}

function __url($url) {
	return erLhcoreClassDesign::baseurl($url);
}

function __design($url) {
	return erLhcoreClassDesign::design($url);
}
?>