<?
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 0); 


require_once 'modules/lhcaptcha/pear/Text/CAPTCHA.php';
require_once 'modules/lhcaptcha/pear/Image/Text.php';
require_once 'modules/lhcaptcha/pear/Image/Tools.php';
		 
$c = Text_CAPTCHA::factory('Image');
$c->init(150, 60, null,
array(

	  'font_path' => 'modules/lhcaptcha/fonts/',
	  'font_file' => 'arial.ttf',
	  'background_color' => '#FFFFFF',
	  'text_color' => '#515151'
	  )
);

$_SESSION[$_SERVER['REMOTE_ADDR']][$Params['user_parameters']['captcha_name']] = $c->getPhrase();
			 
header('Content-type: image/jpeg');	
imagejpeg($c->getCAPTCHA());

exit;
?>