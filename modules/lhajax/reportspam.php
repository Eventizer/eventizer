<?php 
$id = (int)$Params['user_parameters']['id'];

try {
	$image = erLhcoreClassModelImageImage::fetch($id);
} catch (Exception $e) {
	$image = new erLhcoreClassModelImageImage();
}


if(isset($_SESSION["reportIP_$id"]) && $_SESSION["reportIP_$id"] == $_SERVER["REMOTE_ADDR"]){
	echo json_encode(array('success' => 'false', 'message' => erTranslationClassLhTranslation::getInstance()->getTranslation('image/view','You just reported about this image.')));
} else {
	
	$emailContent = erTranslationClassLhTranslation::getInstance()->getTranslation('image/view','User reported that this image is bad. Image url:');
	$emailContent .= '<a target="_blank" href="http://'.erConfigClassLhConfig::getInstance()->getSetting( 'site', 'site_domain' ).$image->url_path.'">'.erConfigClassLhConfig::getInstance()->getSetting( 'site', 'site_domain' ).$image->url_path.'</a>';
	
	$tplmail = erLhcoreClassTemplate::getInstance( 'lhuser/parts/mailbody.tpl.php');
	$tplmail->set('url', 'http://'.erConfigClassLhConfig::getInstance()->getSetting( 'site', 'wwwhost' ));
	$tplmail->set('body',$emailContent);
	$content = $tplmail->fetch();
	
	$adminEmail = erConfigClassLhConfig::getInstance()->getSetting( 'site', 'bad_photo' );
	
	erLhcoreClassFunctions::sendEmailHtml($adminEmail,erTranslationClassLhTranslation::getInstance()->getTranslation('image/view','New bad image report'),$content);
	$_SESSION["reportIP_$id"] = $_SERVER["REMOTE_ADDR"];
	
	echo json_encode(array('success' => 'true', 'message' => erTranslationClassLhTranslation::getInstance()->getTranslation('image/view','Thanks, your report was sent to admin')));
	
}
exit;
?>