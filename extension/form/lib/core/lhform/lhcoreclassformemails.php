<?php
/**
 * 
 * @author NerijusO
 * class to handle form mail sending whitch extends main mail class
 */
class erLhcoreClassFormEmails extends erLhcoreClassMail {
	public static function sendContactUsEmail($data) {
		$emailTemplate = erLhAbstractModelEmailTemplate::fetch ( 8 );
		
		$phpMailer = self::mailerInstance ( $emailTemplate );
		
		if (erLhcoreClassForm::getInstance()->getSetting('nature_of_query','send_to')) {
			$adminEmail = erLhcoreClassForm::getInstance()->getSetting('nature_of_query','send_to');
		} else {
			$adminEmail = erConfigClassLhConfig::getInstance ()->getSetting ( 'site', 'site_admin_email' );
		}
		
		$phpMailer->ClearReplyTos (); // clear before seted reply to contact
		$phpMailer->AddAddress ( $adminEmail );
		$phpMailer->From = $data->FormEmail;
		$phpMailer->AddReplyTo ( $data->FormEmail, $data->FormName );
		
		if (erLhcoreClassForm::getInstance ()->getSetting ( 'nature_of_query', 'enabled' ) === true) {
			$val1 = array (
					'{naturequery}' 
			);
			$val2 = array (
					$data->QueryNature
			);
		} else {
			$val1 = array ();
			$val2 = array ();
		}
		
		$values1 = array_merge($val1, array (
				'{name}',
				'{email}',
				'{message}', 
				'{browser}', 
				'{device}', 
		));
		
		//https://github.com/serbanghita/Mobile-Detect this library is required to 
		if (class_exists ('Mobile_Detect')) {
			$detect = new Mobile_Detect;
			if ($detect->isMobile()) {
				$device = __t('form/contactus','Mobile');
			} elseif ($detect->isTablet()) {
				$device = __t('form/contactus','Tablet');
			} else {
				$device = __t('form/contactus','PC');
			}
		} else {
			$device = __t('form/contactus','Unknown');
		}
			
		$values2 = array_merge($val2, array (
				$data->FormName,
				$data->FormEmail,
				$data->FormText, 
				$_SERVER['HTTP_USER_AGENT'],
				$device
		));
		
		$bodyContent = str_replace ( $values1, $values2, $emailTemplate->content );
		
		$tplPagelayout = new erLhcoreClassTemplate ( 'pagelayouts/pagelayout_mail.tpl.php' );
		$tplPagelayout->set ( 'body', nl2br ( $bodyContent ) );
		
		$phpMailer->Body = $tplPagelayout->fetch ();
		$phpMailer->AltBody = $bodyContent;
		
		self::parseLinks ( $phpMailer );
		self::setupSMTP ( $phpMailer );
		
		$phpMailer->send ();
	}
}

?>