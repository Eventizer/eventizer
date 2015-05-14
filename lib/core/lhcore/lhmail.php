<?php

class erLhcoreClassMail {
	
	public static function setupSMTP(PHPMailer & $phpMailer)
	{
		$smtpData = erLhcoreClassModelSystemConfig::fetch('smtp_data');
		$data = (array)$smtpData->data;
	
		if ( isset($data['use_smtp']) && $data['use_smtp'] == 1 ) {
			$phpMailer->IsSMTP();
			$phpMailer->Host = $data['host'];
			$phpMailer->Port = $data['port'];
				
			if ($data['username'] != '' && $data['password'] != '') {
				$phpMailer->Username = $data['username'];
				$phpMailer->Password = $data['password'];
				$phpMailer->SMTPAuth = true;
			}
		}
	}
	
	public static function sendTestMail($userData) {
	
		$mail = new PHPMailer(true);
		$mail->CharSet = "UTF-8";
		$mail->Sender = $userData->email;
		$mail->From = $userData->email;
		$mail->FromName = $userData->email;
		$mail->Subject = 'Eventizer Test mail';
		$mail->AddReplyTo($userData->email,(string)$userData);
		$mail->Body = 'This is test mail. If you received this mail. That means that your SMTP settings is correct.';
		$mail->AddAddress( $userData->email );
	
		self::setupSMTP($mail);
	
		try {
			return $mail->Send();
		} catch (Exception $e) {
			throw $e;
		}
		$mail->ClearAddresses();
	}
	
	public static function parseLinks(PHPMailer & $phpMailer, $showLinkNameOnTheRight = false) {	
			
		$phpMailer->Body = preg_replace_callback('/\[url\="?(.*?)"?\](.*?)\[\/url\]/ms', "erLhcoreClassBBCode::_make_url_embed", $phpMailer->Body);
		if ($showLinkNameOnTheRight == false) {
			$phpMailer->AltBody = preg_replace('/\[url\="?(.*?)"?\](.*?)\[\/url\]/ms', "\\1", $phpMailer->AltBody);
		} else {
			$phpMailer->AltBody = preg_replace('/\[url\="?(.*?)"?\](.*?)\[\/url\]/ms', "\\1 (\\2)", $phpMailer->AltBody);
		}
		
	}
	
	public static function mailerInstance($emailTemplate) {
		
		$phpMailer = new PHPMailer();
		$phpMailer->AddReplyTo($emailTemplate->from_email, $emailTemplate->from_name);
		$phpMailer->SetFrom($emailTemplate->from_email, $emailTemplate->from_name);
		$phpMailer->Sender = $emailTemplate->from_email;
		$phpMailer->Subject = $emailTemplate->subject;
		$phpMailer->CharSet = 'UTF-8';
	
		return $phpMailer; 
		
	}
		
	public static function sendForgotPassword(erLhcoreClassModelUser $userData, $params = array()) {
	
		$emailTemplate = erLhAbstractModelEmailTemplate::fetch(1);
		
		$phpMailer = self::mailerInstance($emailTemplate);
		
		$phpMailer->AddAddress($userData->email, $userData->name.' '.$userData->surname);
	
		$url_recovery = (isset($params['recovery_hash'])) ? 'http://'.$_SERVER['HTTP_HOST'].erLhcoreClassDesign::baseurl('user/remindpassword').'/'.$params['recovery_hash'] : '';
			
		$values1 = array('{url_recovery}','{name}','{surname}');
		$values2 = array($url_recovery,$userData->name,$userData->surname);
			
		$bodyContent = str_replace($values1,$values2,$emailTemplate->content);
						
		$tplPagelayout = new erLhcoreClassTemplate( 'pagelayouts/pagelayout_mail.tpl.php');
		$tplPagelayout->set('body',nl2br($bodyContent));
	
		$phpMailer->Body = $tplPagelayout->fetch();
		$phpMailer->AltBody = $bodyContent;
		
		self::parseLinks($phpMailer);
		self::setupSMTP($phpMailer);
		
		$phpMailer->send();
	
	}
	
	public static function sendRemindPassword(erLhcoreClassModelUser $userData, $params = array()) {
	
		$emailTemplate = erLhAbstractModelEmailTemplate::fetch(2);
		
		$phpMailer = self::mailerInstance($emailTemplate);
	
		$phpMailer->AddAddress($userData->email, $userData->name.' '.$userData->surname);
	
		$new_password = (isset($params['new_password'])) ? $params['new_password'] : '';
		
		$values1 = array('{new_password}','{name}','{surname}');
		$values2 = array($new_password,$userData->name,$userData->surname);
			
		$bodyContent = str_replace($values1,$values2,$emailTemplate->content);
	
		$tplPagelayout = new erLhcoreClassTemplate( 'pagelayouts/pagelayout_mail.tpl.php');
		$tplPagelayout->set('body',nl2br($bodyContent));
	
		$phpMailer->Body = $tplPagelayout->fetch();
		$phpMailer->AltBody = $bodyContent;
		
		self::parseLinks($phpMailer);
		self::setupSMTP($phpMailer);
		
		$phpMailer->send();
	
	}
   	
	public static function sendRegistrationConfirm(erLhcoreClassModelUser $userData, $params = array()) {
	
		$emailTemplate = erLhAbstractModelEmailTemplate::fetch(3);
	
		$phpMailer = self::mailerInstance($emailTemplate);
	
		$phpMailer->AddAddress($userData->email, $userData->name.' '.$userData->surname);
	
		$d = '';
		
		if (isset($userData->redirect_url) && $userData->redirect_url != '') {
		    $d = '/(d)/'.$userData->redirect_url;
		}
		
		$url_confirm = 'http://'.$_SERVER['HTTP_HOST'].erLhcoreClassDesign::baseurl('user/activate').'/'.$userData->activate_hash.$d;
		
		$values1 = array('{url_confirm}','{name}','{surname}');
		$values2 = array($url_confirm,$userData->name,$userData->surname);
		
		$bodyContent = str_replace($values1,$values2,$emailTemplate->content);
		
		$tplPagelayout = new erLhcoreClassTemplate( 'pagelayouts/pagelayout_mail.tpl.php');
		$tplPagelayout->set('body',nl2br($bodyContent));
				
		$phpMailer->Body = $tplPagelayout->fetch();
		$phpMailer->AltBody = $bodyContent;
			
		self::parseLinks($phpMailer);
		self::setupSMTP($phpMailer);
	
		$phpMailer->send();
	
	
	}
	
	public static function sendRegistrationComplete(erLhcoreClassModelUser $userData, $params = array()) {
		
		$emailTemplate = erLhAbstractModelEmailTemplate::fetch(4);
		
   		$phpMailer = self::mailerInstance($emailTemplate);
	   
	   	$phpMailer->AddAddress($userData->email, $userData->name.' '.$userData->surname);
	   	   	
	   	$values1 = array('{name}','{surname}');
	   	$values2 = array($userData->name,$userData->surname);
	   		
	   	$bodyContent = str_replace($values1,$values2,$emailTemplate->content);
	   		   	
	   	$tplPagelayout = new erLhcoreClassTemplate( 'pagelayouts/pagelayout_mail.tpl.php');
	   	$tplPagelayout->set('body',nl2br($bodyContent));
	   	
	   	$phpMailer->Body = $tplPagelayout->fetch();
	   	$phpMailer->AltBody = $bodyContent;
	   	
	   	self::parseLinks($phpMailer);
	   	self::setupSMTP($phpMailer);
	   	
	   	$phpMailer->send();
	
	}
	
}

?>