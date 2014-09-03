<?php 

/*
*
* php cron.php -s site_admin -c cron/cron_mailer
*
*/

echo "Cron start - ",date('Y-m-d H:i'),"\n";
echo "-------------------------------------------- \n";

foreach (erLhcoreClassModelCronMailerMail::getList(array('filter' => array('status' => erLhcoreClassModelCronMailerMail::MAIL_STATUS_NEW),'limit' => 10,'sort' => 'id ASC')) as $mail){
	$mail->send();
	echo "Mail send: ",$mail->id,"\n";
}

echo "-------------------------------------------- \n";
echo "Cron finished - ",date('Y-m-d H:i'),"\n";

?>