<?php

class erLhcoreClassEventMail extends erLhcoreClassMail {
	
		
	public static function sendSavedEventNotification(erLhcoreClassModelSavedEvents $savedEvent, $params = array()) {
	
		$emailTemplate = erLhAbstractModelEmailTemplate::fetch(5);
		
		$phpMailer = self::mailerInstance($emailTemplate);
		
		$phpMailer->AddAddress($savedEvent->user->email, $savedEvent->user->name.' '.$savedEvent->user->surname);
	
		$link = $savedEvent->event->full_url;
			
		$values1 = array('{event_name}','{name}','{link}');
		$values2 = array($savedEvent->event->title, $savedEvent->user->name, $link);
			
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