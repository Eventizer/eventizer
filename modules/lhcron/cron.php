<?php 

/*
*
* php cron.php -s site_admin -c cron/cron
*
*/

echo "Cron start - ",date('Y-m-d H:i'),"\n";
echo "-------------------------------------------- \n";

echo "Delete old password hash \n";
erLhcoreClassModelForgotPassword::removeOldPasswordHash();

echo "-------------------------------------------- \n";
echo "Cron finished - ",date('Y-m-d H:i'),"\n";

?>