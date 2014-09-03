#!/bin/sh

# Site cronjobs
echo "Running mailer cronjob"

fileLock='./cron/cron_mailer.lock'

if [ -f $fileLock ];
then 
    echo "Lock file exists, skipping execution";
else
    touch $fileLock;
   	/usr/bin/php cron.php -s site_admin -c cron/cron_mailer > cron/log/cron_mailer.log
    rm -f $fileLock;
fi