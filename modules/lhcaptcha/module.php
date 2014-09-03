<?php

$Module = array( "name" => "Captcha module",
				 'variable_params' => true );

$ViewList = array();

$ViewList['image'] = array(
	'script' => 'image.php',
	'params' => array('captcha_name')
);

$ViewList['captchastring'] = array(
    'script' => 'captchastring.php',
    'params' => array('captcha_name','timets')
);

$FunctionList = array();

?>